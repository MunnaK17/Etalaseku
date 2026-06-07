<?php $__env->startSection('title', 'Home - EtalaseKu'); ?>
<?php $__env->startSection('breadcrumb', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">

    <!-- Main Grid: Account Left + Earnings Right -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <!-- Account Section (Left - 2 cols) -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-semibold text-gray-800">Account</h3>
                        <?php if($store->is_inclusive_seller && $store->isPro()): ?>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Inclusive Seller
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if (! ($store->isPro())): ?>
                        <a href="<?php echo e(route('seller.upgrade')); ?>"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-700 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Upgrade to PRO
                        </a>
                    <?php endif; ?>
                </div>
                <div class="p-5">
                    <div class="flex items-start gap-5">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <?php if($store->logo): ?>
                                <img src="<?php echo e($store->logo); ?>" alt="<?php echo e($store->name); ?>" class="h-20 w-20 rounded-full object-cover border-2 border-gray-100">
                            <?php else: ?>
                                <div class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                    <span class="text-xs text-gray-400 font-medium">200 x 200</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Info -->
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-900"><?php echo e(auth()->user()->name ?? 'Seller'); ?></h2>
                            <p class="text-sm text-indigo-600 mt-0.5"><?php echo e($store->public_url); ?></p>
<div class="mt-2 flex items-center gap-2 flex-wrap">
                                <?php if($store->is_inclusive_seller && $store->isPro()): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        Inclusive (Pro)
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <?php echo e($store->inclusive_expiry_days); ?> hari tersisa
                                    </span>
                                <?php elseif($store->isPro()): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">Pro</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-xs font-semibold">Free</span>
                                <?php endif; ?>
                            </div>
<button onclick="copyLink()" class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-gray-300 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.3682.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start creating now! -->
            <div class="mt-6">
                <h3 class="text-base font-bold text-gray-900 mb-3">Start creating now!</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <a href="<?php echo e(route('seller.products.create')); ?>" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-sm transition group">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-indigo-200 transition">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a44 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-800 text-center">Add Link</span>
                    </a>

                    <a href="<?php echo e(route('seller.products.create')); ?>?type=digital" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-sm transition group">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-blue-200 transition">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M93v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-800 text-center">Digital Product</span>
                    </a>

                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-sm transition group">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-purple-200 transition">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1920H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-800 text-center">Blog Content</span>
                    </a>

                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-sm transition group">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-orange-200 transition">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1510l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-800 text-center">Course Video</span>
                    </a>

                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-sm transition group">
                        <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center mb-2 group-hover:bg-pink-200 transition">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-800 text-center">Media Kit</span>
                    </a>
                </div>
            </div>

            <!-- Total Views & Clicks -->
            <div class="mt-6 bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-800">Total Views & Clicks</h3>
                    <!-- Date Selector -->
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <input type="text" placeholder="Select Date.." readonly
                                   class="pl-9 pr-3 py-1.5 text-xs text-gray-500 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 transition w-36">
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <!-- Stats Row -->
                    <div class="flex items-center gap-6 mb-4">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                            <span class="text-xs text-gray-500">Views</span>
                            <span class="text-sm font-bold text-gray-800"><?php echo e(number_format($stats['total_views'])); ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-teal-400"></div>
                            <span class="text-xs text-gray-500">Clicks</span>
                            <span class="text-sm font-bold text-gray-800"><?php echo e(number_format($stats['product_clicks'])); ?></span>
                        </div>
                    </div>
                    <!-- Bar Chart -->
                    <div class="flex items-end gap-2 h-28">
                        <?php
                            $chartData = $stats['chart_data'] ?? [];
                            $views = array_column($chartData, 'views');
                            $clicks = array_column($chartData, 'clicks');
                            $maxVal = max(max($views ?: [0]), max($clicks ?: [0]), 1);
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $chartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex-1 flex flex-col items-center gap-1 h-full justify-end">
                                <div class="w-full flex flex-col items-center gap-0.5">
                                    <?php if(($day['views'] ?? 0) > 0): ?>
                                        <div class="w-full bg-yellow-400 rounded-sm" style="height: <?php echo e(max(4, intval($day['views']) / max(1, $maxVal) * 80)); ?>px; min-height: 4px;"></div>
                                    <?php endif; ?>
                                    <?php if(($day['clicks'] ?? 0) > 0): ?>
                                        <div class="w-full bg-teal-400 rounded-sm" style="height: <?php echo e(max(4, intval($day['clicks']) / max(1, $maxVal) * 80)); ?>px; min-height: 4px;"></div>
                                    <?php endif; ?>
                                </div>
                                <span class="text-[10px] text-gray-400"><?php echo e(\Carbon\Carbon::parse($day['date'])->format('d M')); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="flex-1 flex items-center justify-center h-full">
                                <span class="text-xs text-gray-400">Tidak ada data</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Earnings + PayMe -->
        <div class="space-y-6">
            <!-- Earnings Card -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 px-5 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-white">Earnings</h3>
                        <span class="text-xs text-green-100 font-medium">IDR</span>
                    </div>
                    <p class="text-3xl font-bold text-white mt-1">--.--</p>
                </div>
                <div class="p-5">
                    <a href="<?php echo e(route('seller.store.edit')); ?>#payout" class="flex items-center justify-between text-sm text-gray-600 hover:text-gray-900 transition">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Payout Setting Page
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- PayMe Link Card -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800">PayMe link</h3>
                </div>
                <div class="p-5">
                    <p class="text-xs text-gray-400 mb-3">Verify your account to activate</p>
                    <input type="text" placeholder="PayMe link"
                           class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-400 cursor-not-allowed"
                           readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Lifetime Sales -->
        <div class="bg-white border border-gray-200 rounded-xl p-5">
<div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <h3 class="text-xs font-medium text-gray-500">Lifetime Sales (IDR)</h3>
            </div>
            <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($stats['total_earnings'] ?? 0)); ?></p>
        </div>

        <!-- My Blocks -->
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-xs font-medium text-gray-500">My Blocks</h3>
            </div>
            <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($stats['total_products'])); ?></p>
        </div>

        <!-- Affiliate Products -->
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xs font-medium text-gray-500">Affiliate Products</h3>
            </div>
            <p class="text-2xl font-bold text-gray-900">0</p>
        </div>

        <!-- Lifetime Orders -->
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-xs font-medium text-gray-500">Lifetime Orders</h3>
            </div>
            <p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($stats['total_orders'] ?? 0)); ?></p>
        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function copyLink() {
        const url = '<?php echo e($store->public_url); ?>';
        navigator.clipboard.writeText(url).then(() => {
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Link Tersalin!
            `;
            btn.classList.remove('border-gray-300', 'text-gray-700');
            btn.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600');
                btn.classList.add('border-gray-300', 'text-gray-700');
            }, 2000);
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/seller/dashboard.blade.php ENDPATH**/ ?>