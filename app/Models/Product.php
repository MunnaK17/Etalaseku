<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'name',
        'emoji',
        'description',
        'price',
        'image',
        'thumbnail',
        'product_type',
        'display_style',
        'button_color',
        'cta_type',
        'cta_url',
        'digital_file',
        'digital_product_link',
        'link_group_id',
        'is_active',
        'click_count',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the store that owns the product.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the link group that this product belongs to.
     */
    public function linkGroup(): BelongsTo
    {
        return $this->belongsTo(LinkGroup::class, 'link_group_id');
    }

    /**
     * Get the clicks for this product.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    /**
     * Get click breakdown by type.
     */
    public function getClickBreakdownAttribute(): array
    {
        return LinkClick::getCountsByType($this->id);
    }

    /**
     * Get total click count (from clicks table).
     */
    public function getTotalClicksAttribute(): int
    {
        return LinkClick::getTotalClicks($this->id);
    }

    /**
     * Increment the click count.
     */
    public function incrementClickCount(): void
    {
        $this->increment('click_count');
    }

    /**
     * Format price as currency.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price ? 'Rp ' . number_format($this->price, 0, ',', '.') : null
        );
    }

    /**
     * Generate CTA link based on type.
     */
    public function getCtaLinkAttribute(): ?string
    {
        return match ($this->cta_type) {
            'whatsapp' => $this->store->whatsapp_link,
            'external_link', 'download' => $this->cta_url,
            'checkout' => route('checkout.show', $this->id),
            default => null,
        };
    }

    /**
     * Get CTA button text.
     */
    public function getCtaButtonTextAttribute(): string
    {
        return match ($this->cta_type) {
            'whatsapp' => 'Hubungi via WhatsApp',
            'checkout' => 'Checkout',
            'download' => 'Download',
            'external_link' => 'Buka Link',
            default => 'Lihat Detail',
        };
    }

    /**
     * Get CTA button icon.
     */
    public function getCtaButtonIconAttribute(): string
    {
        return match ($this->cta_type) {
            'whatsapp' => 'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z',
            'checkout' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
            'download' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4',
            'external_link' => 'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14',
            default => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
        };
    }

    /**
     * Get CTA button color classes.
     */
    public function getCtaButtonColorClassesAttribute(): string
    {
        return match ($this->cta_type) {
            'whatsapp' => 'bg-green-500 hover:bg-green-600 text-white',
            'checkout' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
            'download' => 'bg-purple-600 hover:bg-purple-700 text-white',
            'external_link' => 'bg-gray-800 hover:bg-gray-900 text-white',
            default => 'bg-gray-600 hover:bg-gray-700 text-white',
        };
    }

    /**
     * Get WhatsApp link with product inquiry message.
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if ($this->cta_type !== 'whatsapp') {
            return null;
        }

        $message = $this->store->getProductInquiryMessage($this->name);
        return $this->store->whatsapp_link_with_message . '?text=' . urlencode($message);
    }

    /**
     * Get the tracking URL for this product.
     */
    public function getTrackingUrlAttribute(): string
    {
        return route('track.click', [
            'product' => $this->id,
            'event' => 'product_click',
        ]);
    }

    /**
     * Get the CTA tracking URL for this product.
     */
    public function getCtaTrackingUrlAttribute(): string
    {
        $event = match ($this->cta_type) {
            'whatsapp' => 'whatsapp_click',
            'checkout' => 'checkout_click',
            'external_link' => 'external_click',
            'download' => 'download_click',
            default => 'cta_click',
        };

        return route('track.click', [
            'product' => $this->id,
            'event' => $event,
        ]);
    }

    /**
     * Get badge color for product type.
     */
    public function getProductTypeBadgeClassesAttribute(): string
    {
        return match ($this->product_type) {
            'physical' => 'bg-blue-100 text-blue-700',
            'service' => 'bg-yellow-100 text-yellow-700',
            'digital' => 'bg-purple-100 text-purple-700',
            'custom' => 'bg-pink-100 text-pink-700',
            'external' => 'bg-gray-100 text-gray-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Get badge icon for product type.
     */
    public function getProductTypeIconAttribute(): string
    {
        return match ($this->product_type) {
            'physical' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            'service' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'digital' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            'custom' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
            'external' => 'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14',
            default => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        };
    }

    /**
     * Get display name with emoji prefix.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->emoji ? $this->emoji . ' ' . $this->name : $this->name;
    }

    /**
     * Get the effective image (thumbnail or image).
     */
    public function getEffectiveImageAttribute(): ?string
    {
        return $this->thumbnail ?: $this->image;
    }

    /**
     * Get display style classes.
     */
    public function getDisplayStyleClassesAttribute(): string
    {
        return match ($this->display_style) {
            'card' => 'rounded-2xl shadow-sm border border-gray-100 overflow-hidden',
            'button' => 'rounded-xl border-2 border-gray-200',
            'list' => 'rounded-lg border-b border-gray-100 last:border-b-0',
            default => 'rounded-2xl shadow-sm border border-gray-100 overflow-hidden',
        };
    }

    /**
     * Get button color classes based on custom color or default.
     */
    public function getCustomButtonColorClassesAttribute(): string
    {
        if ($this->button_color) {
            // Generate button classes from custom hex color
            return "text-white hover:opacity-90";
        }

        // Default colors based on CTA type
        return $this->ctaButtonColorClasses;
    }

    /**
     * Get inline style for custom button color.
     */
    public function getButtonInlineStyleAttribute(): ?string
    {
        if (!$this->button_color) {
            return null;
        }

        // Darken the color slightly for hover state
        $color = ltrim($this->button_color, '#');
        return "background-color: {$this->button_color};";
    }
}