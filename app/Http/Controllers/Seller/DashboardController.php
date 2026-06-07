<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the seller dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $store = $user->store;

        // Get analytics summary
        $stats = [
            'total_views' => $store->analytics()->where('event_type', 'page_view')->count(),
            'product_clicks' => $store->analytics()->where('event_type', 'product_click')->count(),
            'cta_clicks' => $store->analytics()->where('event_type', 'cta_click')->count(),
            'total_products' => $store->products()->where('is_active', true)->count(),
            'total_orders' => $store->orders()->count(),
            'total_earnings' => $store->orders()
                ->where('payment_status', 'paid')
                ->sum('amount'),
        ];

        // Chart data: last 14 days views& clicks
        $chartData = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartData[] = [
                'date' => $date,
                'views' => (int) $store->analytics()
                    ->where('event_type', 'page_view')
                    ->whereDate('created_at', $date)
                    ->count(),
                'clicks' => (int) $store->analytics()
                    ->where('event_type', 'product_click')
                    ->whereDate('created_at', $date)
                    ->count(),
            ];
        }
        $stats['chart_data'] = $chartData;

        // Get recent analytics (last 7 days)
        $recentViews = $store->analytics()
            ->where('event_type', 'page_view')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        // Get popular products - count clicks from analytics table
        $productClickCounts = \App\Models\Analytics::where('store_id', $store->id)
            ->where('event_type', 'product_click')
            ->whereNotNull('product_id')
            ->selectRaw('product_id, COUNT(*) as clicks_count')
            ->groupBy('product_id')
            ->pluck('clicks_count', 'product_id');

        $popularProducts = $store->products()
            ->get()
            ->map(function ($product) use ($productClickCounts) {
                $product->clicks_count = $productClickCounts->get($product->id, 0);
                return $product;
            })
            ->sortByDesc('clicks_count')
            ->take(5);

        // Recent orders
        $recentOrders = $store->orders()
            ->with('product')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('store', 'stats', 'recentViews', 'popularProducts', 'recentOrders'));
    }
}
