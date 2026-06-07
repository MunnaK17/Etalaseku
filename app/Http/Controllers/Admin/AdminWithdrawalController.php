<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    /**
     * Display all withdrawals.
     */
    public function index(Request $request): View
    {
        $query = Withdrawal::with(['wallet.user']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $withdrawals = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        $statuses = ['pending', 'approved', 'rejected'];

        return view('admin.withdrawals.index', compact('withdrawals', 'statuses'));
    }

    /**
     * Approve a withdrawal.
     */
    public function approve(Withdrawal $withdrawal): RedirectResponse
    {
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Withdrawal sudah diproses.');
        }

        $withdrawal->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Withdrawal berhasil disetujui. Transfer ke rekening seller.');
    }

    /**
     * Reject a withdrawal.
     */
    public function reject(Request $request, Withdrawal $withdrawal): RedirectResponse
    {
        $request->validate([
            'note' => 'nullable|string|max:500',
        ]);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Withdrawal sudah diproses.');
        }

        try {
            DB::transaction(function () use ($withdrawal, $request) {
                // Credit back to wallet
                $withdrawal->wallet->credit(
                    $withdrawal->amount,
                    'Penarikan ditolak - refund',
                    $withdrawal->id
                );

                // Update withdrawal status
                $withdrawal->update([
                    'status' => 'rejected',
                    'note' => $request->note,
                ]);
            });

            return redirect()->back()->with('success', 'Withdrawal ditolak. Saldo dikembalikan ke wallet seller.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak withdrawal: ' . $e->getMessage());
        }
    }
}