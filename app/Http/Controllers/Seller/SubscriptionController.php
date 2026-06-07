<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Store;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display upgrade page.
     */
    public function index(): View
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // Get current subscription if exists
        $currentSubscription = Subscription::where('store_id', $store->id)
            ->where('payment_status', 'paid')
            ->orderBy('expires_at', 'desc')
            ->first();

        return view('seller.upgrade', compact('store', 'currentSubscription'));
    }

    /**
     * Initiate upgrade process.
     */
    public function checkout(Request $request): RedirectResponse
    {
        $request->validate([
            'plan' => 'required|in:monthly,yearly',
        ]);

        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // If already Pro, redirect back
        if ($store->isPro()) {
            return redirect()->back()->with('info', 'Kamu sudah berlangganan Pro.');
        }

        $plan = $request->plan;
        $price = Subscription::getPlanPrice($plan);
        $orderId = Subscription::generateOrderId();

        // Create subscription record
        $subscription = Subscription::create([
            'store_id' => $store->id,
            'plan' => $plan,
            'price' => $price,
            'payment_status' => 'pending',
            'midtrans_order_id' => $orderId,
        ]);

        // Check if Midtrans is configured
        $midtransConfigured = !empty(config('midtrans.client_key')) && !empty(config('midtrans.server_key'));

        if ($midtransConfigured) {
            try {
                $snapToken = $this->midtransService->createSubscriptionSnapToken($subscription);

                return redirect()->route('seller.subscription.payment', [
                    'order_id' => $orderId,
                ]);
            } catch (\Exception $e) {
                // If Midtrans fails, continue to manual payment
                return redirect()->route('seller.subscription.payment', [
                    'order_id' => $orderId,
                ]);
            }
        }

        // If Midtrans not configured, show manual payment
        return redirect()->route('seller.subscription.payment', [
            'order_id' => $orderId,
        ]);
    }

    /**
     * Display payment page.
     */
    public function payment(string $orderId): View
    {
        $subscription = Subscription::where('midtrans_order_id', $orderId)
            ->where('store_id', auth()->user()->store?->id)
            ->firstOrFail();

        $midtransConfigured = !empty(config('midtrans.client_key')) && !empty(config('midtrans.server_key'));

        $snapToken = null;
        $error = null;

        if ($midtransConfigured && $subscription->payment_status === 'pending') {
            try {
                $snapToken = $this->midtransService->createSubscriptionSnapToken($subscription);
            } catch (\Exception $e) {
                $error = 'Payment gateway unavailable. Please try again later.';
            }
        }

        return view('seller.subscription.payment', compact(
            'subscription',
            'snapToken',
            'error'
        ));
    }

    /**
     * Handle Midtrans callback for subscription.
     */
    public function callback(Request $request): \Illuminate\Http\JsonResponse
    {
        $notification = $request->all();

        if (empty($notification['order_id'])) {
            return response()->json(['success' => false, 'message' => 'Invalid order']);
        }

        $subscription = Subscription::where('midtrans_order_id', $notification['order_id'])->first();

        if (!$subscription) {
            return response()->json(['success' => false, 'message' => 'Subscription not found']);
        }

        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'] ?? null;

        $subscription->midtrans_transaction_id = $notification['transaction_id'] ?? null;
        $subscription->midtrans_transaction_status = $transactionStatus;

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $this->activateSubscription($subscription);
            }
        } else if ($transactionStatus === 'settlement') {
            $this->activateSubscription($subscription);
        } else if ($transactionStatus === 'pending') {
            $subscription->payment_status = 'pending';
        } else if ($transactionStatus === 'deny') {
            $subscription->payment_status = 'failed';
        } else if (in_array($transactionStatus, ['cancel', 'expire'])) {
            $subscription->payment_status = 'expired';
        }

        $subscription->save();

        return response()->json(['success' => true]);
    }

    /**
     * Handle finish redirect from Midtrans.
     */
    public function finish(string $orderId): RedirectResponse
    {
        $subscription = Subscription::where('midtrans_order_id', $orderId)
            ->where('store_id', auth()->user()->store?->id)
            ->first();

        if (!$subscription) {
            return redirect()->route('seller.upgrade')->with('error', 'Subscription not found.');
        }

        if ($subscription->payment_status === 'paid') {
            return redirect()->route('seller.upgrade')
                ->with('success', 'Selamat! Kamu sekarang adalah pengguna Pro!');
        }

        return redirect()->route('seller.subscription.payment', $orderId)
            ->with('info', 'Pembayaran masih menunggu. Silakan selesaikan pembayaran.');
    }

    /**
     * Activate subscription after successful payment.
     */
    protected function activateSubscription(Subscription $subscription): void
    {
        $store = $subscription->store;

        // Calculate subscription period
        $startsAt = now();
        $expiresAt = $subscription->plan === 'yearly'
            ? now()->addYear()
            : now()->addMonth();

        // Check if there's an existing active subscription
        $existingActive = Subscription::where('store_id', $store->id)
            ->where('payment_status', 'paid')
            ->where('expires_at', '>', now())
            ->first();

        if ($existingActive) {
            // Extend from existing expiry
            $expiresAt = $existingActive->expires_at->copy();
            if ($subscription->plan === 'yearly') {
                $expiresAt->addYear();
            } else {
                $expiresAt->addMonth();
            }
        }

        $subscription->update([
            'payment_status' => 'paid',
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'paid_at' => now(),
        ]);

        // Update store plan
        $store->update([
            'plan' => 'pro',
            'plan_expires_at' => $expiresAt,
        ]);
    }
}