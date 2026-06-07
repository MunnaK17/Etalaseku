<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran - {{ $order->product->name }} - EtalaseKu</title>
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
    @if($snapToken && $snapUrl)
    <script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl">
        <!-- Header -->
        <header class="bg-gradient-to-br from-primary-600 to-primary-700 text-white px-5 pt-8 pb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('public.store', $order->store->username) }}" class="p-2 rounded-lg bg-white/20 hover:bg-white/30 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold">Pembayaran</h1>
                    <p class="text-primary-100 text-sm">Order: {{ $order->order_number }}</p>
                </div>
            </div>
        </header>

        <svg class="w-full h-6 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C57.1,118.92,156.63,69.08,321.39,56.44Z" fill="currentColor"></path>
        </svg>

        <!-- Order Summary -->
        <div class="px-5 -mt-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">Ringkasan Pesanan</h2>
                </div>
                <div class="p-5">
                    <!-- Product -->
                    <div class="flex gap-4 mb-4">
                        @if($order->product->image)
                            <img src="{{ $order->product->image }}" alt="{{ $order->product->name }}" class="w-20 h-20 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900">{{ $order->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->product->description }}</p>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="border-t border-gray-100 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Nama</span>
                            <span class="text-gray-900 font-medium">{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Email</span>
                            <span class="text-gray-900 font-medium">{{ $order->customer_email }}</span>
                        </div>
                        @if($order->customer_phone)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">WhatsApp</span>
                                <span class="text-gray-900 font-medium">{{ $order->customer_phone }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-primary-600">{{ $order->formatted_amount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Options -->
            @if($snapToken)
                <!-- Midtrans Payment -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="bg-primary-50 px-5 py-3 border-b border-primary-100">
                        <h2 class="font-semibold text-primary-900">Pilih Metode Pembayaran</h2>
                    </div>
                    <div class="p-5">
                        <button id="pay-button" class="w-full py-4 px-6 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Bayar dengan Midtrans
                        </button>
                        <p class="text-xs text-gray-500 text-center mt-3">Mendukung: BCA, Mandiri, BNI, BRI, GoPay, OVO, Dana, dll</p>
                    </div>
                </div>

                <script>
                    document.getElementById('pay-button').addEventListener('click', function() {
                        snap.pay('{{ $snapToken }}', {
                            onSuccess: function(result) {
                                window.location.href = '{{ route('checkout.success', $order->order_number) }}?status=success';
                            },
                            onPending: function(result) {
                                window.location.href = '{{ route('checkout.success', $order->order_number) }}?status=pending';
                            },
                            onError: function(result) {
                                window.location.href = '{{ route('checkout.success', $order->order_number) }}?status=error';
                            },
                            onClose: function() {
                                // User closed the payment popup
                            }
                        });
                    });
                </script>
            @else
                <!-- Manual Payment (WhatsApp) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="bg-yellow-50 px-5 py-3 border-b border-yellow-100">
                        <h2 class="font-semibold text-yellow-900">Pembayaran Manual</h2>
                    </div>
                    <div class="p-5">
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-4">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-blue-800 font-medium">Konfirmasi via WhatsApp</p>
                                    <p class="text-xs text-blue-600 mt-1">Silakan hubungi penjual untuk konfirmasi pembayaran manual.</p>
                                </div>
                            </div>
                        </div>

                        @if($order->store->whatsapp)
                            <a href="{{ $order->store->whatsapp_link_with_message }}?text={{ urlencode('Halo, saya ingin konfirmasi pembayaran untuk pesanan ' . $order->order_number . ' seharga ' . $order->formatted_amount) }}"
                               target="_blank"
                               class="w-full py-4 px-6 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2">
 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Hubungi Penjual via WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Back to Store -->
            <a href="{{ route('public.store', $order->store->username) }}"
               class="block w-full py-4 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-center transition-all mb-8">
                Batal
            </a>
        </div>
    </div>
</body>
</html>