<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Display wallet balance and transaction history.
     */
    public function index(): View
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // Get or create wallet
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        // Get transactions with pagination
        $transactions = $wallet->transactions()->paginate(20);

        // Get pending withdrawals
        $pendingWithdrawals = $wallet->withdrawals()
            ->where('status', 'pending')
            ->sum('amount');

        return view('wallet.index', [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'pendingWithdrawals' => $pendingWithdrawals,
            'availableBalance' => $wallet->balance - $pendingWithdrawals,
        ]);
    }

    /**
     * Display withdraw form.
     */
    public function withdraw(): View
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // Get or create wallet
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        // Calculate available balance (exclude pending withdrawals)
        $pendingWithdrawals = $wallet->withdrawals()
            ->where('status', 'pending')
            ->sum('amount');

        $availableBalance = $wallet->balance - $pendingWithdrawals;

        return view('wallet.withdraw', [
            'wallet' => $wallet,
            'availableBalance' => $availableBalance,
        ]);
    }
}