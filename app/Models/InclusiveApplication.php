<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InclusiveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'disability_type',
        'disability_certificate',
        'reason',
        'expected_benefits',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
        // New fields for public form
        'applicant_name',
        'whatsapp',
        'email',
        'ktp_file',
        'certificate_file',
        'rejection_reason',
        'user_id',
        'temp_password',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    protected $hidden = [
        'temp_password',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the store for this application.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the user created from this application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get status badge class.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'bg-green-100 text-green-800',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }

    /**
     * Get status display name.
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Menunggu Review',
        };
    }

    /**
     * Get disability type display name.
     */
    public function getDisabilityTypeDisplayAttribute(): string
    {
        return match($this->disability_type) {
            'physical' => 'Disabilitas Fisik',
            'visual' => 'Disabilitas Netra / Tunanetra',
            'hearing' => 'Disabilitas Rungu / Wicara',
            'intellectual' => 'Disabilitas Intelektual',
            'mental' => 'Disabilitas Mental / Psikososial',
            'multiple' => 'Disabilitas Ganda',
            default => $this->disability_type,
        };
    }

    /**
     * Check if application has required documents.
     */
    public function hasDocuments(): bool
    {
        return !empty($this->ktp_file) || !empty($this->certificate_file);
    }

    /**
     * Check if user account has been created.
     */
    public function hasUserAccount(): bool
    {
        return !empty($this->user_id);
    }
}
