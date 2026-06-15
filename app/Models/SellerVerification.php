<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerVerification extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'nik',
        'full_name',
        'business_name',
        'business_type',
        'nib_number',
        'ktp_path',
        'npwp_path',
        'siu_path',
        'selfie_with_ktp_path',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
        'submitted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reviewed_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the store that owns the verification.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the admin who reviewed the verification.
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Check if verification is pending.
     */
    public function getIsPendingAttribute(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if verification is verified.
     */
    public function getIsVerifiedAttribute(): bool
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    /**
     * Check if verification is rejected.
     */
    public function getIsRejectedAttribute(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Get status badge class for styling.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-amber-100 text-amber-700',
            self::STATUS_VERIFIED => 'bg-green-100 text-green-700',
            self::STATUS_REJECTED => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Get status display name.
     */
    public function getStatusDisplayAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu Review',
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Unknown',
        };
    }

    /**
     * Get business type display name.
     */
    public function getBusinessTypeDisplayAttribute(): string
    {
        return match ($this->business_type) {
            'personal' => 'Personal / Perorangan',
            'company' => 'Perusahaan',
            'cooperative' => 'Koperasi',
            default => '-',
        };
    }

    /**
     * Scope a query to only include pending verifications.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include verified verifications.
     */
    public function scopeVerified($query)
    {
        return $query->where('status', self::STATUS_VERIFIED);
    }

    /**
     * Scope a query to only include rejected verifications.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}
