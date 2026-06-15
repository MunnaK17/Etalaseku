<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    /**
     * Store a new withdrawal request.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        $request->validate([
            'amount' => 'required|integer|min:10000',
        ], [
            'amount.min' => 'Minimum penarikan adalah Rp 10.000',
        ]);

        if (!$store->payout_bank_name || !$store->payout_account_number || !$store->payout_account_name) {
            return redirect()
                ->route('seller.store.edit')
                ->with('error', 'Lengkapi Payout Settings terlebih dahulu sebelum mengajukan penarikan.')
                ->with('open_payout_modal', true);
        }

        // Get wallet - always from authenticated user
        $wallet = Wallet::where('user_id', $user->id)->first();

        if (!$wallet) {
            return redirect()->back()
                ->with('error', 'Wallet tidak ditemukan.')
                ->withInput();
        }

        // Calculate available balance
        $pendingWithdrawals = $wallet->withdrawals()
            ->where('status', 'pending')
            ->sum('amount');

        $availableBalance = $wallet->balance - $pendingWithdrawals;

        // Check if sufficient balance
        if ($request->amount > $availableBalance) {
            return redirect()->back()
                ->with('error', 'Saldo tidak mencukupi. Saldo tersedia: Rp ' . number_format($availableBalance, 0, ',', '.'))
                ->withInput();
        }

        try {
            DB::transaction(function () use ($request, $store, $wallet) {
                // Debit wallet
                $wallet->debit(
                    $request->amount,
                    'Permintaan penarikan ke ' . $store->payout_bank_name . ' (' . $store->payout_account_number . ')',
                    null
                );

                // Create withdrawal record
                Withdrawal::create([
                    'wallet_id' => $wallet->id,
                    'amount' => $request->amount,
                    'bank_name' => $store->payout_bank_name,
                    'account_number' => $store->payout_account_number,
                    'account_name' => $store->payout_account_name,
                    'status' => 'pending',
                ]);
            });

            return redirect()->route('seller.wallet.index')
                ->with('success', 'Permintaan penarikan berhasil diajukan. Menunggu persetujuan admin.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengajukan penarikan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
