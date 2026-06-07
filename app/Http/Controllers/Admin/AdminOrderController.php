<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display all orders (checkout payments).
     */
    public function index(Request $request): View
    {
        $query = Order::with(['store.user', 'product']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        // Filter by store name
        if ($request->filled('store')) {
            $query->whereHas('store', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->store . '%')
                  ->orWhere('username', 'like', '%' . $request->store . '%');
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        $statuses = ['pending', 'paid', 'failed'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Display order detail.
     */
    public function show(int $id): View
    {
        $order = Order::with(['store.user', 'product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Approve order payment and credit seller wallet.
     */
    public function approve(Order $order): RedirectResponse
    {
        // Idempotency check
        if ($order->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Order sudah pernah di-approve.');
        }

        try {
            DB::transaction(function () use ($order) {
                // Get seller and store info
                $seller = $order->store->user;
                $store = $order->store;

                // Determine platform fee based on seller plan
                $platformFeePercent = $store->isPro() ? 3 : 5;

                // Calculate amounts
                $totalAmount = $order->amount;
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
                    'Penjualan #' . $order->order_number . ' - ' . ($order->product->name ?? 'Produk'),
                    $order->id
                );

                // Update order status to paid
                $order->update(['payment_status' => 'paid']);

                // Log the platform fee
                \Log::info('Order approved - wallet credited', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'total_amount' => $totalAmount,
                    'platform_fee_percent' => $platformFeePercent,
                    'platform_fee' => $platformFee,
                    'seller_amount' => $sellerAmount,
                    'seller_id' => $seller->id,
                    'store_plan' => $store->plan,
                ]);
            });

            return redirect()->back()->with('success', 'Order berhasil di-approve. Saldo seller sudah dikredit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengapprove order: ' . $e->getMessage());
        }
    }

    /**
     * Reject order payment.
     */
    public function reject(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'note' => 'nullable|string|max:500',
        ]);

        // Check if already processed
        if ($order->payment_status !== 'pending') {
            return redirect()->back()->with('error', 'Order sudah diproses.');
        }

        try {
            DB::transaction(function () use ($order, $request) {
                // Update order status to failed
                $order->update([
                    'payment_status' => 'failed',
                ]);

                // Log rejection
                \Log::info('Order rejected', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'note' => $request->note,
                ]);
            });

            return redirect()->back()->with('success', 'Order ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak order: ' . $e->getMessage());
        }
    }
}