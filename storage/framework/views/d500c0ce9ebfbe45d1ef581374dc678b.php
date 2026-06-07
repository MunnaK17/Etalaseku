<?php $__env->startSection('title', 'Subscription Detail - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Subscriptions
        </a>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Subscription Detail</h1>
                    <p class="mt-1 text-gray-600">Order: <?php echo e($subscription->midtrans_order_id); ?></p>
                </div>
                <?php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        'paid' => 'bg-green-100 text-green-700 border-green-200',
                        'failed' => 'bg-red-100 text-red-700 border-red-200',
                        'expired' => 'bg-gray-100 text-gray-700 border-gray-200',
                    ];
                ?>
                <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border <?php echo e($statusColors[$subscription->payment_status] ?? ''); ?>">
                    <?php echo e(ucfirst($subscription->payment_status)); ?>

                </span>
            </div>
        </div>

        <div class="grid gap-6">
            <!-- Store & Seller Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Toko & Seller</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <?php if($subscription->store && $subscription->store->logo): ?>
                            <img src="<?php echo e($subscription->store->logo); ?>" alt="" class="h-16 w-16 rounded-xl object-cover mr-4">
                        <?php else: ?>
                            <div class="h-16 w-16 rounded-xl bg-indigo-100 flex items-center justify-center mr-4">
                                <span class="text-2xl font-bold text-indigo-600"><?php echo e(substr($subscription->store->name ?? 'S', 0, 1)); ?></span>
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-semibold text-gray-900"><?php echo e($subscription->store->name ?? 'N/A'); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e('@' . ($subscription->store->username ?? 'N/A')); ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Seller</p>
                        <p class="font-medium text-gray-900"><?php echo e($subscription->store->user->name ?? 'N/A'); ?></p>
                        <p class="text-sm text-gray-500"><?php echo e($subscription->store->user->email ?? ''); ?></p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-500">Current Plan</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo e($subscription->store->isPro() ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700'); ?>">
                            <?php echo e(ucfirst($subscription->store->plan)); ?>

                        </span>
                        <?php if($subscription->store->plan_expires_at): ?>
                            <span class="text-sm text-gray-500">
                                hingga <?php echo e($subscription->store->plan_expires_at->format('d MMM Y')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Subscription Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Subscription</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Plan</p>
                        <p class="font-medium text-gray-900">
                            <?php echo e($subscription->plan === 'yearly' ? 'Pro Tahunan' : 'Pro Bulanan'); ?>

                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Harga</p>
                        <p class="font-bold text-2xl text-gray-900">Rp <?php echo e(number_format($subscription->price, 0, ',', '.')); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pesan</p>
                        <p class="font-medium text-gray-900"><?php echo e($subscription->created_at->format('d MMMM Y, H:i')); ?></p>
                    </div>
                    <?php if($subscription->paid_at): ?>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Bayar</p>
                            <p class="font-medium text-gray-900"><?php echo e($subscription->paid_at->format('d MMMM Y, H:i')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if($subscription->starts_at): ?>
                        <div>
                            <p class="text-sm text-gray-500">Mulai</p>
                            <p class="font-medium text-gray-900"><?php echo e($subscription->starts_at->format('d MMMM Y')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if($subscription->expires_at): ?>
                        <div>
                            <p class="text-sm text-gray-500">Berakhir</p>
                            <p class="font-medium text-gray-900"><?php echo e($subscription->expires_at->format('d MMMM Y')); ?></p>
                        </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-sm text-gray-500">Order ID</p>
                        <p class="font-mono text-sm text-gray-700"><?php echo e($subscription->midtrans_order_id); ?></p>
                    </div>
                    <?php if($subscription->midtrans_transaction_id): ?>
                        <div>
                            <p class="text-sm text-gray-500">Transaction ID</p>
                            <p class="font-mono text-sm text-gray-700"><?php echo e($subscription->midtrans_transaction_id); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h2>
                <form method="POST" action="<?php echo e(route('admin.subscriptions.update-status', $subscription->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                            <select name="payment_status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pending" <?php echo e($subscription->payment_status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="paid" <?php echo e($subscription->payment_status === 'paid' ? 'selected' : ''); ?>>Paid (Approve)</option>
                                <option value="failed" <?php echo e($subscription->payment_status === 'failed' ? 'selected' : ''); ?>>Failed (Tolak)</option>
                                <option value="expired" <?php echo e($subscription->payment_status === 'expired' ? 'selected' : ''); ?>>Expired</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                                Update Status
                            </button>
                        </div>
                    </div>
                </form>

                <?php if($subscription->payment_status === 'pending'): ?>
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-yellow-800">Menunggu Pembayaran</p>
                                <p class="text-sm text-yellow-700">Seller masih menunggu untuk menyelesaikan pembayaran. Anda bisa approve manual jika diperlukan.</p>
                            </div>
                        </div>
                    </div>
                <?php elseif($subscription->payment_status === 'paid'): ?>
                    <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-800">Subscription Aktif</p>
                                <p class="text-sm text-green-700">Seller telah diaktifkan sebagai Pro user. Notifikasi telah dikirim.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/admin/subscriptions/show.blade.php ENDPATH**/ ?>