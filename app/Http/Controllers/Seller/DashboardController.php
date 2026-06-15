<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\LinkClick;
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

        // Get page IDs for this store
        $pageIds = $store->pages()->pluck('id')->toArray();

        // Get block IDs for this store's pages
        $blockIds = !empty($pageIds) ? Block::whereIn('page_id', $pageIds)->pluck('id')->toArray() : [];

        // Get click breakdown by type from link_clicks table
        $clickBreakdown = !empty($blockIds)
            ? LinkClick::whereIn('block_id', $blockIds)
                ->selectRaw('link_type, COUNT(*) as count')
                ->groupBy('link_type')
                ->pluck('count', 'link_type')
                ->toArray()
            : [];

        // Get total clicks from link_clicks
        $totalClicks = !empty($blockIds) ? LinkClick::whereIn('block_id', $blockIds)->count() : 0;

        // Also get page views from analytics table
        $totalViews = $store->analytics()->where('event_type', 'page_view')->count();

        // Get total blocks count
        $totalBlocks = !empty($pageIds) ? Block::whereIn('page_id', $pageIds)->where('is_active', true)->count() : 0;

        $stats = [
            'total_views' => $totalViews,
            'total_clicks' => $totalClicks,
            'product_clicks' => $clickBreakdown['product_click'] ?? 0,
            'whatsapp_clicks' => $clickBreakdown['whatsapp_click'] ?? 0,
            'checkout_clicks' => $clickBreakdown['checkout_click'] ?? 0,
            'external_clicks' => $clickBreakdown['external_click'] ?? 0,
            'download_clicks' => $clickBreakdown['download_click'] ?? 0,
            'cta_clicks' => $clickBreakdown['cta_click'] ?? 0,
            'total_blocks' => $totalBlocks,
            'total_orders' => $store->orders()->count(),
            'total_earnings' => $store->orders()
                ->where('payment_status', 'paid')
                ->sum('amount'),
        ];

        // Chart data: last 14 days views & clicks
        $chartData = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartData[] = [
                'date' => $date,
                'views' => (int) $store->analytics()
                    ->where('event_type', 'page_view')
                    ->whereDate('created_at', $date)
                    ->count(),
                'clicks' => !empty($blockIds) ? (int) LinkClick::whereIn('block_id', $blockIds)
                    ->whereDate('clicked_at', $date)
                    ->count() : 0,
            ];
        }
        $stats['chart_data'] = $chartData;

        // Get recent clicks (last 7 days)
        $recentClicks = !empty($blockIds) ? LinkClick::whereIn('block_id', $blockIds)
            ->where('clicked_at', '>=', now()->subDays(7))
            ->count() : 0;

        // Get popular blocks from link_clicks
        $blockClickCounts = !empty($blockIds)
            ? LinkClick::whereIn('block_id', $blockIds)
                ->selectRaw('block_id, COUNT(*) as clicks_count')
                ->groupBy('block_id')
                ->pluck('clicks_count', 'block_id')
            : collect();

        $popularBlocks = !empty($pageIds)
            ? Block::whereIn('page_id', $pageIds)
                ->get()
                ->map(function ($block) use ($blockClickCounts) {
                    $block->clicks_count = $blockClickCounts->get($block->id, 0);
                    return $block;
                })
                ->sortByDesc('clicks_count')
                ->take(5)
            : collect();

        // Recent orders
        $recentOrders = $store->orders()
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('store', 'stats', 'recentClicks', 'popularBlocks', 'recentOrders'));
    }
}
