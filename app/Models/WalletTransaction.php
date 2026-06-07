<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'description',
        'reference_id',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];

    /**
     * Get the wallet that owns this transaction.
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Get formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        $prefix = $this->type === 'credit' ? '+' : '-';
        return $prefix . 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get badge class for type.
     */
    public function getTypeBadgeClassAttribute(): string
    {
        return $this->type === 'credit'
            ? 'bg-green-100 text-green-800'
            : 'bg-red-100 text-red-800';
    }
}