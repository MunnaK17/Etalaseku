<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InclusiveApplicationApproved;
use App\Mail\InclusiveApplicationRejected;
use App\Models\InclusiveApplication;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_stores' => Store::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pro_stores' => Store::where('plan', 'pro')->count(),
            'inclusive_sellers' => Store::where('is_inclusive_seller', true)->count(),
            'pending_applications' => InclusiveApplication::where('status', 'pending')->count(),
        ];

        // Recent stores
        $recentStores = Store::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent applications
        $recentApplications = InclusiveApplication::with(['store', 'user'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', [
            'stats' => $stats,
            'recentStores' => $recentStores,
            'recentApplications' => $recentApplications,
        ]);
    }

    /**
     * List all stores.
     */
    public function stores()
    {
        $stores = Store::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.stores.index', [
            'stores' => $stores,
        ]);
    }

    /**
     * Show store details.
     */
    public function showStore(Store $store)
    {
        $store->load(['user', 'products']);

        $stats = [
            'total_views' => $store->analytics()->where('event_type', 'page_view')->count(),
            'product_clicks' => $store->analytics()->whereIn('event_type', ['product_click', 'cta_click'])->count(),
            'total_products' => $store->products()->count(),
            'total_orders' => $store->orders()->count(),
        ];

        return view('admin.stores.show', [
            'store' => $store,
            'stats' => $stats,
        ]);
    }

    /**
     * List inclusive applications.
     */
    public function inclusiveApplications(Request $request)
    {
        $query = InclusiveApplication::with(['user', 'store']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.inclusive-applications.index', [
            'applications' => $applications,
        ]);
    }

    /**
     * Show application details.
     */
    public function showApplication(InclusiveApplication $application)
    {
        $application->load(['user', 'store']);

        return view('admin.inclusive-applications.show', [
            'application' => $application,
        ]);
    }

    /**
     * Approve an application - creates user account and store automatically.
     */
    public function approveApplication(Request $request, InclusiveApplication $application)
    {
        if ($application->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Permohonan sudah diproses.');
        }

        try {
            // Generate random password
            $tempPassword = Str::random(12);

            // Create user account
            $user = User::create([
                'name' => $application->applicant_name,
                'email' => $application->email,
                'password' => Hash::make($tempPassword),
                'role' => 'user',
            ]);

            // Generate store slug from name
            $storeSlug = Str::slug($application->applicant_name);
            // Make it unique
            $originalSlug = $storeSlug;
            $counter = 1;
            while (Store::where('username', $storeSlug)->exists()) {
                $storeSlug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Create store
            $store = Store::create([
                'user_id' => $user->id,
                'name' => $application->applicant_name . ' Store',
                'username' => $storeSlug,
                'description' => 'Toko Inclusive Seller',
                'is_active' => true,
                'is_inclusive_seller' => true,
                'plan' => 'pro',
                'plan_expires_at' => now()->addMonths(6),
            ]);

            // Update application
            $application->update([
                'status' => InclusiveApplication::STATUS_APPROVED,
                'admin_notes' => $request->admin_notes,
                'reviewed_at' => now(),
                'reviewed_by' => auth()->id(),
                'user_id' => $user->id,
                'store_id' => $store->id,
                'temp_password' => $tempPassword,
            ]);

            $emailSent = true;

            // Send email notification
            try {
                \Mail::to($application->email)->send(new InclusiveApplicationApproved($application, $tempPassword));
            } catch (\Exception $e) {
                $emailSent = false;

                Log::error('Failed to send approval email', [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'error' => $e->getMessage(),
                ]);
            }

            $message = "Permohonan berhasil disetujui! User account dan store '{$store->name}' telah dibuat.";

            if (!$emailSent) {
                $message .= ' Namun email notifikasi gagal dikirim. Cek konfigurasi email dan log aplikasi.';
            }

            return redirect()
                ->route('admin.inclusive-applications.index')
                ->with($emailSent ? 'success' : 'warning', $message);

        } catch (\Exception $e) {
            Log::error('Failed to approve inclusive application', [
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memproses permohonan.');
        }
    }

    /**
     * Reject an application.
     */
    public function rejectApplication(Request $request, InclusiveApplication $application)
    {
        if ($application->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Permohonan sudah diproses.');
        }

        $application->update([
            'status' => InclusiveApplication::STATUS_REJECTED,
            'admin_notes' => $request->admin_notes,
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Send rejection email notification
        try {
            \Mail::to($application->email)->send(new InclusiveApplicationRejected($application));
        } catch (\Exception $e) {
            Log::error('Failed to send rejection email', [
                'application_id' => $application->id,
                'email' => $application->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('admin.inclusive-applications.index')
            ->with('success', 'Permohonan ditolak. Email notifikasi telah dikirim.');
    }
}
