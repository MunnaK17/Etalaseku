<?php $__env->startSection('title', 'Pengaturan Etalase - EtalaseKu'); ?>
<?php $__env->startSection('breadcrumb', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pengaturan</h1>
        <p class="mt-1 text-sm text-gray-500">Kelola informasi dan pengaturan etalase <?php echo e($store->name); ?></p>
    </div>

    <!-- Lynkid Bar -->
    <div class="bg-white border border-gray-200 rounded-xl p-4 mb-6 flex items-center justify-between flex-wrap gap-3">
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-500">My Lynkid:</span>
            <span class="text-sm font-semibold text-gray-800"><?php echo e($store->public_url); ?></span>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?php echo e($store->public_url); ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-700 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.3682.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                Share
            </a>
            <button onclick="copyLink()" class="inline-flex items-center gap-2 px-3 py-1.5 border border-gray-300 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                </svg>
                Copy Link
            </button>
        </div>
    </div>

    <!-- Settings Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <!-- My Account -->
        <a href="#" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-200 transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">My Account</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Account detail, Shop information</p>
                </div>
            </div>
        </a>

        <!-- Store Management -->
        <a href="#" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-200 transition">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Store Management</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Central hub for managing your store</p>
                </div>
            </div>
        </a>

        <!-- Payout Settings -->
        <a href="#" id="payout" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-purple-200 transition">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Payout Settings</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Withdraw earnings, Bank account</p>
                </div>
            </div>
        </a>

        <!-- Advance Settings -->
        <a href="#" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-orange-200 transition">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Advance Settings</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Google Analytics, Facebook Pixel</p>
                </div>
            </div>
        </a>

        <!-- Site Settings -->
        <a href="#" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-teal-200 transition">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2112a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Site Settings</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Custom domain, Personalization</p>
                </div>
            </div>
        </a>

        <!-- Integrations -->
        <a href="#" class="bg-white border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-sm transition group">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-pink-200 transition">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a44 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a44 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Integrations</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Google Calendar, Webhooks</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Store Info Form -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Informasi Etalase</h2>
        </div>
        <div class="p-6">
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('seller.store.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Store Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Etalase</label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name', $store->name)); ?>"
 class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none transition"
                               required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Username (readonly) -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                        <div class="flex rounded-xl overflow-hidden">
                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                etalaseku.test/
                            </span>
                            <input type="text" id="username" name="username" value="<?php echo e(old('username', $store->username)); ?>"
                                   class="flex-1 rounded-r-xl border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-500"
                                   readonly>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">Username tidak dapat diubah</p>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none transition"><?php echo e(old('description', $store->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1.5">Nomor WhatsApp</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="<?php echo e(old('whatsapp', $store->whatsapp)); ?>"
                               placeholder="081234567890"
                               class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none transition">
                        <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="mt-1 text-xs text-gray-400">Nomor WhatsApp untuk customer menghubungi kamu</p>
                    </div>

                    <!-- Logo URL -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-1.5">URL Logo</label>
                        <input type="url" id="logo" name="logo" value="<?php echo e(old('logo', $store->logo)); ?>"
                               placeholder="https://"
                               class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none transition">
                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="mt-1 text-xs text-gray-400">Masukkan URL gambar logo (opsional)</p>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end mt-6">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold text-sm hover:bg-indigo-700 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Store Status -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-900">Status Etalase</h2>
        </div>
        <div class="p-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-sm text-gray-600">Etalase <?php echo e($store->is_active ? 'sedang aktif' : 'sedang nonaktif'); ?></p>
                <p class="text-xs text-gray-400 mt-0.5">
                    <?php if($store->is_active): ?>
                        Etalase kamu bisa dilihat oleh publik
                    <?php else: ?>
                        Etalase kamu tidak bisa dilihat oleh publik
                    <?php endif; ?>
                </p>
            </div>
            <form action="<?php echo e(route('seller.store.toggle-active')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 <?php echo e($store->is_active ? 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100'); ?> rounded-xl font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                    <?php echo e($store->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>

                </button>
            </form>
        </div>
    </div>

    <!-- Footer Links -->
    <div class="flex items-center justify-center gap-6 py-4">
        <a href="#" class="text-xs text-gray-400 hover:text-gray-600 transition">Terms & Conditions</a>
        <span class="text-gray-300">|</span>
        <a href="#" class="text-xs text-gray-400 hover:text-gray-600 transition">Privacy</a>
        <span class="text-gray-300">|</span>
        <a href="#" class="text-xs text-gray-400 hover:text-gray-600 transition">Contact Us</a>
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
                btn.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
                btn.classList.add('border-gray-300', 'text-gray-700');
            }, 2000);
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/seller/store/edit.blade.php ENDPATH**/ ?>