<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminSubscriptionController extends Controller
{
    /**
     * Display all subscriptions.
     */
    public function index(Request $request): View
    {
        $query = Subscription::with('store.user')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        // Filter by plan
        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        // Filter by store
        if ($request->filled('store')) {
            $query->whereHas('store', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->store . '%')
 ->orWhere('username', 'like', '%' . $request->store . '%');
            });
        }

        $subscriptions = $query->paginate(20)->withQueryString();

        $statuses = ['pending', 'paid', 'failed', 'expired'];
        $plans = ['monthly', 'yearly'];

        return view('admin.subscriptions.index', compact(
            'subscriptions',
            'statuses',
            'plans'
        ));
    }

    /**
     * Display subscription detail.
     */
    public function show(int $id): View
    {
        $subscription = Subscription::with(['store.user', 'store.products'])
            ->findOrFail($id);

        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Update subscription status (approve/reject).
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,expired',
        ]);

        $subscription = Subscription::findOrFail($id);
        $oldStatus = $subscription->payment_status;
        $newStatus = $request->payment_status;

        $subscription->payment_status = $newStatus;

        // If setting to paid, activate the subscription
        if ($newStatus === 'paid' && $oldStatus !== 'paid') {
            $this->activateSubscription($subscription);
        }

        // If changing from paid to something else, deactivate
        if ($oldStatus === 'paid' && $newStatus !== 'paid') {
            $this->deactivateSubscription($subscription);
        }

        $subscription->save();

        // Send notification to seller
        $this->sendNotification($subscription, $newStatus);

        $message = match ($newStatus) {
            'paid' => 'Subscription berhasil di-approve. Seller akan mendapat notifikasi.',
            'pending' => 'Status subscription diubah ke pending.',
            'failed' => 'Subscription ditolak.',
            'expired' => 'Subscription ditandai expired.',
            default => 'Status subscription berhasil diperbarui.',
        };

        return redirect()->back()->with('success', $message);
    }

    /**
     * Activate subscription.
     */
    protected function activateSubscription(Subscription $subscription): void
    {
        $store = $subscription->store;

        $startsAt = now();
        $expiresAt = $subscription->plan === 'yearly'
            ? now()->addYear()
            : now()->addMonth();

        // Check if there's an existing active subscription
        $existingActive = Subscription::where('store_id', $store->id)
            ->where('payment_status', 'paid')
            ->where('expires_at', '>', now())
            ->where('id', '!=', $subscription->id)
            ->first();

        if ($existingActive) {
            $expiresAt = $existingActive->expires_at->copy();
            if ($subscription->plan === 'yearly') {
                $expiresAt->addYear();
            } else {
                $expiresAt->addMonth();
            }
        }

        $subscription->update([
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'paid_at' => now(),
        ]);

        $store->update([
            'plan' => 'pro',
            'plan_expires_at' => $expiresAt,
        ]);
    }

    /**
     * Deactivate subscription.
     */
    protected function deactivateSubscription(Subscription $subscription): void
    {
        $store = $subscription->store;

        $subscription->update([
            'starts_at' => null,
            'expires_at' => null,
            'paid_at' => null,
        ]);

        $store->update([
            'plan' => 'free',
            'plan_expires_at' => null,
        ]);
    }

    /**
     * Send notification to seller.
     */
    protected function sendNotification(Subscription $subscription, string $status): void
    {
        $user = $subscription->store->user;
        $planName = $subscription->plan === 'yearly' ? 'Pro Tahunan' : 'Pro Bulanan';

        $title = match ($status) {
            'paid' => 'Selamat! Upgrade Pro Disetujui',
            'pending' => 'Status Upgrade Pro: Menunggu Pembayaran',
            'failed' => 'Status Upgrade Pro: Ditolak',
            'expired' => 'Status Upgrade Pro: Kadaluarsa',
            default => 'Update Status Subscription',
        };

        $message = match ($status) {
            'paid' => "Selamat! Langganan {$planName} untuk toko {$subscription->store->name} telah disetujui. Fitur Pro sekarang aktif!",
            'pending' => "Langganan {$planName} untuk toko {$subscription->store->name} saat ini menunggu pembayaran. Silakan selesaikan pembayaran.",
            'failed' => "Mohon maaf, permintaan upgrade {$planName} untuk toko {$subscription->store->name} ditolak. Hubungi admin untuk informasi lebih lanjut.",
            'expired' => "Langganan {$planName} untuk toko {$subscription->store->name} telah kadaluarsa.",
            default => "Ada update untuk subscription {$planName} toko {$subscription->store->name}.",
        };

        // Create notification for the user
        $user->notifications()->create([
            'type' => 'subscription_status',
            'data' => [
                'title' => $title,
                'message' => $message,
                'subscription_id' => $subscription->id,
                'status' => $status,
                'plan' => $subscription->plan,
            ],
        ]);
    }
}
