<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Page;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    /**
     * Display the public store page.
     */
    public function show(string $username, Request $request)
    {
        // Find user by username in store
        $store = Store::where('username', $username)->first();

        if (!$store) {
            abort(404);
        }

        // Check if store is active
        if (!$store->is_active) {
            // Show a friendly message for inactive stores
            return response()->view('public.inactive', [
                'store' => $store,
            ], 404);
        }

        $user = $store->user;

        // Check for preview session data
        $isPreview = $request->query('preview') === '1';
        $previewData = null;

        if ($isPreview && $request->session()->has('preview_store_' . $store->id)) {
            $previewData = $request->session()->get('preview_store_' . $store->id);

            // Override store attributes with preview data
            foreach ($previewData as $key => $value) {
                if ($value !== null) {
                    $store->$key = $value;
                }
            }
        }

        // Get default page, or create/promote one if none exists
        $page = Page::ensureDefaultForUser($user->id, 'Halaman Utama', 1);

        // Get active blocks ordered by sort_order
        $blocks = Block::where('page_id', $page->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // If no blocks exist, generate blocks from products automatically
        if ($blocks->isEmpty()) {
            $blocks = $this->generateBlocksFromProducts($store, $page);
        }

        // Track page view (simple increment) - only for non-preview
        if (!$isPreview) {
            $this->trackPageView($page);
        }

        return view('public.store', [
            'store' => $store,
            'user' => $user,
            'page' => $page,
            'blocks' => $blocks,
            'isPreview' => $isPreview,
        ]);
    }

    /**
     * Display a specific public page (non-default pages).
     */
    public function showPage(string $username, string $slug, Request $request)
    {
        // Find user by username in store
        $store = Store::where('username', $username)->first();

        if (!$store) {
            abort(404);
        }

        // Check if store is active
        if (!$store->is_active) {
            // Show a friendly message for inactive stores
            return response()->view('public.inactive', [
                'store' => $store,
            ], 404);
        }

        $user = $store->user;

        // Check for preview session data
        $isPreview = $request->query('preview') === '1';
        $previewData = null;

        if ($isPreview && $request->session()->has('preview_store_' . $store->id)) {
            $previewData = $request->session()->get('preview_store_' . $store->id);

            // Override store attributes with preview data
            foreach ($previewData as $key => $value) {
                if ($value !== null) {
                    $store->$key = $value;
                }
            }
        }

        // Get the specific page by slug
        $page = Page::where('user_id', $user->id)
            ->where('slug', $slug)
            ->first();

        // If page not found, abort 404
        if (!$page) {
            abort(404);
        }

        // Get active blocks ordered by sort_order
        $blocks = Block::where('page_id', $page->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Track page view (simple increment) - only for non-preview
        if (!$isPreview) {
            $this->trackPageView($page);
        }

        return view('public.store', [
            'store' => $store,
            'user' => $user,
            'page' => $page,
            'blocks' => $blocks,
            'isPreview' => $isPreview,
        ]);
    }

    /**
     * Generate blocks from store products when no blocks exist.
     * Uses products directly without saving to database.
     */
    protected function generateBlocksFromProducts(Store $store, Page $page): \Illuminate\Support\Collection
    {
        $products = Product::where('store_id', $store->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        if ($products->isEmpty()) {
            return collect();
        }

        // Convert products to block-like objects
        return $products->map(function (Product $product) {
            return (object) [
                'id' => 'product_' . $product->id,
                'type' => 'product',
                'title' => $product->name,
                'content' => json_encode([
                    'name' => $product->name,
                    'emoji' => $product->emoji,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image' => $product->effective_image,
                    'cta_type' => $product->product_type === 'digital' ? 'checkout' : 'whatsapp',
                    'product_id' => $product->id,
                ]),
                'thumbnail_url' => $product->effective_image,
                'is_active' => true,
                'sort_order' => $product->sort_order ?? 1,
            ];
        });
    }

    /**
     * Track page view.
     */
    protected function trackPageView(Page $page): void
    {
        // Simple approach: increment a column in pages table
        $page->increment('view_count');
    }
}
