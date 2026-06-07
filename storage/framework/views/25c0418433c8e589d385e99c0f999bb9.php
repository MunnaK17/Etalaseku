<?php $__env->startSection('title', 'Upgrade ke Pro - EtalaseKu'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Upgrade ke Plan Pro</h1>
            <p class="mt-2 text-gray-600">Buka semua fitur premium untuk toko digitalmu</p>
        </div>

        <!-- Current Plan Status -->
        <?php if($store->isPro()): ?>
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200 rounded-2xl p-6 mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-purple-900">Kamu adalah pengguna Pro!</h3>
                        <p class="text-sm text-purple-700">
                            <?php if($store->plan_expires_at): ?>
                                Berlangganan aktif hingga <?php echo e($store->plan_expires_at->format('d MMMM Y')); ?>

                            <?php else: ?>
                                Langganan aktif selamanya
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Plan Comparison -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="grid md:grid-cols-2">
                <!-- Free Plan -->
                <div class="p-8 border-b md:border-b-0 md:border-r border-gray-200">
                    <div class="text-lg font-semibold text-gray-900 mb-2">Free</div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">Rp0</div>
                    <p class="text-sm text-gray-500 mb-6">Selamanya gratis</p>

                    <ul class="space-y-3">
<li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Up to 5 produk</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Link& QR Code</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Aksesibilitas dasar</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">WhatsApp CTA</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-gray-400">Produk digital</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-gray-400">Fitur Checkout</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-gray-400">Link Eksternal</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-gray-400">Tema kustom</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-gray-400">Hapus watermark</span>
                        </li>
                    </ul>
                </div>

                <!-- Pro Plan -->
                <div class="p-8 bg-gradient-to-br from-purple-50 to-indigo-50 relative">
                    <div class="absolute top-4 right-4 bg-yellow-400 text-xs font-bold text-gray-900 px-3 py-1 rounded-full">
                        REKOMENDASI
                    </div>
                    <div class="text-lg font-semibold text-purple-900 mb-2">Pro</div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">Mulai Rp 33rb</div>
                    <p class="text-sm text-gray-500 mb-6">per bulan, billed bulanan</p>

                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Produk unlimited</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Produk digital</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Fitur Checkout + Midtrans</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Link Eksternal CTA</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">3 Tema kustom</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Hapus watermark</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Download file besar (1GB)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Analytics lanjutan</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Priority support</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pricing Plans -->
        <?php if (! ($store->isPro())): ?>
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <!-- Monthly Plan -->
                <form method="POST" action="<?php echo e(route('seller.upgrade.checkout')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="plan" value="monthly">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 hover:border-purple-300 transition-colors cursor-pointer"
                         onclick="this.querySelector('form').submit()">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pro Bulanan</h3>
                            <span class="text-2xl font-bold text-gray-900">Rp 49.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">per bulan</p>
                        <button type="submit" class="w-full py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition-colors">
                            Pilih Plan Bulanan
                        </button>
                    </div>
                </form>

                <!-- Yearly Plan -->
                <form method="POST" action="<?php echo e(route('seller.upgrade.checkout')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="plan" value="yearly">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-purple-600 p-6 relative">
                        <div class="absolute -top-3 right-4 bg-yellow-400 text-xs font-bold text-gray-900 px-3 py-1 rounded-full">
                            HEMAT 33%
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pro Tahunan</h3>
                            <span class="text-2xl font-bold text-gray-900">Rp 390.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">per tahun</p>
                        <p class="text-xs text-green-600 font-medium mb-4">Hemat Rp 198.000!</p>
                        <button type="submit" class="w-full py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition-colors">
                            Pilih Plan Tahunan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Payment Info -->
            <div class="bg-gray-50 rounded-xl p-4 text-center">
                <p class="text-sm text-gray-600">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pembayaran aman via Midtrans. Kamu bisa bayar dengan ATM, GoPay, OVO, Dana, LinkAja, atau kartu kredit.
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/seller/upgrade.blade.php ENDPATH**/ ?>