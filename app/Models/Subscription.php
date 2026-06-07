<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'plan',
        'price',
        'payment_status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'midtrans_transaction_status',
        'starts_at',
        'expires_at',
        'paid_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function isActive(): bool
    {
        if ($this->payment_status !== 'paid') {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public static function generateOrderId(): string
    {
        return 'SUB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -8));
    }

    public static function getPlanPrice(string $plan): int
    {
        return match ($plan) {
            'monthly' => 49000, // Rp 49.000/bulan
            'yearly' => 390000, // Rp 390.000/tahun (hemat Rp 198.000)
            default => 49000,
        };
    }

    public static function getPlanName(string $plan): string
    {
        return match ($plan) {
            'monthly' => 'Pro Bulanan',
            'yearly' => 'Pro Tahunan',
            default => 'Pro',
        };
    }
}
