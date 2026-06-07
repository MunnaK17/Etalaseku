<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'username',
        'description',
        'whatsapp',
        'logo',
        'theme',
        'plan',
        'plan_expires_at',
        'is_inclusive_seller',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'plan_expires_at' => 'datetime',
        'is_inclusive_seller' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the store.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products for the store.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }

    /**
     * Get the analytics for the store.
     */
    public function analytics(): HasMany
    {
        return $this->hasMany(Analytics::class);
    }

    /**
     * Get the orders for the store.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get active products only.
     */
    public function activeProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Get the public URL for the store.
     */
    public function getPublicUrlAttribute(): string
    {
        return url("/{$this->username}");
    }

    /**
     * Format WhatsApp number for link.
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }

        // Remove non-digit characters
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);

        // Add country code if not present (Indonesia +62)
        if (strlen($number) <= 11 && substr($number, 0, 1) === '8') {
            $number = '62' . $number;
        }

        return "https://wa.me/{$number}";
    }

    /**
     * Generate WhatsApp link with custom message.
     */
    public function getWhatsappLinkWithMessageAttribute(?string $message = null): ?string
    {
        $baseUrl = $this->whatsapp_link;
        if (!$baseUrl) {
            return null;
        }

        if ($message) {
            return $baseUrl . '?text=' . urlencode($message);
        }

        return $baseUrl;
    }

    /**
     * Generate WhatsApp message for a product inquiry.
     */
    public function getProductInquiryMessage(string $productName): string
    {
        return "Halo, saya tertarik dengan \"{$productName}\" di etalase {$this->name}. Mohon info lebih lanjut.";
    }

    /**
     * Get QR code data URL (simple implementation).
     */
    public function getQrCodeDataUrlAttribute(): string
    {
        // Simple QR code placeholder - returns a data URL
        // In production, use a proper QR code library like bacon/bacon-qr-code
        $url = $this->public_url;
        return "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($url);
    }

    /**
     * Check if store is on Pro plan.
     */
    public function isPro(): bool
    {
        if ($this->plan !== 'pro') {
            return false;
        }

        if ($this->plan_expires_at && $this->plan_expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public function isFree(): bool
    {
        return !$this->isPro();
    }

    public function canAddProduct(): bool
    {
        if ($this->isPro()) {
            return true;
        }
        return $this->products()->count() < 5;
    }

    public function canUseDigitalProduct(): bool
    {
        return $this->isPro();
    }

    public function canUseCheckout(): bool
    {
        return $this->isPro();
    }

    public function canRemoveWatermark(): bool
    {
        return $this->isPro();
    }

    public function canUseTheme(string $theme): bool
    {
        if ($this->isPro()) {
            return true;
        }
        return $theme === 'minimal';
    }

    public function canUseExternalLink(): bool
    {
        return $this->isPro();
    }

    public function getProductLimit(): int
    {
        return $this->isPro() ? -1 : 5;
    }

    public function getRemainingProductSlots(): int
    {
        if ($this->isPro()) {
            return -1;
        }
        return max(0, 5 - $this->products()->count());
    }

    public function getPlanDisplayNameAttribute(): string
    {
        if ($this->is_inclusive_seller && $this->isPro()) {
            return 'Inclusive (Pro)';
        }
        if ($this->is_inclusive_seller && !$this->isPro()) {
            return 'Inclusive (Expired)';
        }
        return $this->isPro() ? 'Pro' : 'Free';
    }

    public function getInclusiveExpiryDaysAttribute(): ?int
    {
        if (!$this->is_inclusive_seller || !$this->plan_expires_at) {
            return null;
        }
        return max(0, now()->diffInDays($this->plan_expires_at, false));
    }

    /**
     * Get theme configuration.
     */
    public function getThemeConfigAttribute(): array
    {
        $themes = [
            'minimal' => [
                'primary_color' => '#4F46E5',
                'background_color' => '#F9FAFB',
                'card_style' => 'rounded-xl shadow-sm',
            ],
            'modern' => [
                'primary_color' => '#7C3AED',
                'background_color' => '#FFFFFF',
                'card_style' => 'rounded-2xl shadow-md',
            ],
            'bold' => [
                'primary_color' => '#059669',
                'background_color' => '#ECFDF5',
                'card_style' => 'rounded-lg border-2',
            ],
        ];

        return $themes[$this->theme] ?? $themes['minimal'];
    }
}