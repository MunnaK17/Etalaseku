<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analytics extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'product_id',
        'event_type',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Common event types.
     */
    const EVENT_PAGE_VIEW = 'page_view';
    const EVENT_PRODUCT_CLICK = 'product_click';
    const EVENT_CTA_CLICK = 'cta_click';
    const EVENT_WHATSAPP_CLICK = 'whatsapp_click';

    /**
     * Get the store that owns the analytics.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the product associated with the analytics.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Log a page view event.
     */
    public static function logPageView(Store $store, ?string $ip = null, ?string $userAgent = null): self
    {
        return self::create([
            'store_id' => $store->id,
            'event_type' => self::EVENT_PAGE_VIEW,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'created_at' => now(),
        ]);
    }

    /**
     * Log a product click event.
     */
    public static function logProductClick(Product $product, ?string $ip = null, ?string $userAgent = null): self
    {
        return self::create([
            'store_id' => $product->store_id,
            'product_id' => $product->id,
            'event_type' => self::EVENT_PRODUCT_CLICK,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'created_at' => now(),
        ]);
    }

    /**
     * Log a CTA click event.
     */
    public static function logCtaClick(Product $product, ?string $ip = null, ?string $userAgent = null): self
    {
        return self::create([
            'store_id' => $product->store_id,
            'product_id' => $product->id,
            'event_type' => self::EVENT_CTA_CLICK,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'created_at' => now(),
        ]);
    }
}