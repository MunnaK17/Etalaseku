<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'payout_bank_name',
        'payout_account_number',
        'payout_account_name',
        'logo',
        'theme',
        'template',
        'layout',
        'banner',
        'profile_image',
        'about_text',
        'profile_text_color',
        'background_type',
        'background_color',
        'background_gradient_start',
        'background_gradient_end',
        'background_image',
        'font_family',
        'heading_font_family',
        'button_style',
        'cta_button_style',
        'cta_button_shape',
        'cta_button_color',
        'cta_button_text_color',
        'cta_button_shadow',
        'social_telegram',
        'social_website',
        'social_email',
        'social_discord',
        'social_tiktok',
        'social_instagram',
        'social_youtube',
        'social_twitch',
        'social_linkedin',
        'social_x',
        'social_facebook',
        'social_behance',
        'social_dribbble',
        'social_whatsapp',
        'social_spotify',
        'social_threads',
        'header_gradient_start',
        'header_gradient_end',
        'plan',
        'plan_expires_at',
        'is_inclusive_seller',
        'is_verified_seller',
        'verified_at',
        'is_active',
        'is_hidden',
        'is_suspended',
        'suspended_reason',
        'suspended_at',
        'suspended_by',
        'inclusive_granted_at',
        'inclusive_revoked_at',
        'inclusive_reviewed_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'plan_expires_at' => 'datetime',
        'is_inclusive_seller' => 'boolean',
        'is_verified_seller' => 'boolean',
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
        'cta_button_shadow' => 'boolean',
        'is_hidden' => 'boolean',
        'is_suspended' => 'boolean',
        'suspended_at' => 'datetime',
        'inclusive_granted_at' => 'datetime',
        'inclusive_revoked_at' => 'datetime',
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
     * Get the link groups for the store.
     */
    public function linkGroups(): HasMany
    {
        return $this->hasMany(LinkGroup::class)->orderBy('sort_order');
    }

    /**
     * Get the pages for the store (through user relationship).
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'user_id', 'user_id');
    }

    /**
     * Get verification for the store.
     */
    public function verification(): HasOne
    {
        return $this->hasOne(SellerVerification::class)->latest();
    }

    /**
     * Get active products only.
     */
    public function activeProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Check if store is verified seller.
     */
    public function isVerifiedSeller(): bool
    {
        return (bool) $this->is_verified_seller;
    }

    /**
     * Get verification status.
     */
    public function getVerificationStatusAttribute(): ?string
    {
        return $this->verification?->status;
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

        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);

        if (!preg_match('/^62[0-9]{8,14}$/', $number)) {
            return null;
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
     * Get template preset configurations from config file.
     */
    public static function getTemplatePresets(): array
    {
        return config('store_templates', []);
    }

    /**
     * Get all template keys for iteration.
     */
    public static function getAllTemplateKeys(): array
    {
        return array_keys(self::getTemplatePresets());
    }

    /**
     * Get template configuration by key.
     */
    public static function getTemplateConfig(string $key): ?array
    {
        $templates = self::getTemplatePresets();
        return $templates[$key] ?? null;
    }

    /**
     * Get current template configuration.
     */
    public function getCurrentTemplateConfig(): array
    {
        $template = $this->template ?? $this->theme ?? 'minimal';
        return self::getTemplateConfig($template) ?? self::getTemplateConfig('minimal');
    }

    /**
     * Get CSS variable styles for the current template.
     */
    public function getTemplateStylesAttribute(): string
    {
        $config = $this->getCurrentTemplateConfig();

        $styles = [
            '--bg-color: ' . ($config['bg_color'] ?? '#FFFFFF') . ';',
            '--bg-secondary: ' . ($config['bg_secondary'] ?? 'transparent') . ';',
            '--button-color: ' . ($config['button_color'] ?? '#4F46E5') . ';',
            '--text-color: ' . ($config['text_color'] ?? '#1F2937') . ';',
            '--header-start: ' . ($config['header_gradient_start'] ?? '#4F46E5') . ';',
            '--header-end: ' . ($config['header_gradient_end'] ?? '#4338CA') . ';',
            '--card-bg: ' . ($config['card_bg'] ?? '#FFFFFF') . ';',
            '--card-text: ' . ($config['card_text'] ?? '#1F2937') . ';',
        ];

        return implode(' ', $styles);
    }

    /**
     * Get background style based on template.
     */
    public function getTemplateBackgroundStyleAttribute(): string
    {
        $config = $this->getCurrentTemplateConfig();
        $bgColor = $config['bg_color'] ?? '#FFFFFF';
        $bgSecondary = $config['bg_secondary'] ?? null;
        $direction = $config['bg_gradient_direction'] ?? null;

        if ($this->background_type === 'image' && $this->background_image && $this->isPro()) {
            return "background-image: url('{$this->background_image}'); background-size: cover; background-position: center; background-attachment: fixed;";
        }

        // Use custom background settings if set, otherwise use template
        if ($this->background_color) {
            if ($this->background_type === 'gradient_up') {
                $start = $this->background_gradient_start ?? $this->header_gradient_start ?? '#4F46E5';
                return "background: linear-gradient(180deg, {$start}22 0%, {$bgColor} 100%);";
            }
            if ($this->background_type === 'gradient_down') {
                $start = $this->background_gradient_start ?? $this->header_gradient_start ?? '#4F46E5';
                return "background: linear-gradient(0deg, {$start}22 0%, {$bgColor} 100%);";
            }
            return "background-color: {$bgColor};";
        }

        // Use template background
        if ($bgSecondary && $direction) {
            $gradientDir = self::convertGradientDirection($direction);
            return "background: linear-gradient({$gradientDir}, {$bgColor}, {$bgSecondary});";
        }

        return "background-color: {$bgColor};";
    }

    /**
     * Convert gradient direction to CSS.
     */
    protected static function convertGradientDirection(string $direction): string
    {
        return match ($direction) {
            'to bottom' => '180deg',
            'to top' => '0deg',
            'to right' => '90deg',
            'to left' => '270deg',
            default => $direction, // Already in deg format like '135deg'
        };
    }

    /**
     * Get header style based on template.
     */
    public function getTemplateHeaderStyleAttribute(): string
    {
        $config = $this->getCurrentTemplateConfig();
        $start = $this->header_gradient_start ?? $config['header_gradient_start'] ?? '#4F46E5';
        $end = $this->header_gradient_end ?? $config['header_gradient_end'] ?? '#4338CA';

        return "background: linear-gradient(135deg, {$start} 0%, {$end} 100%);";
    }

    /**
     * Get CTA button style based on template.
     */
    public function getTemplateButtonStyleAttribute(): string
    {
        $config = $this->getCurrentTemplateConfig();
        $bgColor = $this->cta_button_color ?? $config['button_color'] ?? '#4F46E5';
        $textColor = $this->cta_button_text_color ?? $config['text_color'] ?? '#FFFFFF';

        $bgStyle = $this->cta_button_style === 'outline'
            ? "border: 2px solid {$bgColor}; background: transparent; color: {$bgColor};"
            : "background-color: {$bgColor}; color: {$textColor};";

        $shapeStyle = $this->ctaButtonShapeStyle;

        return $bgStyle . ' ' . $shapeStyle;
    }

    /**
     * Get special class for glow effects.
     */
    public function getTemplateSpecialClassAttribute(): ?string
    {
        $config = $this->getCurrentTemplateConfig();
        return $config['special_class'] ?? null;
    }

    // Alias for backward compatibility
    public function getTemplateSpecialClass(): ?string
    {
        $config = $this->getCurrentTemplateConfig();
        return $config['special_class'] ?? null;
    }

    /**
     * Get layout configurations.
     */
    public static function getLayouts(): array
    {
        return [
            'classic' => [
                'name' => 'Classic',
                'description' => 'Traditional vertical layout with rounded cards',
                'card_radius' => 'rounded-xl',
                'spacing' => 'normal',
            ],
            'modern' => [
                'name' => 'Modern',
                'description' => 'Sleek design with larger spacing and modern typography',
                'card_radius' => 'rounded-2xl',
                'spacing' => 'relaxed',
            ],
            'clean' => [
                'name' => 'Clean',
                'description' => 'Minimal and clean with subtle shadows',
                'card_radius' => 'rounded-lg',
                'spacing' => 'compact',
            ],
        ];
    }

    /**
     * Get available fonts.
     */
    public static function getAvailableFonts(): array
    {
        return [
            // Sans-serif fonts
            'Helvetica' => ['name' => 'Helvetica', 'category' => 'sans-serif', 'pro' => false, 'fallback' => 'system-ui', 'google_name' => null],
            'Lato' => ['name' => 'Lato', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Lato'],
            'Raleway' => ['name' => 'Raleway', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Raleway'],
            'Montserrat' => ['name' => 'Montserrat', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Montserrat'],
            'Roboto' => ['name' => 'Roboto', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Roboto'],
            'Poppins' => ['name' => 'Poppins', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Poppins'],
            'Inter' => ['name' => 'Inter', 'category' => 'sans-serif', 'pro' => false, 'google_name' => 'Inter'],

            // Serif fonts
            'Playfair Display' => ['name' => 'Playfair Display', 'category' => 'serif', 'pro' => false, 'google_name' => 'Playfair+Display'],
            'Bodoni MT' => ['name' => 'Bodoni MT', 'category' => 'serif', 'pro' => false, 'fallback' => 'serif', 'google_name' => null],

            // Display fonts
            'Letter Gothic Std' => ['name' => 'Letter Gothic', 'category' => 'display', 'pro' => false, 'fallback' => 'monospace', 'google_name' => 'Roboto+Mono'],

            // Script/Stylized fonts
            'Great Vibes' => ['name' => 'Great Vibes', 'category' => 'script', 'pro' => false, 'google_name' => 'Great+Vibes'],
            'East Sea Dokdo' => ['name' => 'East Sea Dokdo', 'category' => 'display', 'pro' => false, 'google_name' => 'East+Sea+Dokdo'],
            'Satisfy' => ['name' => 'Satisfy', 'category' => 'script', 'pro' => false, 'google_name' => 'Satisfy'],
            'Fredoka' => ['name' => 'Fredoka', 'category' => 'display', 'pro' => false, 'google_name' => 'Fredoka'],

            // Monospace
            'JetBrains Mono' => ['name' => 'JetBrains Mono', 'category' => 'monospace', 'pro' => false, 'google_name' => 'JetBrains+Mono'],
        ];
    }

    /**
     * Get social links as array (only non-empty ones).
     */
    public function getSocialLinksAttribute(): array
    {
        $socialFields = [
            'telegram',
            'website',
            'email',
            'discord',
            'tiktok',
            'instagram',
            'youtube',
            'twitch',
            'linkedin',
            'x',
            'facebook',
            'behance',
            'dribbble',
            'whatsapp',
            'spotify',
            'threads',
        ];

        $links = [];
        foreach ($socialFields as $field) {
            $value = $this->{'social_' . $field};
            if (!empty($value)) {
                $links[$field] = $this->formatSocialLink($field, $value);
            }
        }

        return $links;
    }

    /**
     * Format social link based on platform.
     */
    public function formatSocialLink(string $platform, string $value): string
    {
        // If it's already a valid URL, return as is
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        // Format based on platform
        return match ($platform) {
            'email' => "mailto:{$value}",
            'whatsapp' => $this->formatWhatsAppLink($value),
            'tiktok' => $this->formatTiktokLink($value),
            'instagram' => $this->formatInstagramLink($value),
            'x' => $this->formatTwitterLink($value),
            'facebook' => $this->formatFacebookLink($value),
            'discord' => "https://discord.gg/{$value}",
            'threads' => $this->formatThreadsLink($value),
            default => "https://{$value}",
        };
    }

    /**
     * Format WhatsApp link.
     */
    protected function formatWhatsAppLink(string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (strlen($number) <= 11 && substr($number, 0, 1) === '8') {
            $number = '62' . $number;
        }
        return "https://wa.me/{$number}";
    }

    /**
     * Format TikTok link.
     */
    protected function formatTiktokLink(string $username): string
    {
        $username = ltrim($username, '@');
        return "https://tiktok.com/@{$username}";
    }

    /**
     * Format Instagram link.
     */
    protected function formatInstagramLink(string $username): string
    {
        $username = ltrim($username, '@');
        return "https://instagram.com/{$username}";
    }

    /**
     * Format Twitter/X link.
     */
    protected function formatTwitterLink(string $username): string
    {
        $username = ltrim($username, '@');
        return "https://x.com/{$username}";
    }

    /**
     * Format Facebook link.
     */
    protected function formatFacebookLink(string $value): string
    {
        if (str_contains($value, 'facebook.com') || str_contains($value, 'fb.com')) {
            return $value;
        }
        return "https://facebook.com/{$value}";
    }

    /**
     * Format Threads link.
     */
    protected function formatThreadsLink(string $username): string
    {
        $username = ltrim($username, '@');
        return "https://threads.net/@{$username}";
    }

    /**
     * Get button style classes.
     * Uses cta_button_shape for CTA button styling.
     */
    public function getButtonStyleClassesAttribute(): string
    {
        return match ($this->cta_button_shape) {
            'arrow', 'pill', 'pill-hard' => 'rounded-full',
            'scribble' => 'rounded-xl border-dashed border-2',
            'sharp', 'sharp-hard', 'square-soft' => 'rounded-none',
            default => 'rounded-xl',
        };
    }

    /**
     * Get button shape configurations.
     */
    public static function getButtonShapes(): array
    {
        return [
            // Basic shapes
            'sharp' => [
                'name' => 'Sharp',
                'border_radius' => '0px',
                'css' => 'rounded-none',
                'preview' => 'border-radius: 0;',
            ],
            'rounded' => [
                'name' => 'Rounded',
                'border_radius' => '8px',
                'css' => 'rounded-lg',
                'preview' => 'border-radius: 8px;',
            ],
            'pill' => [
                'name' => 'Pill',
                'border_radius' => '9999px',
                'css' => 'rounded-full',
                'preview' => 'border-radius: 9999px;',
            ],

            // Hard Shadow shapes
            'sharp-hard' => [
                'name' => 'Sharp Hard',
                'border_radius' => '0px',
                'css' => 'rounded-none',
                'shadow' => '4px 4px 0px #000',
                'preview' => 'border-radius: 0; box-shadow: 4px 4px 0px #000;',
            ],
            'rounded-hard' => [
                'name' => 'Rounded Hard',
                'border_radius' => '8px',
                'css' => 'rounded-lg',
                'shadow' => '4px 4px 0px #000',
                'preview' => 'border-radius: 8px; box-shadow: 4px 4px 0px #000;',
            ],
            'pill-hard' => [
                'name' => 'Pill Hard',
                'border_radius' => '9999px',
                'css' => 'rounded-full',
                'shadow' => '4px 4px 0px #000',
                'preview' => 'border-radius: 9999px; box-shadow: 4px 4px 0px #000;',
            ],

            // Soft Shadow shapes
            'square-soft' => [
                'name' => 'Square Soft',
                'border_radius' => '0px',
                'css' => 'rounded-none',
                'shadow' => '0 4px 15px rgba(0,0,0,0.2)',
                'preview' => 'border-radius: 0; box-shadow: 0 4px 15px rgba(0,0,0,0.2);',
            ],
            'rounded-soft' => [
                'name' => 'Rounded Soft',
                'border_radius' => '8px',
                'css' => 'rounded-lg',
                'shadow' => '0 4px 15px rgba(0,0,0,0.2)',
                'preview' => 'border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);',
            ],
            'rainbow' => [
                'name' => 'Rainbow',
                'border_radius' => '8px',
                'css' => 'rounded-lg rainbow-border',
                'shadow' => '0 4px 15px rgba(0,0,0,0.2)',
                'preview' => 'border-radius: 8px; background: linear-gradient(90deg, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #8b00ff); padding: 2px;',
            ],

            // Special shapes
            'bracket' => [
                'name' => 'Bracket',
                'border_radius' => '8px',
                'css' => 'rounded-lg bracket-style',
                'preview' => 'border-radius: 8px;',
            ],
            'scribble' => [
                'name' => 'Scribble',
                'border_radius' => '8px',
                'css' => 'rounded-lg scribble-style',
                'preview' => 'border-radius: 8px;',
            ],
        ];
    }

    /**
     * Get CTA button shape CSS class.
     */
    public function getCtaButtonShapeClassAttribute(): string
    {
        $shapes = self::getButtonShapes();
        $shape = $this->cta_button_shape ?? 'rounded';

        return $shapes[$shape]['css'] ?? 'rounded-lg';
    }

    /**
     * Get CTA button shape inline style.
     */
    public function getCtaButtonShapeStyleAttribute(): string
    {
        $shapes = self::getButtonShapes();
        $shape = $this->cta_button_shape ?? 'rounded';

        $style = '';
        if (isset($shapes[$shape])) {
            if (isset($shapes[$shape]['border_radius'])) {
                $style .= 'border-radius: ' . $shapes[$shape]['border_radius'] . '; ';
            }
            if (isset($shapes[$shape]['shadow'])) {
                $style .= 'box-shadow: ' . $shapes[$shape]['shadow'] . '; ';
            }
        }

        return $style;
    }

    /**
     * Get CTA button style.
     */
    public function getCtaButtonStyleClassesAttribute(): string
    {
        $classes = $this->ctaButtonShapeClass;

        if ($this->cta_button_shadow && !isset(self::getButtonShapes()[$this->cta_button_shape ?? 'rounded']['shadow'])) {
            $classes .= ' shadow-lg';
        }

        return $classes;
    }

    /**
     * Get CTA button inline style.
     */
    public function getCtaButtonInlineStyleAttribute(): string
    {
        $bgStyle = $this->cta_button_style === 'outline'
            ? "border: 2px solid {$this->cta_button_color}; background: transparent; color: {$this->cta_button_color};"
            : "background-color: {$this->cta_button_color}; color: {$this->cta_button_text_color};";

        $shapeStyle = $this->ctaButtonShapeStyle;

        return $bgStyle . ' ' . $shapeStyle;
    }

    /**
     * Get theme configuration.
     */
    public function getThemeConfigAttribute(): array
    {
        $themes = self::getTemplatePresets();
        $themeKey = $this->theme ?? $this->template ?? 'minimal';
        return $themes[$themeKey] ?? $themes['minimal'] ?? [
            'header_gradient_start' => '#4F46E5',
            'header_gradient_end' => '#4338CA',
            'primary_color' => '#4F46E5',
        ];
    }

    /**
     * Get Google Fonts URL for the store.
     */
    public function getGoogleFontsUrlAttribute(): string
    {
        $fonts = array_filter([
            str_replace(' ', '+', $this->font_family ?? 'Inter') . ':wght@400;500;600;700',
            $this->heading_font_family ? str_replace(' ', '+', $this->heading_font_family) . ':wght@400;500;600;700' : null,
        ]);

        if (empty($fonts)) {
            return '';
        }

        return 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $fonts) . '&display=swap';
    }

    /**
     * Get background style for the store.
     */
    public function getBackgroundStyleAttribute(): string
    {
        $bgColor = $this->background_color ?? '#FFFFFF';

        if ($this->background_type === 'image' && $this->background_image && $this->isPro()) {
            return "background-image: url('{$this->background_image}'); background-size: cover; background-position: center; background-attachment: fixed;";
        }

        if ($this->background_type === 'gradient_up') {
            $start = $this->background_gradient_start ?? $this->header_gradient_start ?? '#4F46E5';
            return "background: linear-gradient(180deg, {$start}22 0%, {$bgColor} 100%);";
        }

        if ($this->background_type === 'gradient_down') {
            $start = $this->background_gradient_start ?? $this->header_gradient_start ?? '#4F46E5';
            return "background: linear-gradient(0deg, {$start}22 0%, {$bgColor} 100%);";
        }

        return "background-color: {$bgColor};";
    }

    /**
     * Get header style for the store.
     */
    public function getHeaderStyleAttribute(): string
    {
        $start = $this->header_gradient_start ?? '#4F46E5';
        $end = $this->header_gradient_end ?? '#4338CA';

        return "background: linear-gradient(135deg, {$start} 0%, {$end} 100%);";
    }

    /**
     * Check if social links feature is available.
     */
    public function canUseSocialLinks(): bool
    {
        return $this->isPro();
    }

    /**
     * Check if custom fonts feature is available.
     */
    public function canUseCustomFonts(): bool
    {
        return $this->isPro();
    }

    /**
     * Check if background image feature is available.
     */
    public function canUseBackgroundImage(): bool
    {
        return $this->isPro();
    }

    /**
     * Check if CTA customization is available.
     */
    public function canUseCtaCustomization(): bool
    {
        return $this->isPro();
    }

    /**
     * Get card style classes based on layout.
     */
    public function getCardStyleClassesAttribute(): string
    {
        $layout = $this->layout ?? 'modern';
        $layouts = self::getLayouts();

        if (!isset($layouts[$layout])) {
            return 'rounded-2xl shadow-md';
        }

        $cardStyle = $this->theme_config['card_style'] ?? 'rounded-2xl shadow-md';

        return $cardStyle;
    }

    // ============================================
    // Seller Management Methods (Admin Features)
    // ============================================

    /**
     * Scope to get visible stores only (not hidden).
     */
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }

    /**
     * Scope to get hidden stores.
     */
    public function scopeHidden($query)
    {
        return $query->where('is_hidden', true);
    }

    /**
     * Scope to get suspended stores.
     */
    public function scopeSuspended($query)
    {
        return $query->where('is_suspended', true);
    }

    /**
     * Scope to get non-suspended stores.
     */
    public function scopeNotSuspended($query)
    {
        return $query->where('is_suspended', false);
    }

    /**
     * Scope to get stores by plan.
     */
    public function scopeOfPlan($query, string $plan)
    {
        return $query->where('plan', $plan);
    }

    /**
     * Scope to get inclusive sellers.
     */
    public function scopeInclusive($query)
    {
        return $query->where('is_inclusive_seller', true);
    }

    /**
     * Check if store is hidden.
     */
    public function isHidden(): bool
    {
        return (bool) $this->is_hidden;
    }

    /**
     * Check if store is suspended.
     */
    public function isSuspended(): bool
    {
        return (bool) $this->is_suspended;
    }

    /**
     * Hide the store.
     */
    public function hide(): bool
    {
        return $this->update(['is_hidden' => true]);
    }

    /**
     * Unhide the store.
     */
    public function unhide(): bool
    {
        return $this->update(['is_hidden' => false]);
    }

    /**
     * Suspend the store with reason.
     */
    public function suspend(User $admin, string $reason): bool
    {
        return $this->update([
            'is_suspended' => true,
            'suspended_reason' => $reason,
            'suspended_at' => now(),
            'suspended_by' => $admin->id,
        ]);
    }

    /**
     * Unsuspend the store.
     */
    public function unsuspend(): bool
    {
        return $this->update([
            'is_suspended' => false,
            'suspended_reason' => null,
            'suspended_at' => null,
            'suspended_by' => null,
        ]);
    }

    /**
     * Grant inclusive seller status.
     */
    public function grantInclusive(User $admin): bool
    {
        return $this->update([
            'is_inclusive_seller' => true,
            'inclusive_granted_at' => now(),
            'inclusive_revoked_at' => null,
            'inclusive_reviewed_by' => $admin->id,
        ]);
    }

    /**
     * Revoke inclusive seller status.
     */
    public function revokeInclusive(User $admin): bool
    {
        return $this->update([
            'is_inclusive_seller' => false,
            'inclusive_revoked_at' => now(),
            'inclusive_reviewed_by' => $admin->id,
        ]);
    }

    /**
     * Cancel subscription and reset to free.
     */
    public function cancelSubscription(): bool
    {
        return $this->update([
            'plan' => 'free',
            'plan_expires_at' => null,
        ]);
    }

    /**
     * Get suspension info as array.
     */
    public function getSuspensionInfoAttribute(): ?array
    {
        if (!$this->is_suspended) {
            return null;
        }

        return [
            'reason' => $this->suspended_reason,
            'suspended_at' => $this->suspended_at,
            'suspended_by' => $this->suspended_by,
        ];
    }

    /**
     * Get inclusive status info as array.
     */
    public function getInclusiveStatusInfoAttribute(): ?array
    {
        if (!$this->is_inclusive_seller) {
            return null;
        }

        return [
            'granted_at' => $this->inclusive_granted_at,
            'revoked_at' => $this->inclusive_revoked_at,
            'reviewed_by' => $this->inclusive_reviewed_by,
        ];
    }

    /**
     * Get admin who suspended the store.
     */
    public function suspendedByAdmin(): ?User
    {
        return $this->suspended_by ? User::find($this->suspended_by) : null;
    }

    /**
     * Get admin who reviewed inclusive status.
     */
    public function inclusiveReviewedByAdmin(): ?User
    {
        return $this->inclusive_reviewed_by ? User::find($this->inclusive_reviewed_by) : null;
    }

    /**
     * Get subscription display info.
     */
    public function getSubscriptionInfoAttribute(): array
    {
        $info = [
            'plan' => $this->plan,
            'is_pro' => $this->isPro(),
            'expires_at' => $this->plan_expires_at,
            'is_expired' => $this->plan_expires_at ? $this->plan_expires_at->isPast() : false,
        ];

        if ($this->plan_expires_at) {
            $info['days_remaining'] = max(0, now()->diffInDays($this->plan_expires_at, false));
        } else {
            $info['days_remaining'] = null;
        }

        return $info;
    }
}
