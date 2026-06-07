<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the seller's products.
     */
    public function index(Request $request): View
    {
        $store = $request->user()->store;
        $products = $store->products()->orderBy('sort_order')->get();

        return view('seller.products.index', compact('store', 'products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(Request $request): View
    {
        $store = $request->user()->store;

        // Check product limit for free plan
        if (!$store->canAddProduct()) {
            return redirect()
                ->route('seller.products.index')
                ->with('error', 'Batas produk tercapai! Upgrade ke Plan Pro untuk produk tidak terbatas.');
        }

        return view('seller.products.create', compact('store'));
    }

    /**
     * Store a newly created product.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $store = $request->user()->store;

        // Check product limit for free plan
        if (!$store->canAddProduct()) {
            return redirect()
                ->route('seller.products.index')
                ->with('error', 'Batas produk tercapai! Upgrade ke Plan Pro untuk produk tidak terbatas.');
        }

        // Check digital product restriction
        $productType = $request->input('product_type');
        if ($productType === 'digital' && !$store->canUseDigitalProduct()) {
            return redirect()
                ->back()
                ->with('error', 'Produk digital hanya tersedia untuk Plan Pro. Upgrade untuk membuka fitur ini.');
        }

        // Check external link CTA restriction
        $ctaType = $request->input('cta_type');
        if ($ctaType === 'external_link' && !$store->canUseExternalLink()) {
            return redirect()
                ->back()
                ->with('error', 'Tautan eksternal hanya tersedia untuk Plan Pro.');
        }

        // Check checkout CTA restriction
        if ($ctaType === 'checkout' && !$store->canUseCheckout()) {
            return redirect()
                ->back()
                ->with('error', 'Fitur Checkout hanya tersedia untuk Plan Pro. Upgrade untuk membuka fitur ini.');
        }

        // Get the next sort order
        $maxSortOrder = $store->products()->max('sort_order') ?? 0;

        $product = $store->products()->create([
            ...$request->validated(),
            'sort_order' => $maxSortOrder + 1,
        ]);

        return redirect()
            ->route('seller.products.edit', $product)
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Request $request, Product $product): View
    {
        $store = $request->user()->store;

        // Ensure user owns this product's store
        if ($product->store_id !== $store->id) {
            abort(403);
        }

        return view('seller.products.edit', compact('product', 'store'));
    }

    /**
     * Update the specified product.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $store = $request->user()->store;

        if ($product->store_id !== $store->id) {
            abort(403);
        }

        // Check checkout CTA restriction on update
        $newCtaType = $request->input('cta_type');
        if ($newCtaType === 'checkout' && !$store->canUseCheckout()) {
            return redirect()
                ->back()
                ->with('error', 'Fitur Checkout hanya tersedia untuk Plan Pro. Upgrade untuk membuka fitur ini.');
        }

        $product->update($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $store = $request->user()->store;

        if ($product->store_id !== $store->id) {
            abort(403);
        }

        $product->delete();

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Toggle product active status.
     */
    public function toggleActive(Request $request, Product $product): RedirectResponse
    {
        $store = $request->user()->store;

        if ($product->store_id !== $store->id) {
            abort(403);
        }

        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "Produk berhasil {$status}!");
    }

    /**
     * Reorder products.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $store = $request->user()->store;
        $order = $request->input('order', []);

        foreach ($order as $index => $productId) {
            $product = $store->products()->find($productId);
            if ($product) {
                $product->update(['sort_order' => $index]);
            }
        }

        return response()->json(['success' => true]);
    }
}
