<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\LinkClick;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Track a click event and redirect to destination.
     */
    public function click(Request $request, Product $product, string $event)
    {
        $store = $product->store;

        // Validate event type
        $validEvents = [
            'product_click',
            'whatsapp_click',
            'external_click',
            'checkout_click',
            'download_click',
            'cta_click',
        ];

        $eventType = in_array($event, $validEvents) ? $event : 'cta_click';

        // Log the per-link analytics (link_clicks table)
        LinkClick::logClick(
            $product,
            $eventType,
            $request->ip(),
            $request->userAgent()
        );

        // Also log to the general analytics table for aggregate stats
        Analytics::create([
            'store_id' => $store->id,
            'product_id' => $product->id,
            'event_type' => $eventType,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        // Increment product's click_count for quick access
        $product->incrementClickCount();

        // Determine redirect URL based on event type
        $redirectUrl = $this->getRedirectUrl($product, $event);

        return redirect()->away($redirectUrl);
    }

    /**
     * Get redirect URL based on event and product CTA type.
     */
    protected function getRedirectUrl(Product $product, string $event): string
    {
        // For specific click types, redirect based on CTA type
        if (in_array($event, ['whatsapp_click', 'external_click', 'checkout_click', 'download_click'])) {
            return match ($product->cta_type) {
                'whatsapp' => $this->buildWhatsAppUrl($product),
                'external_link' => $product->cta_url ?? '/',
                'download' => $product->cta_url ?? route('checkout.simulate', $product->id),
                'checkout' => route('checkout.show', $product->id),
                default => '/',
            };
        }

        // For generic product_click, use CTA type
        return match ($product->cta_type) {
            'whatsapp' => $this->buildWhatsAppUrl($product),
            'external_link' => $product->cta_url ?? '/',
            'download' => $product->cta_url ?? '/',
            'checkout' => route('checkout.show', $product->id),
            default => $product->cta_url ?? '/',
        };
    }

    /**
     * Build WhatsApp URL with product inquiry message.
     */
    protected function buildWhatsAppUrl(Product $product): string
    {
        $store = $product->store;
        $message = $store->getProductInquiryMessage($product->name);

        if (!$store->whatsapp_link) {
            return $store->public_url;
        }

        return $store->whatsapp_link . '?text=' . urlencode($message);
    }

    /**
     * Track a page view (for API calls).
     */
    public function pageView(Request $request, string $username)
    {
        $store = Store::where('username', $username)
            ->where('is_active', true)
            ->firstOrFail();

        Analytics::create([
            'store_id' => $store->id,
            'product_id' => null,
            'event_type' => Analytics::EVENT_PAGE_VIEW,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
