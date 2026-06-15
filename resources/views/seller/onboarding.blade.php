@php
    $homeUrl = Route::has('home') ? route('home') : url('/');
    $storeBaseUrl = parse_url(config('app.url'), PHP_URL_HOST) ?: request()->getHost();
    $oldWhatsapp = preg_replace('/\D/', '', (string) old('whatsapp'));
    $whatsappLocal = str_starts_with($oldWhatsapp, '62')
        ? substr($oldWhatsapp, 2)
        : ltrim($oldWhatsapp, '0');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Setup Etalase - EtalaseKu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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
            --error: #ef4444;
            --illustration-bg: #1e0a3c;
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
            --error: #dc2626;
            --illustration-bg: #fef3c7;
        }

        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .no-transition,
        .no-transition * {
            transition: none !important;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-muted);
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

            document.addEventListener('DOMContentLoaded', function() {
                document.body.classList.remove('no-transition');
            });
        })();

        function toggleTheme() {
            const isLight = document.documentElement.classList.toggle('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        }
    </script>
</head>
<body class="no-transition antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="flex shrink-0 items-center justify-between px-6 py-4 lg:px-12">
            <a href="{{ $homeUrl }}" class="flex items-center gap-2 transition hover:opacity-90">
                <img src="{{ asset('images/image4-removebg-preview.png') }}" alt="Logo EtalaseKu" class="h-10 md:h-12">
                <span class="text-2xl font-extrabold tracking-tight lg:text-3xl">
                    <span>Etalase</span><span style="color: var(--accent);">Ku</span>
                </span>
            </a>

            <div class="flex items-center gap-3">
                <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme" type="button">
                    <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <a href="{{ $homeUrl }}" class="inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-sm transition hover:opacity-80 focus-visible:outline-none focus-visible:ring-2" style="color: var(--text-muted); --tw-ring-color: var(--accent);">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke website
                </a>
            </div>
        </header>

        <main class="flex flex-1 flex-col items-center px-6 lg:flex-row lg:px-12">
            <section class="hidden items-center justify-center py-4 lg:flex lg:w-[55%]" aria-label="Ilustrasi setup etalase">
                <div class="flex max-h-[78vh] max-w-full items-center justify-center overflow-hidden rounded-2xl shadow-lg" style="background: var(--illustration-bg); aspect-ratio: 4 / 3">
                    <img src="{{ asset('images/register.png') }}" alt="Ilustrasi ekosistem EtalaseKu untuk membuat etalase" class="h-full w-full object-contain">
                </div>
            </section>

            <section class="flex w-full items-center justify-center py-8 lg:w-[45%] lg:py-0" aria-label="Form setup etalase">
                <div class="w-full max-w-[460px]">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-wider" style="color: var(--accent);">Onboarding seller</p>
                    <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Buat Etalase Kamu</h1>
                    <p class="mb-8 mt-2 text-sm" style="color: var(--text-muted);">
                        Isi detail dasar supaya etalase publik kamu siap dipakai untuk berjualan.
                    </p>

                    <form method="POST" action="{{ route('seller.onboarding.store') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium" style="color: var(--text-secondary);">Nama Etalase</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="off"
                                placeholder="Contoh: Toko Sembako Makmur"
                                aria-describedby="name-hint"
                                class="mt-1.5 block w-full rounded-lg shadow-sm focus:ring-2"
                                style="border-color: var(--border-color); background: var(--bg-input); color: var(--text-primary); --tw-ring-color: var(--accent);"
                            >
                            @error('name')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                            <p id="name-hint" class="mt-2 text-xs" style="color: var(--text-muted);">Nama etalase yang akan ditampilkan di halaman publik.</p>
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium" style="color: var(--text-secondary);">Username</label>
                            <div class="mt-1.5 flex rounded-lg shadow-sm">
                                <span class="inline-flex items-center rounded-l-lg border border-r-0 px-3 text-sm" style="border-color: var(--border-color); background: var(--bg-tertiary); color: var(--text-muted);">
                                    {{ $storeBaseUrl }}/
                                </span>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    value="{{ old('username') }}"
                                    required
                                    autocomplete="off"
                                    placeholder="tokosembako"
                                    spellcheck="false"
                                    class="block w-full rounded-none rounded-r-lg shadow-sm focus:ring-2"
                                    style="border-color: var(--border-color); background: var(--bg-input); color: var(--text-primary); --tw-ring-color: var(--accent);"
                                >
                            </div>
                            @error('username')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs" style="color: var(--text-muted);">Hanya huruf kecil, angka, dan tanda strip (-). Contoh: tokosembako-makmur.</p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium" style="color: var(--text-secondary);">Deskripsi (Opsional)</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                placeholder="Deskripsi singkat tentang etalase kamu"
                                class="mt-1.5 block w-full rounded-lg shadow-sm focus:ring-2"
                                style="border-color: var(--border-color); background: var(--bg-input); color: var(--text-primary); --tw-ring-color: var(--accent);"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="whatsapp" class="block text-sm font-medium" style="color: var(--text-secondary);">Nomor WhatsApp (Opsional)</label>
                            <div class="mt-1.5 flex rounded-lg shadow-sm">
                                <span class="inline-flex items-center gap-2 rounded-l-lg border border-r-0 px-3 text-sm font-medium" style="border-color: var(--border-color); background: var(--bg-tertiary); color: var(--text-secondary);">
                                    <span aria-hidden="true">🇮🇩</span>
                                    <span>+62</span>
                                </span>
                                <input
                                    id="whatsapp"
                                    name="whatsapp"
                                    type="tel"
                                    value="{{ $whatsappLocal }}"
                                    autocomplete="tel"
                                    inputmode="numeric"
                                    placeholder="8123456789"
                                    class="block w-full rounded-none rounded-r-lg shadow-sm focus:ring-2"
                                    style="border-color: var(--border-color); background: var(--bg-input); color: var(--text-primary); --tw-ring-color: var(--accent);"
                                >
                            </div>
                            @error('whatsapp')
                                <p class="mt-2 text-sm" style="color: var(--error);">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs" style="color: var(--text-muted);">Masukkan nomor setelah +62. Contoh: 8123456789. Jika mengetik 08..., sistem akan otomatis menyesuaikan.</p>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-black transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2" style="background: var(--accent); --tw-ring-color: var(--accent);">
                            Buat Etalase Sekarang
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm" style="color: var(--text-muted);">
                        Dengan membuat etalase, kamu menyetujui
                        <a href="#" class="font-medium transition hover:opacity-80 focus-visible:outline-none focus-visible:ring-2" style="color: var(--accent); --tw-ring-color: var(--accent);">Syarat & Ketentuan</a>
                        kami.
                    </p>
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
