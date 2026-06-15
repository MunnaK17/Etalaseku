<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'is_default',
        'sort_order',
        'view_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
        'sort_order' => 'integer',
        'view_count' => 'integer',
    ];

    /**
     * Get the user that owns the page.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the blocks for the page.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('sort_order');
    }

    /**
     * Get active blocks only.
     */
    public function activeBlocks(): HasMany
    {
        return $this->hasMany(Block::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get the default page for a user.
     */
    public static function getDefaultForUser(int $userId): ?self
    {
        return self::where('user_id', $userId)
            ->where('is_default', true)
            ->first();
    }

    /**
     * Ensure a user has exactly one usable default page.
     */
    public static function ensureDefaultForUser(int $userId, string $title = 'Halaman Utama', int $sortOrder = 0): self
    {
        $defaultPage = self::getDefaultForUser($userId);

        if ($defaultPage) {
            return $defaultPage;
        }

        $page = self::where('user_id', $userId)
            ->where('slug', 'home')
            ->first();

        if (!$page) {
            $page = self::where('user_id', $userId)
                ->orderBy('sort_order')
                ->first();
        }

        if ($page) {
            $page->update(['is_default' => true]);

            return $page->fresh();
        }

        return self::create([
            'user_id' => $userId,
            'title' => $title,
            'slug' => 'home',
            'is_default' => true,
            'sort_order' => $sortOrder,
        ]);
    }
}
