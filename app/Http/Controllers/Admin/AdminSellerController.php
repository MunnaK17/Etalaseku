<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminSellerController extends Controller
{
    /**
     * Display a listing of sellers with filters.
     */
    public function index(Request $request)
    {
        $query = Store::with('user');

        // Filter by status
        if ($request->has('status') && $request->status) {
            match ($request->status) {
                'hidden' => $query->where('is_hidden', true),
                'suspended' => $query->where('is_suspended', true),
                'pro' => $query->where('plan', 'pro'),
                'free' => $query->where('plan', 'free'),
                'inclusive' => $query->where('is_inclusive_seller', true),
                'verified' => $query->where('is_verified_seller', true),
                default => null,
            };
        }

        // Filter by search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('direction', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $sellers = $query->paginate(20)->withQueryString();

        // Stats for sidebar badges
        $stats = [
            'total' => Store::count(),
            'hidden' => Store::where('is_hidden', true)->count(),
            'suspended' => Store::where('is_suspended', true)->count(),
            'pro' => Store::where('plan', 'pro')->count(),
            'inclusive' => Store::where('is_inclusive_seller', true)->count(),
        ];

        return view('admin.sellers.index', [
            'sellers' => $sellers,
            'stats' => $stats,
        ]);
    }

    /**
     * Display the specified seller details.
     */
    public function show(Store $store)
    {
        $store->load(['user', 'products', 'orders']);

        $stats = [
            'total_views' => $store->analytics()->where('event_type', 'page_view')->count(),
            'product_clicks' => $store->analytics()->whereIn('event_type', ['product_click', 'cta_click'])->count(),
            'total_products' => $store->products()->count(),
            'active_products' => $store->products()->where('is_active', true)->count(),
            'total_orders' => $store->orders()->count(),
            'pending_orders' => $store->orders()->where('order_status', 'pending')->count(),
        ];

        return view('admin.sellers.show', [
            'store' => $store,
            'stats' => $stats,
        ]);
    }

    /**
     * Hide a seller from public view.
     */
    public function hide(Store $store)
    {
        if ($store->is_hidden) {
            return redirect()->back()->with('error', 'Seller sudah disembunyikan.');
        }

        $store->hide();

        Log::info('Seller hidden by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'admin_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', "Seller '{$store->name}' berhasil disembunyikan dari publik.");
    }

    /**
     * Unhide a seller.
     */
    public function unhide(Store $store)
    {
        if (!$store->is_hidden) {
            return redirect()->back()->with('error', 'Seller tidak dalam keadaan tersembunyi.');
        }

        $store->unhide();

        Log::info('Seller unhidden by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'admin_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', "Seller '{$store->name}' berhasil ditampilkan kembali.");
    }

    /**
     * Suspend a seller.
     */
    public function suspend(Request $request, Store $store)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ], [
            'reason.required' => 'Alasan penangguhan harus diisi.',
        ]);

        if ($store->is_suspended) {
            return redirect()->back()->with('error', 'Seller sudah ditangguhkan.');
        }

        $admin = auth()->user();
        $store->suspend($admin, $request->reason);

        Log::info('Seller suspended by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'reason' => $request->reason,
            'admin_id' => $admin->id,
        ]);

        // Send email notification to seller
        $this->sendSuspensionEmail($store, $request->reason);

        return redirect()->back()->with('success', "Seller '{$store->name}' berhasil ditangguhkan.");
    }

    /**
     * Unsuspend a seller.
     */
    public function unsuspend(Store $store)
    {
        if (!$store->is_suspended) {
            return redirect()->back()->with('error', 'Seller tidak dalam keadaan ditangguhkan.');
        }

        $store->unsuspend();

        Log::info('Seller unsuspended by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'admin_id' => auth()->id(),
        ]);

        // Send email notification to seller
        $this->sendUnsuspensionEmail($store);

        return redirect()->back()->with('success', "Penangguhan seller '{$store->name}' berhasil dicabut.");
    }

    /**
     * Grant inclusive seller rights.
     */
    public function grantInclusive(Request $request, Store $store)
    {
        if ($store->is_inclusive_seller) {
            return redirect()->back()->with('error', 'Seller sudah memiliki hak Inclusive.');
        }

        $admin = auth()->user();
        $store->grantInclusive($admin);

        Log::info('Inclusive rights granted by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'admin_id' => $admin->id,
        ]);

        return redirect()->back()->with('success', "Hak Inclusive seller '{$store->name}' berhasil diberikan.");
    }

    /**
     * Revoke inclusive seller rights.
     */
    public function revokeInclusive(Request $request, Store $store)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        if (!$store->is_inclusive_seller) {
            return redirect()->back()->with('error', 'Seller tidak memiliki hak Inclusive.');
        }

        $admin = auth()->user();
        $store->revokeInclusive($admin);

        Log::info('Inclusive rights revoked by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'reason' => $request->reason,
            'admin_id' => $admin->id,
        ]);

        return redirect()->back()->with('success', "Hak Inclusive seller '{$store->name}' berhasil dicabut.");
    }

    /**
     * Cancel seller subscription.
     */
    public function cancelSubscription(Store $store)
    {
        if ($store->plan === 'free' && !$store->plan_expires_at) {
            return redirect()->back()->with('error', 'Seller tidak memiliki langganan aktif.');
        }

        $previousPlan = $store->plan;
        $store->cancelSubscription();

        Log::info('Subscription cancelled by admin', [
            'store_id' => $store->id,
            'store_name' => $store->name,
            'previous_plan' => $previousPlan,
            'admin_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', "Langganan seller '{$store->name}' berhasil dibatalkan. Plan direset ke Free.");
    }

    /**
     * Hard delete a seller.
     */
    public function destroy(Request $request, Store $store)
    {
        $request->validate([
            'confirm' => 'required|string',
        ], [
            'confirm.required' => 'Konfirmasi harus diisi.',
        ]);

        // Verify confirmation matches store name or "DELETE"
        $confirmText = strtolower($request->confirm);
        $storeName = strtolower($store->name);

        if ($confirmText !== 'delete' && $confirmText !== $storeName) {
            return redirect()->back()->with('error', 'Konfirmasi tidak valid. Ketik "DELETE" atau nama seller untuk mengkonfirmasi.');
        }

        try {
            DB::beginTransaction();

            $storeName = $store->name;
            $storeId = $store->id;
            $userId = $store->user_id;

            // Log before deletion for audit
            Log::warning('Seller hard deleted by admin', [
                'store_id' => $storeId,
                'store_name' => $storeName,
                'user_id' => $userId,
                'admin_id' => auth()->id(),
            ]);

            // Delete related records first (cascade)
            // Delete products
            $store->products()->delete();

            // Delete orders
            $store->orders()->delete();

            // Delete analytics
            $store->analytics()->delete();

            // Delete link groups
            $store->linkGroups()->delete();

            // Delete seller verification
            $store->verification()?->delete();

            // Delete user account
            if ($userId) {
                User::where('id', $userId)->delete();
            }

            // Delete store
            $store->delete();

            DB::commit();

            return redirect()->route('admin.sellers.index')
                ->with('success', "Seller '{$storeName}' dan semua datanya berhasil dihapus permanen.");

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to delete seller', [
                'store_id' => $store->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus seller.');
        }
    }

    /**
     * Send suspension notification email.
     */
    protected function sendSuspensionEmail(Store $store, string $reason): void
    {
        try {
            $user = $store->user;
            if (!$user || !$user->email) {
                return;
            }

            Mail::to($user->email)->send(new \App\Mail\SellerSuspended($store, $reason));
        } catch (\Exception $e) {
            Log::error('Failed to send suspension email', [
                'store_id' => $store->id,
                'email' => $store->user->email,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Send unsuspension notification email.
     */
    protected function sendUnsuspensionEmail(Store $store): void
    {
        try {
            $user = $store->user;
            if (!$user || !$user->email) {
                return;
            }

            Mail::to($user->email)->send(new \App\Mail\SellerUnsuspended($store));
        } catch (\Exception $e) {
            Log::error('Failed to send unsuspension email', [
                'store_id' => $store->id,
                'email' => $store->user->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
