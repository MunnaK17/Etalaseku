<?php $__env->startSection('title', 'Permohonan Inclusive - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Permohonan Inclusive</h1>
            <p class="mt-1 text-sm" style="color: var(--text-muted);">Kelola permohonan Program Inclusive dari penyandang disabilitas</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="mb-6 grid gap-4 sm:grid-cols-4">
        <?php
            $pending = $applications->where('status', 'pending')->count();
            $approved = $applications->where('status', 'approved')->count();
            $rejected = $applications->where('status', 'rejected')->count();
        ?>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Menunggu Review</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--warning);"><?php echo e($pending); ?></p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Disetujui</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--success);"><?php echo e($approved); ?></p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Ditolak</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--error);"><?php echo e($rejected); ?></p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Total</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--text-primary);"><?php echo e($applications->total()); ?></p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-4 flex gap-2">
        <a href="<?php echo e(request()->url()); ?>"
           class="rounded-lg px-4 py-2 text-sm font-medium transition <?php echo e(!request('status') ? '' : ''); ?>"
           style="<?php echo e(!request('status') ? 'background: var(--accent); color: #000;' : 'background: var(--bg-tertiary); color: var(--text-secondary);'); ?>">
            Semua
        </a>
        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'pending'])); ?>"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="<?php echo e(request('status') === 'pending' ? 'background: var(--warning); color: #000;' : 'background: var(--bg-tertiary); color: var(--text-secondary);'); ?>">
            Menunggu
        </a>
        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'approved'])); ?>"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="<?php echo e(request('status') === 'approved' ? 'background: var(--success); color: #fff;' : 'background: var(--bg-tertiary); color: var(--text-secondary);'); ?>">
            Disetujui
        </a>
        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'rejected'])); ?>"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="<?php echo e(request('status') === 'rejected' ? 'background: var(--error); color: #fff;' : 'background: var(--bg-tertiary); color: var(--text-secondary);'); ?>">
            Ditolak
        </a>
    </div>

    <!-- Applications List -->
    <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: var(--bg-secondary);">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Applicant</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Jenis Disabilitas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Dokumen</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase" style="color: var(--text-muted);">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t transition hover:opacity-80" style="border-color: var(--border-color);">
                            <td class="px-4 py-4">
                                <div>
                                    <p class="font-medium" style="color: var(--text-primary);"><?php echo e($app->applicant_name); ?></p>
                                    <p class="text-sm" style="color: var(--text-muted);"><?php echo e($app->email); ?></p>
                                    <p class="text-sm" style="color: var(--text-muted);"><?php echo e($app->whatsapp); ?></p>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" style="background: var(--accent-light); color: var(--accent);">
                                    <?php echo e($app->disability_type_display); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm" style="color: var(--text-secondary);">
                                <?php echo e($app->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($app->status_badge_class); ?>">
                                    <?php echo e($app->status_display); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2">
                                    <?php if($app->ktp_file): ?>
                                        <a href="<?php echo e(Storage::url($app->ktp_file)); ?>" target="_blank"
                                           class="rounded px-2 py-1 text-xs font-medium transition"
                                           style="background: var(--bg-tertiary); color: var(--text-secondary);">
                                            KTP
                                        </a>
                                    <?php endif; ?>
                                    <?php if($app->certificate_file): ?>
                                        <a href="<?php echo e(Storage::url($app->certificate_file)); ?>" target="_blank"
                                           class="rounded px-2 py-1 text-xs font-medium transition"
                                           style="background: var(--bg-tertiary); color: var(--text-secondary);">
                                            Sertifikat
                                        </a>
                                    <?php endif; ?>
                                    <?php if(!$app->hasDocuments()): ?>
                                        <span class="text-xs" style="color: var(--text-muted);">-</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <a href="<?php echo e(route('admin.inclusive-applications.show', $app)); ?>"
                                   class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-medium transition"
                                   style="background: var(--accent-light); color: var(--accent);">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center" style="color: var(--text-muted);">
                                <svg class="mx-auto mb-3 h-12 w-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>Belum ada permohonan</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($applications->hasPages()): ?>
            <div class="border-t px-4 py-3" style="border-color: var(--border-color);">
                <?php echo e($applications->withQueryString()->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/admin/inclusive-applications/index.blade.php ENDPATH**/ ?>