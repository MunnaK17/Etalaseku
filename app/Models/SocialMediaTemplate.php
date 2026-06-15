<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'url_pattern',
        'base_url',
        'category',
        'color',
        'cta_type',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get templates by category.
     */
    public static function getByCategory(string $category)
    {
        return static::where('category', $category)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get all active templates grouped by category.
     */
    public static function getGroupedByCategory()
    {
        return static::where('is_active', true)
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');
    }

    /**
     * Generate URL from pattern with username replacement.
     */
    public function generateUrl(?string $username = null): ?string
    {
        if (!$this->url_pattern || !$username) {
            return $this->base_url;
        }

        return str_replace('{username}', $username, $this->url_pattern);
    }

    /**
     * Get category display name.
     */
    public function getCategoryDisplayNameAttribute(): string
    {
        return match ($this->category) {
            'social_media' => 'Social Media',
            'marketplace' => 'Marketplace',
            'payment' => 'Payment',
            'communication' => 'Communication',
            'entertainment' => 'Entertainment',
            'other' => 'Lainnya',
            default => ucfirst($this->category),
        };
    }

    /**
     * Get category icon.
     */
    public function getCategoryIconAttribute(): string
    {
        return match ($this->category) {
            'social_media' => '📱',
            'marketplace' => '🛒',
            'payment' => '💳',
            'communication' => '💬',
            'entertainment' => '🎵',
            'other' => '🔗',
            default => '🔗',
        };
    }
}
