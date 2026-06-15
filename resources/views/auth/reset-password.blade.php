@php
    $loginUrl = Route::has('login') ? route('login') : url('/login');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - EtalaseKu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Theme CSS Variables */
        :root {
            --bg-primary: #0a0a0b;
            --bg-secondary: #181818;
            --bg-tertiary: #1e1e1e;
            --bg-input: #0f0f0f;
            --border-color: rgba(38, 38, 38, 0.8);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #FFD700;
            --accent-hover: #fbbf24;
            --success: #10b981;
            --error: #ef4444;
        }

        html.light {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-input: #ffffff;
            --border-color: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --accent: #d97706;
            --accent-hover: #b45309;
            --success: #059669;
            --error: #dc2626;
        }

        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .no-transition, .no-transition * {
            transition: none !important;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        .theme-toggle {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-tertiary);
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
        }
        .theme-toggle:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
        .theme-toggle svg {
            width: 18px;
            height: 18px;
        }
        .theme-toggle .sun-icon {
            display: block;
        }
        .theme-toggle .moon-icon {
            display: none;
        }
        html.light .theme-toggle .sun-icon {
            display: none;
        }
        html.light .theme-toggle .moon-icon {
            display: block;
        }
    </style>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                document.documentElement.classList.toggle('light', savedTheme === 'light');
            } else {
                document.documentElement.classList.toggle('light', !prefersDark);
            }

            window.addEventListener('load', function() {
                document.body.classList.remove('no-transition');
            });

            document.body.classList.add('no-transition');
        })();

        function toggleTheme() {
            const isLight = document.documentElement.classList.toggle('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        }
    </script>
</head>
<body class="antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="flex shrink-0 items-center justify-between px-6 py-4 lg:px-12">
            <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-90">
                <img src="{{ asset('images/image4-removebg-preview.png') }}" alt="Logo EtalaseKu" class="h-10 md:h-12">
                <span class="text-2xl font-extrabold tracking-tight lg:text-3xl">
                    <span>Etalase</span><span style="color: var(--accent);">Ku</span>
                </span>
            </a>

            <div class="flex items-center gap-3">
                <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme">
                    <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-sm transition focus-visible:outline-none focus-visible:ring-2" style="color: var(--text-muted); --tw-ring-color: var(--accent);">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke website
                </a>
            </div>
        </header>

        <main class="flex flex-1 flex-col items-center justify-center px-6 py-8">
            <div class="w-full max-w-[420px]">
                <!-- Header -->
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border" style="border-color: var(--border-color); background: var(--bg-tertiary);">
                        <svg class="h-8 w-8" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Reset Password</h1>
                    <p class="mt-2 text-sm" style="color: var(--text-muted);">Buat password baru untuk akun Anda.</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label for="email" class="block text-sm font-medium" style="color: var(--text-secondary);">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $request->email) }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                            style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
                            placeholder="nama@contoh.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium" style="color: var(--text-secondary);">Password Baru</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                            style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
                            placeholder="Minimal 8 karakter"
                        >
                        @error('password')
                            <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium" style="color: var(--text-secondary);">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                            style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
                            placeholder="Masukkan password lagi"
                        >
                        @error('password_confirmation')
                            <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-4 py-2.5 text-sm font-semibold transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2" style="background: var(--accent); color: #000; --tw-ring-color: var(--accent);">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Reset Password
                    </button>
                </form>

                <!-- Back to Login -->
                <p class="mt-6 text-center text-sm" style="color: var(--text-muted);">
                    Ingat password Anda?
                    <a href="{{ $loginUrl }}" class="font-semibold transition hover:opacity-80" style="color: var(--accent);">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </main>

        <footer class="shrink-0 border-t px-6 py-4 lg:px-12" style="border-color: var(--border-color);">
            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-1 text-xs lg:justify-start" style="color: var(--text-muted);">
                <span class="inline-flex items-center gap-1.5 font-medium" style="color: var(--text-secondary);">
                    <img src="{{ asset('images/image4-removebg-preview.png') }}" alt="Logo EtalaseKu" class="h-5">
                    EtalaseKu
                </span>
                <a href="#" class="transition hover:opacity-80">Syarat Layanan</a>
                <a href="#" class="transition hover:opacity-80">Kebijakan Privasi</a>
                <a href="#" class="transition hover:opacity-80">Pusat Bantuan</a>
            </div>
        </footer>
    </div>
</body>
</html>