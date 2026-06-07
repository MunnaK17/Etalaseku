<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Subscription;
use App\Models\Wallet;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

class MidtransService
{
    protected $isProduction;

    public function __construct()
    {
        $this->isProduction = config('midtrans.environment') === 'production';

        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = $this->isProduction;
    }

    /**
     * Create Snap token for checkout
     */
    public function createSnapToken(Order $order): string
    {
        $itemDetails = [
            [
                'id' => $order->product->id,
                'name' => $order->product->name,
                'price' => (int) $order->amount,
                'quantity' => 1,
            ]
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->amount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone ?? '',
            ],
            'credit_card' => [
                'save_card' => false,
            ],
            'callbacks' => [
                'finish' => route('checkout.success', $order->order_number),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }

    /**
     * Get Snap URL for redirect
     */
    public function getSnapUrl(): string
    {
        return config('midtrans.snap_url');
    }

    /**
     * Create Snap token for subscription
     */
    public function createSubscriptionSnapToken(Subscription $subscription): string
    {
        $planName = Subscription::getPlanName($subscription->plan);

        $itemDetails = [
            [
                'id' => 'PRO-' . $subscription->plan,
                'name' => $planName,
                'price' => (int) $subscription->price,
                'quantity' => 1,
            ]
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $subscription->midtrans_order_id,
                'gross_amount' => (int) $subscription->price,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $subscription->store->user->name,
                'email' => $subscription->store->user->email,
                'phone' => $subscription->store->whatsapp ?? '',
            ],
            'credit_card' => [
                'save_card' => false,
            ],
            'callbacks' => [
                'finish' => route('seller.subscription.finish', $subscription->midtrans_order_id),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }

    /**
     * Check transaction status from Midtrans
     */
    public function checkTransactionStatus(string $orderId): ?array
    {
        try {
            $result = CoreApi::transactionStatus($orderId);
            return json_decode(json_encode($result), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Validate Midtrans notification signature
     */
    public function validateSignature(array $notification): bool
    {
        $orderId = $notification['order_id'] ?? '';
        $statusCode = $notification['status_code'] ?? '';
        $grossAmount = $notification['gross_amount'] ?? '';
        $serverKey = config('midtrans.server_key');

        $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return isset($notification['signature_key']) && $notification['signature_key'] === $signatureKey;
    }

    /**
     * Process notification from Midtrans
     * Note: For demo, we only update payment status. Wallet credit is handled manually by admin.
     */
    public function handleNotification(array $notification): bool
    {
        // Validate signature for security
        if (!config('midtrans.skip_signature_validation', false) && !$this->validateSignature($notification)) {
            \Log::warning('Midtrans notification signature validation failed', ['order_id' => $notification['order_id'] ?? 'unknown']);
            return false;
        }

        $order = Order::where('order_number', $notification['order_id'])->first();

        if (!$order) {
            return false;
        }

        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'] ?? null;
        $previousStatus = $order->payment_status;

        // Idempotency check: skip if already paid
        if ($previousStatus === 'paid') {
            return true;
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->payment_status = 'pending';
            } else if ($fraudStatus == 'accept') {
                $order->payment_status = 'paid';
                // For production, uncomment this line:
                // $this->creditSellerWallet($order);
            }
        } else if ($transactionStatus == 'settlement') {
            $order->payment_status = 'paid';
            // For production, uncomment this line:
            // $this->creditSellerWallet($order);
        } else if ($transactionStatus == 'pending') {
            $order->payment_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $order->payment_status = 'failed';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $order->payment_status = 'failed';
        }

        $order->save();

        return true;
    }

    /**
     * Credit seller wallet after successful payment
     */
    protected function creditSellerWallet(Order $order): void
    {
        // Get seller through store
        $seller = $order->store->user;

        // Calculate platform fee (5%) and seller amount
        $totalAmount = $order->amount;
        $platformFeePercent = (float) env('PLATFORM_FEE_PERCENT', 5);
        $platformFee = (int) round($totalAmount * $platformFeePercent / 100);
        $sellerAmount = $totalAmount - $platformFee;

        // Create or get wallet for seller
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $seller->id],
            ['balance' => 0]
        );

        // Credit seller wallet
        $wallet->credit(
            $sellerAmount,
            'Penjualan produk #' . $order->product_id . ' - ' . ($order->product->name ?? 'Produk'),
            $order->id
        );

        // Log the platform fee (for records)
        \Log::info('Wallet credit processed', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'total_amount' => $totalAmount,
            'platform_fee' => $platformFee,
            'seller_amount' => $sellerAmount,
            'seller_id' => $seller->id,
        ]);
    }
}
