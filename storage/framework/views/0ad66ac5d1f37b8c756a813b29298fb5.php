<?php $__env->startSection('title', 'Stores - Admin EtalaseKu'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
<h1 class="text-3xl font-bold text-gray-900">Stores</h1>
        <p class="text-gray-600">Kelola semua store di EtalaseKu</p>
    </div>

    <!-- Stores Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Store</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($store->logo): ?>
                                        <img src="<?php echo e($store->logo); ?>" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <span class="font-bold text-gray-500"><?php echo e(substr($store->name, 0, 1)); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($store->name); ?></p>
                                        <p class="text-xs text-gray-500">/<?php echo e($store->username); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900"><?php echo e($store->user->name); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($store->user->email); ?></p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($store->is_inclusive_seller): ?>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-pink-100 text-pink-800">
                                        Inclusive
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($store->plan === 'pro' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo e(ucfirst($store->plan)); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?php echo e($store->products()->count()); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($store->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="<?php echo e(route('admin.stores.show', $store->id)); ?>"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada store</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($stores->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($stores->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/admin/stores/index.blade.php ENDPATH**/ ?>