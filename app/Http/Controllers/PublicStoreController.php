<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicStoreController extends Controller
{
    /**
     * Display the public store page.
     */
    public function show(Request $request, string $username): View
    {
        $store = Store::where('username', $username)
            ->where('is_active', true)
            ->firstOrFail();

        // Log page view
        Analytics::logPageView(
            $store,
            $request->ip(),
            $request->userAgent()
        );

        // Get active products only
        $products = $store->activeProducts;

        return view('public.store', compact('store', 'products'));
    }

    /**
     * Log product click event.
     */
    public function productClick(Request $request, string $username, Product $product): \Illuminate\Http\JsonResponse
    {
        $store = Store::where('username', $username)
            ->where('is_active', true)
            ->firstOrFail();

        // Ensure product belongs to this store
        if ($product->store_id !== $store->id) {
            abort(404);
        }

        // Log product click
        Analytics::logProductClick(
            $product,
            $request->ip(),
            $request->userAgent()
        );

        return response()->json(['success' => true]);
    }

    /**
     * Handle CTA click (redirect to WhatsApp, external link, etc).
     */
    public function ctaClick(Request $request, string $username, Product $product): \Illuminate\Http\RedirectResponse
    {
        $store = Store::where('username', $username)
            ->where('is_active', true)
            ->firstOrFail();

        if ($product->store_id !== $store->id) {
            abort(404);
        }

        // Log CTA click
        Analytics::logCtaClick(
            $product,
            $request->ip(),
            $request->userAgent()
        );

        // Redirect based on CTA type
        $redirectUrl = match ($product->cta_type) {
            'whatsapp' => $store->whatsapp_link,
            'external_link', 'download' => $product->cta_url,
            default => $product->cta_url ?? '/',
        };

        return redirect()->away($redirectUrl);
    }

    /**
     * Simulate checkout (placeholder for future implementation).
     */
    public function simulateCheckout(Request $request, Product $product): View
    {
        $store = $product->store;

        if (!$store->is_active || !$product->is_active) {
            abort(404);
        }

        return view('public.checkout-simulate', compact('store', 'product'));
    }
}
