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
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
        ], [
            'amount.min' => 'Minimum penarikan adalah Rp 10.000',
        ]);

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
            DB::transaction(function () use ($request, $user, $wallet) {
                // Debit wallet
                $wallet->debit(
                    $request->amount,
                    'Permintaan penarikan ke ' . $request->bank_name . ' (' . $request->account_number . ')',
                    null
                );

                // Create withdrawal record
                Withdrawal::create([
                    'wallet_id' => $wallet->id,
                    'amount' => $request->amount,
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'account_name' => $request->account_name,
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