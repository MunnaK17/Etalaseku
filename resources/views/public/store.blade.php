<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="{{ $store->description ?? 'Kunjungi etalase ' . $store->name }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $store->name }} - EtalaseKu</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛒</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'Figtree', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        },
                        whatsapp: {
                            500: '#25D366',
                            600: '#128C7E',
                        },
                    },
                },
            },
        }
    </script>

    <style>
        /* Smooth transitions */
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .product-card:active {
            transform: scale(0.98);
        }

        /* Hide scrollbar but allow scroll */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

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
        input:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
        a:focus-visible {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <!-- Skip to Content - Accessibility -->
    <a href="#products-section" class="skip-to-content">Langsung ke produk</a>

    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl">
        <!-- Store Header -->
        <header class="bg-gradient-to-br from-primary-600 to-primary-700 text-white">
            <div class="px-5 pt-8 pb-6">
                <!-- Profile Section -->
                <div class="flex items-center gap-4 mb-4">
                    @if($store->logo)
                        <img src="{{ $store->logo }}"
                             alt="{{ $store->name }}"
                             class="w-20 h-20 rounded-2xl object-cover border-4 border-white/20 shadow-lg">
                    @else
                        <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center border-4 border-white/20">
                            <span class="text-3xl font-bold">{{ substr($store->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">{{ $store->name }}</h1>
                        @if($store->description)
                            <p class="text-primary-100 text-sm mt-1 line-clamp-2">{{ $store->description }}</p>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons Row -->
                <div class="flex gap-3 mt-5">
                    @if($store->whatsapp)
                        <a href="{{ route('track.click', ['product' => 0, 'event' => 'whatsapp_click']) }}?store=1"
                           class="flex-1 flex items-center justify-center gap-2 bg-white text-primary-600 font-semibold py-3 px-4 rounded-xl hover:bg-primary-50 transition-all active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Chat WhatsApp</span>
                        </a>
                    @endif

                    <!-- Share Button -->
                    <button onclick="shareStore()" class="flex items-center justify-center gap-2 bg-white/20 text-white font-semibold py-3 px-4 rounded-xl hover:bg-white/30 transition-all active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Wave decoration -->
            <svg class="w-full h-6 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C57.1,118.92,156.63,69.08,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </header>

        <!-- Products Section -->
        <main id="products-section" class="px-5 py-6 -mt-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Produk</h2>
                <span class="text-sm text-gray-500">{{ $products->count() }} item</span>
            </div>

            @if($products->count() > 0)
                <div class="space-y-4">
                    @foreach($products as $product)
                        <div class="product-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <!-- Product Image -->
                            <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ $product->image }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Product Type Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold backdrop-blur-md {{ $product->product_type_badge_classes }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $product->product_type_icon }}"/>
                                        </svg>
                                        {{ ucfirst($product->product_type) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 text-lg">{{ $product->name }}</h3>

                                @if($product->description)
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</p>
                                @endif

                                <!-- Price -->
                                @if($product->price)
                                    <div class="mt-3">
                                        <span class="text-2xl font-bold text-primary-600">{{ $product->formatted_price }}</span>
                                    </div>
                                @endif

                                <!-- CTA Button -->
                                <a href="{{ route('track.click', ['product' => $product->id, 'event' => $product->cta_type === 'whatsapp' ? 'whatsapp_click' : ($product->cta_type === 'checkout' ? 'checkout_click' : ($product->cta_type === 'external_link' ? 'external_click' : 'download_click'))]) }}"
                                   class="mt-4 flex items-center justify-center gap-2 w-full py-3.5 px-4 rounded-xl font-semibold text-base transition-all {{ $product->cta_button_color_classes }} active:scale-[0.98]">
                                    @if($product->cta_type === 'whatsapp')
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    @elseif($product->cta_type === 'checkout')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    @elseif($product->cta_type === 'download')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    @elseif($product->cta_type === 'external_link')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    @endif
                                    <span>{{ $product->cta_button_text }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Belum Ada Produk</h3>
                    <p class="text-gray-500 mt-1">Toko ini belum menambahkan produk.</p>
                </div>
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-8 px-5 mt-6">
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">E</span>
                    </div>
                    <span class="font-semibold text-white">EtalaseKu</span>
                </div>
                <p class="text-sm">Buat etalase digitalmu di</p>
                <a href="{{ url('/') }}" class="text-primary-400 hover:text-primary-300 font-medium">etalaseku.test</a>
                <p class="text-xs mt-4 text-gray-500">© {{ date('Y') }} EtalaseKu. Hak cipta dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- WhatsApp Floating Button -->
    @if($store->whatsapp)
        <a href="{{ route('track.click', ['product' => 0, 'event' => 'whatsapp_click']) }}?store=1"
           aria-label="Chat WhatsApp dengan {{ $store->name }}"
           class="fixed bottom-6 right-6 z-50 bg-whatsapp-500 hover:bg-whatsapp-600 text-white p-4 rounded-full shadow-2xl transition-all hover:scale-110 active:scale-95">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    @endif

    <script>
        // Share functionality
        function shareStore() {
            const shareData = {
                title: '{{ $store->name }}',
                text: 'Lihat etalase {{ $store->name }} di EtalaseKu',
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .catch(err => console.log('Error sharing:', err));
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link berhasil disalin!');
                });
            }
        }

        // Track page view on load
        document.addEventListener('DOMContentLoaded', function() {
            const storeUsername = '{{ $store->username }}';

            // Skip tracking for bots
            const isBot = /bot|spider|crawler/i.test(navigator.userAgent);
            if (isBot) return;

            // Track page view (fire and forget)
            fetch(`/track/pageview/${storeUsername}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            }).catch(() => {});
        });
    </script>
</body>
</html>