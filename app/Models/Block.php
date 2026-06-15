<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Json;

class Block extends Model
{
    use HasFactory;

    /**
     * Block type constants.
     */
    public const TYPE_LINK = 'link';
    public const TYPE_TEXT = 'text';
    public const TYPE_IMAGE = 'image';
    public const TYPE_VIDEO = 'video';
    public const TYPE_SOCIAL_CONNECT = 'social_connect';
    public const TYPE_PRODUCT = 'product';
    public const TYPE_DIGITAL_PRODUCT = 'digital_product';

    /**
     * Available block types.
     */
    public const BLOCK_TYPES = [
        self::TYPE_LINK,
        self::TYPE_TEXT,
        self::TYPE_IMAGE,
        self::TYPE_VIDEO,
        self::TYPE_SOCIAL_CONNECT,
        self::TYPE_PRODUCT,
        self::TYPE_DIGITAL_PRODUCT,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_id',
        'type',
        'title',
        'content',
        'thumbnail_url',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the page that owns the block.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get content as decoded JSON.
     */
    public function getContentDataAttribute(): ?array
    {
        if (!$this->content) {
            return null;
        }

        return Json::decode($this->content);
    }

    /**
     * Set content from array (auto-encoded to JSON).
     */
    public function setContentDataAttribute(?array $data): void
    {
        $this->attributes['content'] = $data ? Json::encode($data) : null;
    }

    /**
     * Get icon for block type.
     */
    public function getTypeIconAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_LINK => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
            self::TYPE_TEXT => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            self::TYPE_IMAGE => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
            self::TYPE_VIDEO => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
            self::TYPE_SOCIAL_CONNECT => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1M7.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688zM16.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688z',
            self::TYPE_PRODUCT => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            self::TYPE_DIGITAL_PRODUCT => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            default => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
        };
    }

    /**
     * Get display name for block type.
     */
    public function getTypeNameAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_LINK => 'Link',
            self::TYPE_TEXT => 'Text',
            self::TYPE_IMAGE => 'Image',
            self::TYPE_VIDEO => 'Video',
            self::TYPE_SOCIAL_CONNECT => 'Social Connect',
            self::TYPE_PRODUCT => 'Product',
            self::TYPE_DIGITAL_PRODUCT => 'Digital Product',
            default => 'Unknown',
        };
    }
}
