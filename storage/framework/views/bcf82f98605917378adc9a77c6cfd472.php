<?php $__env->startSection('title', 'Permohonan Inklusif - Admin EtalaseKu'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Permohonan Program Inklusif</h1>
        <p class="text-gray-600">Review dan approve permohonan Inclusive Seller</p>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Store</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Disabilitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($application->store->logo): ?>
                                        <img src="<?php echo e($application->store->logo); ?>" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <span class="font-bold text-gray-500"><?php echo e(substr($application->store->name, 0, 1)); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($application->store->name); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($application->store->user->email); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900"><?php echo e(ucfirst(str_replace('_', ' ', $application->disability_type))); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($application->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($application->status_badge_class); ?>">
                                    <?php echo e($application->status_display); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="<?php echo e(route('admin.inclusive-applications.show', $application->id)); ?>"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                    Review
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada permohonan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($applications->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($applications->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/admin/inclusive-applications/index.blade.php ENDPATH**/ ?>