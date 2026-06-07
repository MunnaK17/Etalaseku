<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InclusiveApplication;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Notifications\InclusiveApprovedNotification;
use App\Notifications\InclusiveRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
        $recentApplications = InclusiveApplication::with('store')
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
    public function inclusiveApplications()
    {
        $applications = InclusiveApplication::with('store')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
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
        $application->load('store');

        return view('admin.inclusive-applications.show', [
            'application' => $application,
        ]);
    }

    /**
     * Approve an application.
     */
    public function approveApplication(Request $request, InclusiveApplication $application)
    {
        if ($application->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Permohonan sudah diproses.');
        }

        $application->update([
            'status' => InclusiveApplication::STATUS_APPROVED,
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Update store to inclusive seller with Pro plan (6 months)
        $application->store->update([
            'is_inclusive_seller' => true,
            'plan' => 'pro',
            'plan_expires_at' => now()->addMonths(6),
        ]);

        // Send approval notification
        if ($application->store->user) {
            Notification::send($application->store->user, new InclusiveApprovedNotification());
        }

        return redirect()
            ->route('admin.inclusive-applications.index')
            ->with('success', 'Permohonan berhasil disetujui! Store sekarang menjadi Inclusive Seller (Pro 6 bulan).');
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
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Send rejection notification
        if ($application->store && $application->store->user) {
            Notification::send($application->store->user, new InclusiveRejectedNotification());
        }

        return redirect()
            ->route('admin.inclusive-applications.index')
            ->with('success', 'Permohonan ditolak.');
    }
}