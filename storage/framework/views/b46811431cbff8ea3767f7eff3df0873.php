<?php $__env->startSection('title', 'Wallet - EtalaseKu'); ?>
<?php $__env->startSection('breadcrumb', 'Wallet'); ?>

<?php $__env->startPush('head'); ?>
<style>
    /* Wallet Page - Theme Aware */
    .wallet-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header */
    .wallet-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .wallet-header p {
        margin-top: 4px;
        font-size: 14px;
        color: var(--text-secondary);
    }

    /* Balance Cards Grid */
    .balance-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) {
        .balance-cards {
            grid-template-columns: 1fr;
        }
    }

    /* Balance Card Base */
    .balance-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 20px 24px;
        border: 1px solid var(--border-color);
    }
    .balance-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }
    .balance-card-label {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
    }
    .balance-card-icon {
        width: 32px;
        height: 32px;
    }
    .balance-card-amount {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }
    .balance-card-status {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* Main Balance Card (Gradient) */
    .balance-card-main {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        border: none;
    }
    .balance-card-main .balance-card-label {
        color: rgba(0, 0, 0, 0.6);
    }
    .balance-card-main .balance-card-amount {
        color: #000;
    }
    .balance-card-main .balance-card-status {
        color: rgba(0, 0, 0, 0.5);
    }
    .balance-card-main .balance-card-icon {
        color: rgba(0, 0, 0, 0.4);
    }

    /* Pending Card */
    .balance-card-pending .balance-card-icon {
        color: var(--accent);
    }
    .balance-card-pending .balance-card-amount {
        color: var(--accent);
    }

    /* Available Card */
    .balance-card-available .balance-card-icon {
        color: var(--success);
    }
    .balance-card-available .balance-card-amount {
        color: var(--success);
    }

    /* Withdraw Button */
    .withdraw-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 24px;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: black;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 24px;
        transition: all 0.2s;
    }
    .withdraw-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .withdraw-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Warning Alert */
    .wallet-warning {
        background: var(--accent-light);
        border: 1px solid var(--accent);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .wallet-warning svg {
        width: 20px;
        height: 20px;
        color: var(--accent);
        flex-shrink: 0;
    }
    .wallet-warning p {
        font-size: 14px;
        color: var(--accent);
    }

    /* Transaction Table Card */
    .transaction-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    .transaction-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
    }
    .transaction-header h2 {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Table */
    .transaction-table {
        width: 100%;
    }
    .transaction-table th {
        padding: 14px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
    }
    .transaction-table td {
        padding: 16px 20px;
        font-size: 14px;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-color);
    }
    .transaction-table tr:last-child td {
        border-bottom: none;
    }
    .transaction-table tr:hover td {
        background: var(--bg-hover);
    }
    .transaction-table .amount-credit {
        color: var(--success);
        font-weight: 600;
    }
    .transaction-table .amount-debit {
        color: var(--danger);
        font-weight: 600;
    }
    .transaction-table .ref-mono {
        font-family: 'JetBrains Mono', monospace;
        color: var(--text-muted);
    }

    /* Type Badge */
    .type-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .type-badge-credit {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success);
    }
    .type-badge-debit {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
    }

    /* Empty State */
    .empty-state {
        padding: 48px 24px;
        text-align: center;
    }
    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--text-muted);
        margin: 0 auto 16px;
    }
    .empty-state p {
        font-size: 14px;
        color: var(--text-muted);
    }
    .empty-state p + p {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 16px 20px;
        border-top: 1px solid var(--border-color);
    }
    .pagination-wrapper a {
        color: var(--accent);
    }
    .pagination-wrapper span {
        color: var(--text-secondary);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="wallet-container">
        <!-- Header -->
        <div class="wallet-header mb-8">
            <h1>Wallet</h1>
            <p>Kelola saldo dan riwayat transaksi</p>
        </div>

        <!-- Balance Cards -->
        <div class="balance-cards">
            <!-- Current Balance -->
            <div class="balance-card balance-card-main">
                <div class="balance-card-header">
                    <span class="balance-card-label">Saldo Saat Ini</span>
                    <svg class="balance-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="balance-card-amount"><?php echo e($wallet->formatted_balance); ?></p>
                <p class="balance-card-status">Tersedia untuk withdrawn</p>
            </div>

            <!-- Pending Withdrawals -->
            <div class="balance-card balance-card-pending">
                <div class="balance-card-header">
                    <span class="balance-card-label">Menunggu Approval</span>
                    <svg class="balance-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="balance-card-amount">Rp <?php echo e(number_format($pendingWithdrawals, 0, ',', '.')); ?></p>
                <p class="balance-card-status">Sedang diproses</p>
            </div>

            <!-- Available Balance -->
            <div class="balance-card balance-card-available">
                <div class="balance-card-header">
                    <span class="balance-card-label">Saldo Available</span>
                    <svg class="balance-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="balance-card-amount">Rp <?php echo e(number_format($availableBalance, 0, ',', '.')); ?></p>
                <p class="balance-card-status">Bisa di-withdraw</p>
            </div>
        </div>

        <!-- Withdraw Button -->
        <?php if($availableBalance >= 10000): ?>
            <a href="<?php echo e(route('seller.wallet.withdraw.form')); ?>" class="withdraw-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Ajukan Penarikan
            </a>
        <?php elseif($availableBalance > 0 && $availableBalance < 10000): ?>
            <div class="wallet-warning">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <p>Minimum penarikan adalah Rp 10.000. Saldo available kamu sekarang: Rp <?php echo e(number_format($availableBalance, 0, ',', '.')); ?></p>
            </div>
        <?php endif; ?>

        <!-- Transaction History -->
        <div class="transaction-card">
            <div class="transaction-header">
                <h2>Riwayat Transaksi</h2>
            </div>

            <?php if($transactions->count() > 0): ?>
                <div class="overflow-x-auto">
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Referensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($transaction->created_at->format('d M Y, H:i')); ?></td>
                                    <td><?php echo e($transaction->description ?? '-'); ?></td>
                                    <td>
                                        <span class="type-badge type-badge-<?php echo e($transaction->type); ?>">
                                            <?php echo e(ucfirst($transaction->type)); ?>

                                        </span>
                                    </td>
                                    <td class="<?php echo e($transaction->type === 'credit' ? 'amount-credit' : 'amount-debit'); ?>">
                                        <?php echo e($transaction->formatted_amount); ?>

                                    </td>
                                    <td>
                                        <?php if($transaction->reference_id): ?>
                                            <span class="ref-mono">#<?php echo e($transaction->reference_id); ?></span>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    <?php echo e($transactions->links()); ?>

                </div>
            <?php else: ?>
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p>Belum ada transaksi</p>
                    <p>Saldo akan bertambah setelah ada penjualan produk</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/wallet/index.blade.php ENDPATH**/ ?>