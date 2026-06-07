<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    protected $casts = [
        'balance' => 'integer',
    ];

    /**
     * Get the user that owns the wallet.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for this wallet.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the withdrawals for this wallet.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get formatted balance.
     */
    public function getFormattedBalanceAttribute(): string
    {
        return 'Rp ' . number_format($this->balance, 0, ',', '.');
    }

    /**
     * Credit (add) balance to wallet.
     */
    public function credit(int $amount, ?string $description = null, ?string $referenceId = null): WalletTransaction
    {
        return DB::transaction(function () use ($amount, $description, $referenceId) {
            $this->increment('balance', $amount);

            return $this->transactions()->create([
                'type' => 'credit',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);
        });
    }

    /**
     * Debit (subtract) balance from wallet.
     * Throws exception if insufficient balance.
     */
    public function debit(int $amount, ?string $description = null, ?string $referenceId = null): WalletTransaction
    {
        if ($amount > $this->balance) {
            throw new \Exception('Insufficient balance. Current balance: ' . $this->balance);
        }

        return DB::transaction(function () use ($amount, $description, $referenceId) {
            $this->decrement('balance', $amount);

            return $this->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);
        });
    }

    /**
     * Check if wallet has sufficient balance.
     */
    public function hasSufficientBalance(int $amount): bool
    {
        return $this->balance >= $amount;
    }
}