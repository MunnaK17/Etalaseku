<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the store that owns the link group.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the links for this group.
     */
    public function links(): HasMany
    {
        return $this->hasMany(Product::class, 'link_group_id')->orderBy('sort_order');
    }

    /**
     * Get active links only.
     */
    public function activeLinks(): HasMany
    {
        return $this->hasMany(Product::class, 'link_group_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate sort_order on creation
        static::creating(function ($group) {
            if (empty($group->sort_order)) {
                $group->sort_order = self::where('store_id', $group->store_id)->max('sort_order') + 1;
            }
        });
    }
}
