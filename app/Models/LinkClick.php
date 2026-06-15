<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'block_id',
        'link_type',
        'ip_address',
        'user_agent',
        'clicked_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    /**
     * Link type constants.
     */
    const TYPE_PRODUCT_CLICK = 'product_click';
    const TYPE_WHATSAPP_CLICK = 'whatsapp_click';
    const TYPE_CHECKOUT_CLICK = 'checkout_click';
    const TYPE_EXTERNAL_CLICK = 'external_click';
    const TYPE_DOWNLOAD_CLICK = 'download_click';
    const TYPE_CTA_CLICK = 'cta_click';

    /**
     * Get the product that was clicked.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the block that was clicked.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Log a click event.
     */
    public static function logClick(
        Product $product,
        string $linkType,
        ?string $ip = null,
        ?string $userAgent = null,
        ?int $blockId = null
    ): self {
        return self::create([
            'product_id' => $product->id,
            'block_id' => $blockId,
            'link_type' => $linkType,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'clicked_at' => now(),
        ]);
    }

    /**
     * Log a click event by block.
     */
    public static function logBlockClick(
        Block $block,
        string $linkType,
        ?string $ip = null,
        ?string $userAgent = null
    ): self {
        return self::create([
            'product_id' => null, // No product associated with block clicks
            'block_id' => $block->id,
            'link_type' => $linkType,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'clicked_at' => now(),
        ]);
    }

    /**
     * Get click counts by type for a product.
     */
    public static function getCountsByType(int $productId): array
    {
        return self::where('product_id', $productId)
            ->selectRaw('link_type, COUNT(*) as count')
            ->groupBy('link_type')
            ->pluck('count', 'link_type')
            ->toArray();
    }

    /**
     * Get total clicks for a product.
     */
    public static function getTotalClicks(int $productId): int
    {
        return self::where('product_id', $productId)->count();
    }

    /**
     * Get clicks for a product within a date range.
     */
    public static function getClicksInRange(int $productId, string $startDate, string $endDate): int
    {
        return self::where('product_id', $productId)
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->count();
    }

    /**
     * Get daily click counts for a product.
     */
    public static function getDailyClicks(int $productId, int $days = 7): array
    {
        $startDate = now()->subDays($days)->startOfDay();
        $endDate = now()->endOfDay();

        return self::where('product_id', $productId)
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->selectRaw('DATE(clicked_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();
    }
}
