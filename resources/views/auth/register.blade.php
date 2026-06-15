@php
    $registerAction = Route::has('register') ? route('register') : url('/register');
    $loginUrl = Route::has('login') ? route('login') : url('/login');
    $googleUrl = Route::has('auth.google') ? route('auth.google') : url('/auth/google');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - EtalaseKu</title>

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
            --illustration-bg: #f8f3ea;
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
            --illustration-bg: #fef3c7;
        }

        /* Theme Transition */
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

        /* Theme Toggle Button */
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
            transition: transform 0.3s ease;
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

        .agree-checkbox:checked + .agree-box {
            background: var(--accent);
            border-color: var(--accent);
        }

        .agree-checkbox:checked + .agree-box svg {
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
                <!-- Theme Toggle -->
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

        <main class="flex flex-1 flex-col items-center px-6 lg:flex-row lg:px-12">
            <section class="hidden items-center justify-center py-4 lg:flex lg:w-[55%]" aria-label="Ilustrasi register">
                <div class="flex max-h-[78vh] max-w-full items-center justify-center overflow-hidden rounded-2xl shadow-lg" style="background: var(--illustration-bg); aspect-ratio: 4 / 3">
                    <img src="{{ asset('images/register.png') }}" alt="Ilustrasi ekosistem inklusif EtalaseKu untuk registrasi" class="h-full w-full object-contain">
                </div>
            </section>

            <section class="flex w-full items-center justify-center py-8 lg:w-[45%] lg:py-0" aria-label="Form register">
                <div class="w-full max-w-[420px]">
                    <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Buat Akun Baru</h1>
                    <p class="mb-8 mt-2 text-sm" style="color: var(--text-muted);">
                        Sudah punya akun?
                        <a href="{{ $loginUrl }}" class="font-semibold transition hover:opacity-80 focus-visible:outline-none focus-visible:ring-2" style="color: var(--accent); --tw-ring-color: var(--accent);">
                            Masuk di sini
                        </a>
                    </p>

                    <form method="POST" action="{{ $registerAction }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium" style="color: var(--text-secondary);">Nama Lengkap</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                                style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
                            >
                            @error('name')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium" style="color: var(--text-secondary);">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                                style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
                            >
                            @error('email')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium" style="color: var(--text-secondary);">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="mt-1.5 block w-full rounded-lg shadow-sm placeholder:text-zinc-500 focus:ring-offset-0"
                                style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary); --tw-placeholder-color: var(--text-muted); --tw-ring-color: var(--accent);"
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
                            >
                            @error('password_confirmation')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex cursor-pointer select-none items-start gap-2">
                            <input
                                id="agree"
                                type="checkbox"
                                name="agree"
                                value="1"
                                required
                                @checked(old('agree'))
                                class="agree-checkbox peer sr-only"
                            >
                            <span class="agree-box mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 transition peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2"
                                  style="border-color: var(--accent); --tw-outline-color: var(--accent);">
                                <svg class="hidden h-3.5 w-3.5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span class="text-sm leading-snug" style="color: var(--text-muted);">
                                Saya menyetujui
                                <a href="#" class="font-medium transition hover:opacity-80" style="color: var(--accent);">Syarat & Ketentuan</a>
                                dan
                                <a href="#" class="font-medium transition hover:opacity-80" style="color: var(--accent);">Kebijakan Privasi</a>
                            </span>
                        </label>
                        @error('agree')
                            <p class="-mt-3 text-sm" style="color: var(--error);">{{ $message }}</p>
                        @enderror

                        <button id="registerButton" type="submit" class="inline-flex w-full items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" style="background: var(--accent); color: #000; --tw-ring-color: var(--accent);">
                            Daftar Gratis
                        </button>
                    </form>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t" style="border-color: var(--border-color);"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-wider">
                            <span class="px-3" style="background: var(--bg-primary); color: var(--text-muted);">atau daftar dengan</span>
                        </div>
                    </div>

                    <a href="{{ $googleUrl }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border px-4 py-2.5 text-sm font-medium transition hover:opacity-80 focus-visible:outline-none focus-visible:ring-2" style="border-color: var(--border-color); background: transparent; color: var(--text-secondary); --tw-ring-color: var(--accent);">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l3.66-2.84z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06L5.84 9.9C6.71 7.3 9.14 5.38 12 5.38z"/>
                        </svg>
                        Daftar dengan Google
                    </a>
                </div>
            </section>
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
