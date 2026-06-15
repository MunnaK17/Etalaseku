<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display checkout form for a product.
     */
    public function show(Product $product)
    {
        // Load store relationship
        $store = $product->store;

        // Check if store exists
        if (!$store) {
            abort(404, 'Toko tidak ditemukan.');
        }

        // Only allow checkout for Pro stores
        if (!$store->canUseCheckout()) {
            return redirect()->route('public.store', $store->username)
                ->with('error', 'Fitur Checkout hanya tersedia untuk Plan Pro.');
        }

        // Only allow checkout for products with price
        if (!$product->price || $product->price <= 0) {
            return redirect()->route('public.store', $store->username)
                ->with('error', 'Produk ini tidak tersedia untuk checkout.');
        }

        // Check if product is active
        if (!$product->is_active) {
            return redirect()->route('public.store', $store->username)
                ->with('error', 'Produk ini tidak tersedia.');
        }

        return view('checkout.show', [
            'product' => $product,
            'store' => $store,
        ]);
    }

    /**
     * Process the checkout form and create order.
     */
    public function process(Request $request, Product $product)
    {
        $store = $product->store;

        // Check if store exists
        if (!$store) {
            abort(404, 'Toko tidak ditemukan.');
        }

        // Only allow checkout for Pro stores
        if (!$store->canUseCheckout()) {
            return redirect()->route('public.store', $store->username)
                ->with('error', 'Fitur Checkout hanya tersedia untuk Plan Pro.');
        }

        // Only allow checkout for products with price
        if (!$product->price || $product->price <= 0) {
            return redirect()->route('public.store', $store->username)
                ->with('error', 'Produk ini tidak tersedia untuk checkout.');
        }

        // Validate checkout input
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ], [
            'customer_phone.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create the order
            $order = Order::create([
                'store_id' => $store->id,
                'product_id' => $product->id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'amount' => $product->price,
                'payment_status' => 'pending',
                'order_status' => 'new',
                'order_number' => Order::generateOrderNumber(),
            ]);

            // Track checkout event
            $product->store->analytics()->create([
                'product_id' => $product->id,
                'event_type' => 'checkout_click',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Redirect to payment page with Midtrans Snap
            return redirect()->route('checkout.payment', $order->order_number);
        } catch (\Exception $e) {
            \Log::error('Checkout process error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display payment page with Midtrans Snap.
     */
    public function payment(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['product', 'store'])
            ->first();

        if (!$order) {
            Log::warning('Order not found for payment', ['orderNumber' => $orderNumber]);
            abort(404, 'Pesanan tidak ditemukan.');
        }

        // Check if Midtrans is configured
        $midtransConfigured = !empty(config('midtrans.client_key')) && !empty(config('midtrans.server_key'));

        if ($midtransConfigured) {
            try {
                $snapToken = $this->midtransService->createSnapToken($order);
                $snapUrl = $this->midtransService->getSnapUrl();

                return view('checkout.payment', [
                    'order' => $order,
                    'snapToken' => $snapToken,
                    'snapUrl' => $snapUrl,
                    'clientKey' => config('midtrans.client_key'),
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans payment error', [
                    'orderNumber' => $orderNumber,
                    'error' => $e->getMessage()
                ]);
                // If Midtrans fails, show manual payment info
                return view('checkout.payment', [
                    'order' => $order,
                    'snapToken' => null,
                    'snapUrl' => null,
                    'clientKey' => null,
                    'error' => 'Payment gateway unavailable. Please contact seller.',
                ]);
            }
        }

        // If Midtrans not configured, show manual payment info
        return view('checkout.payment', [
            'order' => $order,
            'snapToken' => null,
            'snapUrl' => null,
            'clientKey' => null,
        ]);
    }

    /**
     * Handle Midtrans notification callback.
     */
    public function callback(Request $request)
    {
        $notification = $request->all();

        if ($this->midtransService->handleNotification($notification)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Order not found']);
    }

    /**
     * Display checkout success page.
     */
    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['product', 'store'])
            ->first();

        if (!$order) {
            Log::warning('Order not found for success page', ['orderNumber' => $orderNumber]);
            abort(404, 'Pesanan tidak ditemukan.');
        }

        return view('checkout.success', [
            'order' => $order,
        ]);
    }

    /**
     * List all orders for the current seller's store.
     */
    public function index()
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding')
                ->with('error', 'Anda perlu membuat toko terlebih dahulu.');
        }

        try {
            $orders = Order::where('store_id', $store->id)
                ->with('product')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error loading orders: ' . $e->getMessage());
            $orders = collect(); // Empty collection as fallback
        }

        return view('seller.orders.index', [
            'orders' => $orders,
            'store' => $store,
        ]);
    }

    /**
     * Show order details.
     */
    public function showOrder(Order $order)
    {
        $user = auth()->user();

        if (!$user->store) {
            return redirect()->route('seller.onboarding')
                ->with('error', 'Anda perlu membuat toko terlebih dahulu.');
        }

        if ($order->store_id !== $user->store->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('seller.orders.show', [
            'order' => $order->load(['product', 'store']),
        ]);
    }

}
