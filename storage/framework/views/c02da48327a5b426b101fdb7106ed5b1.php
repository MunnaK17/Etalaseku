<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <title>Pesanan Berhasil - EtalaseKu</title>
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
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl">
        <?php
$status = request('status', 'unknown');
$statusMessages = [
    'success' => ['title' => 'Pembayaran Berhasil!', 'subtitle' => 'Pesanan Anda telah dibayar dan sedang diproses', 'color' => 'green'],
    'pending' => ['title' => 'Pembayaran Pending', 'subtitle' => 'Silakan selesaikan pembayaran Anda', 'color' => 'yellow'],
    'error' => ['title' => 'Pembayaran Gagal', 'subtitle' => 'Terjadi kesalahan. Silakan coba lagi atau hubungi penjual.', 'color' => 'red'],
];
$msg = $statusMessages[$status] ?? ['title' => 'Pesanan Diterima!', 'subtitle' => 'Pesanan Anda sedang diproses oleh penjual', 'color' => 'green'];
?>

<!-- Success Header -->
<div class="bg-gradient-to-br from-<?php echo e($msg['color']); ?>-500 to-<?php echo e($msg['color']); ?>-600 text-white px-5 pt-12 pb-16 text-center">
    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
        <?php if($status === 'success'): ?>
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        <?php elseif($status === 'pending'): ?>
            <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        <?php elseif($status === 'error'): ?>
            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        <?php else: ?>
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        <?php endif; ?>
    </div>
    <h1 class="text-2xl font-bold"><?php echo e($msg['title']); ?></h1>
    <p class="text-<?php echo e($msg['color']); ?>-100 mt-2"><?php echo e($msg['subtitle']); ?></p>
</div>

        <!-- Wave -->
<svg class="w-full h-8 -mt-4 text-<?php echo e($msg['color']); ?>-500" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C57.1,118.92,156.63,69.08,321.39,56.44Z" fill="currentColor"></path>
        </svg>

        <!-- Order Details -->
        <div class="px-5 -mt-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                    <p class="text-sm text-gray-500">Nomor Pesanan</p>
                    <p class="font-bold text-gray-900"><?php echo e($order->order_number); ?></p>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Product -->
                    <div class="flex gap-4">
                        <?php if($order->product->image): ?>
                            <img src="<?php echo e($order->product->image); ?>" alt="<?php echo e($order->product->name); ?>" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                        <?php else: ?>
                            <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900"><?php echo e($order->product->name); ?></h3>
                            <p class="text-lg font-bold text-primary-600 mt-1"><?php echo e($order->formatted_amount); ?></p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3">
                        <!-- Customer Info -->
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Nama</span>
                            <span class="text-gray-900 font-medium"><?php echo e($order->customer_name); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Email</span>
                            <span class="text-gray-900 font-medium"><?php echo e($order->customer_email); ?></span>
                        </div>
                        <?php if($order->customer_phone): ?>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">WhatsApp</span>
                                <span class="text-gray-900 font-medium"><?php echo e($order->customer_phone); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Status Pembayaran</span>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($order->payment_status_badge_class); ?>">
                                <?php echo e(ucfirst($order->payment_status)); ?>

                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tanggal</span>
                            <span class="text-gray-900 font-medium"><?php echo e($order->created_at->format('d M Y, H:i')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Contact -->
            <?php if($order->store->whatsapp): ?>
                <div class="bg-green-50 border border-green-100 rounded-xl p-4 mb-6">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-green-800 font-medium">Hubungi Penjual</p>
                            <p class="text-xs text-green-600 mt-0.5">Pesanan Anda akan diproses setelah konfirmasi dari penjual.</p>
                            <a href="<?php echo e($order->store->whatsapp_link); ?>" target="_blank"
                               class="inline-flex items-center gap-1.5 mt-2 text-sm font-semibold text-green-700 hover:text-green-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back to Store -->
            <a href="<?php echo e(route('public.store', $order->store->username)); ?>"
               class="block w-full py-4 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-center transition-all mb-8">
                Kembali ke Etalase
            </a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\EtalaseKU\resources\views/checkout/success.blade.php ENDPATH**/ ?>