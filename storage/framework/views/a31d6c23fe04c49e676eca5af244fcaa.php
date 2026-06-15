<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Checkout - <?php echo e($product->name); ?> - EtalaseKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'Figtree', 'sans-serif'] },
                    colors: { primary: { 50: '#eef2ff', 100: '#e0e7ff', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca' } },
                },
            },
        }
    </script>
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        /* Skip to Content - Accessibility */
        .skip-to-content {
            position: absolute;
            left: -9999px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
            z-index: 9999;
        }
        .skip-to-content:focus {
            position: fixed;
            top: 0;
            left: 0;
            width: auto;
            height: auto;
            padding: 1rem 1.5rem;
            background: #4f46e5;
            color: white;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0 0 0.5rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            outline: 3px solid #fbbf24;
            outline-offset: 2px;
        }
        /* Focus Indicators - WCAG 2.2 AA */
        *:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
            border-radius: 4px;
        }
        *:focus:not(:focus-visible) {
            outline: none;
        }
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
        button[type="submit"]:focus-visible {
            outline: 3px solid #4338ca;
            outline-offset: 2px;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
        }
        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <!-- Skip to Content - Accessibility -->
    <a href="#checkout-form" class="skip-to-content">Langsung ke formulir checkout</a>

    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl">
        <!-- Header -->
        <header class="bg-gradient-to-br from-primary-600 to-primary-700 text-white px-5 pt-8 pb-6">
<div class="flex items-center gap-4">
                <a href="<?php echo e(route('public.store', $store->username)); ?>" class="p-2 rounded-lg bg-white/20 hover:bg-white/30 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold">Checkout</h1>
                    <p class="text-primary-100 text-sm">Lengkapi data untuk memesan</p>
                </div>
            </div>
        </header>

        <svg class="w-full h-6 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C57.1,118.92,156.63,69.08,321.39,56.44Z" fill="currentColor"></path>
        </svg>

        <!-- Product Summary -->
        <div class="px-5 -mt-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="flex gap-4 p-4">
                    <?php if($product->image): ?>
                        <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>" class="w-24 h-24 rounded-xl object-cover flex-shrink-0">
                    <?php else: ?>
                        <div class="w-24 h-24 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900"><?php echo e($product->name); ?></h3>
                        <?php if($product->description): ?>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2"><?php echo e($product->description); ?></p>
                        <?php endif; ?>
                        <div class="mt-2">
                            <span class="text-xl font-bold text-primary-600"><?php echo e($product->formatted_price); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <form id="checkout-form" action="<?php echo e(route('checkout.process', $product->id)); ?>" method="POST" class="px-5 pb-8">
            <?php echo csrf_field(); ?>
            <div class="space-y-5">
                <!-- Name -->
                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Lengkap <span class="text-red-500" aria-hidden="true">*</span>
                    </label>
                    <input type="text" id="customer_name" name="customer_name" required
                           value="<?php echo e(old('customer_name')); ?>"
                           aria-required="true"
                           aria-describedby="<?php echo e($errors->has('customer_name') ? 'customer_name-error' : ''); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Masukkan nama lengkap Anda">
                    <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p id="customer_name-error" class="mt-1 text-sm text-red-500" role="alert"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Email <span class="text-red-500" aria-hidden="true">*</span> <span class="text-gray-500">(wajib)</span>
                    </label>
                    <input type="email" id="customer_email" name="customer_email" required
                           value="<?php echo e(old('customer_email')); ?>"
                           aria-required="true"
                           aria-describedby="<?php echo e($errors->has('customer_email') ? 'customer_email-error' : ''); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition <?php $__errorArgs = ['customer_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="email@contoh.com">
                    <p class="mt-1 text-xs text-gray-500">Detail pesanan akan dikirim ke email ini.</p>
                    <?php $__errorArgs = ['customer_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p id="customer_email-error" class="mt-1 text-sm text-red-500" role="alert"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Phone -->
                <div>
                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                        No. WhatsApp <span class="text-red-500" aria-hidden="true">*</span> <span class="text-gray-500">(wajib)</span>
                    </label>
                    <input type="tel" id="customer_phone" name="customer_phone" required
                           value="<?php echo e(old('customer_phone')); ?>"
                           aria-required="true"
                           aria-describedby="<?php echo e($errors->has('customer_phone') ? 'customer_phone-error' : ''); ?>"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="08xxxxxxxxxx">
                    <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p id="customer_phone-error" class="mt-1 text-sm text-red-500" role="alert"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800 font-medium">Pesanan akan dikirim via email</p>
                            <p class="text-xs text-blue-600 mt-1">Pastikan email dan WhatsApp aktif untuk menerima detail pesanan dan konfirmasi pembayaran.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 px-6 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\EtalaseKU\resources\views/checkout/show.blade.php ENDPATH**/ ?>