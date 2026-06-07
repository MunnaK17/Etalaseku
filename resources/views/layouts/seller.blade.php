<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Seller - EtalaseKu')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Figtree', 'sans-serif'] },
                },
            },
        }
    </script>
    <style>
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

        /* Focus Indicators - WCAG 2.2 AA (3:1 ratio) */
        *:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
            border-radius: 4px;
        }
        /* Remove outline for mouse users */
        *:focus:not(:focus-visible) {
            outline: none;
        }
        /* Buttons and interactive elements */
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible,
        [tabindex]:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
        /* High contrast focus for important actions */
        .btn-primary:focus-visible,
        button[type="submit"]:focus-visible {
            outline: 3px solid #4338ca;
            outline-offset: 2px;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            *:focus-visible {
                outline-width: 4px;
                outline-style: solid;
            }
        }
        .high-contrast *, .high-contrast *::before, .high-contrast *::after {
            border-color: #000 !important;
        }
        .high-contrast {
            --tw-shadow: 0 0 0 2px #000;
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
        .reduce-motion *, .reduce-motion *::before, .reduce-motion *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    </style>
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Skip to Content - Accessibility -->
    <a href="#main-content" class="skip-to-content">Langsung ke konten utama</a>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-700 flex flex-col fixed h-full z-30">
            <!-- Logo -->
            <div class="px-6 py-5 border-b border-indigo-800">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-indigo-700 font-bold text-lg">E</span>
                    </div>
                    <div>
                        <span class="font-bold text-lg text-white">EtalaseKu</span>
                        <p class="text-xs text-indigo-300">Panel Seller</p>
                    </div>
                </a>
            </div>

            <!-- Store Badge -->
            @if(isset($store) && $store)
                <div class="px-4 py-3 border-b border-indigo-800">
                    <div class="flex items-center gap-2">
                        @if($store->logo)
                            <img src="{{ $store->logo }}" alt="" class="w-8 h-8 rounded-lg object-cover">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-indigo-800 flex items-center justify-center">
                                <span class="font-bold text-white text-sm">{{ substr($store->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-white text-sm truncate">{{ $store->name }}</p>
                            <span class="inline-flex px-1.5 py-0.5 rounded text-xs font-medium bg-indigo-800 text-indigo-200">
                                {{ $store->plan_display_name }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="px-4 py-2 text-xs font-semibold text-indigo-400 uppercase tracking-wider">Menu</p>

                <a href="{{ route('seller.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.dashboard') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('seller.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.products.*') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Produk
                </a>

                <a href="{{ route('seller.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.orders.*') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Pesanan
                    @php
                        $pendingOrders = 0;
                        if (isset($store)) {
                            $pendingOrders = \App\Models\Order::where('store_id', $store->id)->whereIn('order_status', ['pending', 'paid'])->count();
                        }
                    @endphp
                    @if($pendingOrders > 0)
                        <span class="ml-auto inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">{{ $pendingOrders > 9 ? '9+' : $pendingOrders }}</span>
                    @endif
                </a>

                <a href="{{ route('seller.wallet.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.wallet.*') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Dompet
                </a>

                <a href="{{ route('seller.store.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.store.*') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.312.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>

                <a href="{{ route('seller.inclusive-program') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.inclusive-program') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Program Inklusif
                </a>

                @unless(isset($store) && $store->isPro())
                    <a href="{{ route('seller.upgrade') }}"
                       class="flex items-center gap-3 px-4 py-3 mt-4 rounded-lg transition bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:from-purple-600 hover:to-pink-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        Upgrade Pro
                    </a>
                @endunless

                <!-- View Store Link -->
                <div class="pt-4 mt-4 border-t border-indigo-800">
                    <a href="{{ isset($store) ? $store->public_url : '#' }}" target="_blank"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-indigo-100 hover:bg-indigo-800 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Etalase
                    </a>
                </div>
            </nav>

            <!-- User Section -->
            <div class="px-4 py-4 border-t border-indigo-800">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-indigo-800 rounded-full flex items-center justify-center">
                        <span class="font-semibold text-white">{{ substr(auth()->user()->name ?? 'S', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-white text-sm truncate">{{ auth()->user()->name ?? 'Seller' }}</p>
                        <p class="text-xs text-indigo-300 truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-indigo-200 hover:bg-indigo-800 hover:text-white rounded-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="main-content" class="flex-1 ml-64 overflow-auto">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">@yield('breadcrumb', 'Seller')</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Notification Bell -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                    class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition"
                                    aria-haspopup="true"
                                    :aria-expanded="open"
                                    aria-label="Notifikasi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications()->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center" aria-label="{{ $unreadCount }} notifikasi belum dibaca">{{ $unreadCount }}</span>
                                @endif
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 role="dialog"
                                 aria-label="Daftar notifikasi"
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                                    <span class="font-semibold text-gray-900">Notifikasi</span>
                                    @if($unreadCount > 0)
                                        <form method="POST" action="{{ route('seller.notifications.mark-all-read') }}">
                                            @csrf
                                            <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-800">Tandai semua baca</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="max-h-80 overflow-y-auto" aria-live="polite" aria-label="Notifikasi terbaru">
                                    @php
                                        $notifications = auth()->user()->unreadNotifications()->take(10)->get();
                                    @endphp
                                    @if($notifications->count() > 0)
                                        @foreach($notifications as $notification)
                                            <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-50 {{ $notification->read_at ? 'opacity-60' : '' }}" role="listitem">
                                                <p class="text-sm font-medium text-gray-900">{{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                                                <p class="text-xs text-gray-500 mt-1">{{ $notification->data['message'] ?? '' }}</p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="px-4 py-8 text-center text-gray-500">
                                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                            <p class="text-sm">Belum ada notifikasi</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="px-8 pb-8">
                @if(session('success'))
                    <div role="alert" aria-live="polite" class="mb-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div role="alert" aria-live="assertive" class="mb-6 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div role="alert" aria-live="polite" class="mb-6 mt-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('info') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
