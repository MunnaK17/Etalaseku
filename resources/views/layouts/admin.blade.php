<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - EtalaseKu')</title>
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
        *:focus:not(:focus-visible) {
            outline: none;
        }
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible,
        [tabindex]:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
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
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Skip to Content - Accessibility -->
    <a href="#main-content" class="skip-to-content">Langsung ke konten utama</a>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <!-- Logo -->
            <div class="px-6 py-5 border-b border-gray-800">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <div>
                        <span class="font-bold text-lg">EtalaseKu</span>
                        <p class="text-xs text-gray-400">Panel Admin</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.stores.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.stores.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Toko
                </a>

                <a href="{{ route('admin.inclusive-applications.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.inclusive-applications.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Program Inklusif
                    @php
                        $pendingCount = \App\Models\InclusiveApplication::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.subscriptions.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.subscriptions.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Langganan
                    @php
                        $pendingSubs = \App\Models\Subscription::where('payment_status', 'pending')->count();
                    @endphp
                    @if($pendingSubs > 0)
                        <span class="ml-auto bg-purple-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingSubs }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.withdrawals.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.withdrawals.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Penarikan
                    @php
                        $pendingWithdrawals = \App\Models\Withdrawal::where('status', 'pending')->count();
                    @endphp
                    @if($pendingWithdrawals > 0)
                        <span class="ml-auto bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingWithdrawals }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Pesanan
                    @php
                        $pendingOrders = \App\Models\Order::where('payment_status', 'pending')->count();
                    @endphp
                    @if($pendingOrders > 0)
                        <span class="ml-auto bg-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingOrders }}</span>
                    @endif
                </a>
            </nav>

            <!-- User Section -->
            <div class="px-4 py-4 border-t border-gray-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                        <span class="font-semibold">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="main-content" class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">@yield('breadcrumb', 'Admin')</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="px-8">
                @if(session('success'))
                    <div class="mb-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert" aria-live="polite">
                        <span class="sr-only">Sukses:</span> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert" aria-live="assertive">
                        <span class="sr-only">Error:</span> {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-6 mt-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg" role="alert" aria-live="polite">
                        <span class="sr-only">Info:</span> {{ session('info') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>