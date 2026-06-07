<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InclusiveProgramApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'business_name',
        'business_description',
        'reason',
        'supporting_document',
        'status',
        'admin_note',
        'reviewed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Application status constants.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the user that owns the application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the store associated with the application.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Check if application is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if application is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /**
     * Check if application is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Approve the application.
     */
    public function approve(string $note = null): bool
    {
        $this->status = self::STATUS_APPROVED;
        $this->admin_note = $note;
        $this->reviewed_at = now();

        // Update the store's inclusive seller status
        if ($this->store) {
            $this->store->update(['is_inclusive_seller' => true]);
        }

        return $this->save();
    }

    /**
     * Reject the application.
     */
    public function reject(string $note = null): bool
    {
        $this->status = self::STATUS_REJECTED;
        $this->admin_note = $note;
        $this->reviewed_at = now();

        return $this->save();
    }
}