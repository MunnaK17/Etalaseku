@php
    $loginAction = Route::has('login') ? route('login') : url('/login');
    $registerUrl = Route::has('register') ? route('register') : url('/register');
    $forgotUrl = Route::has('password.request') ? route('password.request') : url('/forgot-password');
    $googleUrl = Route::has('auth.google') ? route('auth.google') : url('/auth/google');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - EtalaseKu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0b] text-white antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="flex shrink-0 items-center justify-between px-6 py-4 lg:px-12">
            <a href="/" class="flex items-center gap-2 transition hover:opacity-90">
                <img src="/images/image4-removebg-preview.png" alt="Logo EtalaseKu" class="h-10 md:h-12">
                <span class="text-2xl font-extrabold tracking-tight lg:text-3xl">
                    <span>Etalase</span><span class="text-[#FFD700]">Ku</span>
                </span>
            </a>

            <a href="/" class="inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-sm text-zinc-400 transition hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke website
            </a>
        </header>

        <main class="flex flex-1 flex-col items-center px-6 lg:flex-row lg:px-12">
            <section class="hidden items-center justify-center py-4 lg:flex lg:w-[55%]" aria-label="Ilustrasi login">
                <div class="flex max-h-[78vh] max-w-full items-center justify-center overflow-hidden rounded-2xl bg-[#1e0a3c] shadow-lg" style="aspect-ratio: 4 / 3">
                    <img src="/images/login.png" alt="Ilustrasi aksesibilitas EtalaseKu untuk login" class="h-full w-full object-contain">
                </div>
            </section>

            <section class="flex w-full items-center justify-center py-8 lg:w-[45%] lg:py-0" aria-label="Form login">
                <div class="w-full max-w-[420px]">
                    <h1 class="text-2xl font-bold text-white">Selamat Datang Kembali</h1>
                    <p class="mb-8 mt-2 text-sm text-zinc-400">
                        Belum punya akun?
                        <a href="{{ $registerUrl }}" class="font-semibold text-yellow-400 transition hover:text-yellow-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                            Daftar di sini
                        </a>
                    </p>

                    @if (session('status'))
                        <div class="mb-6 rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-400" role="status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ $loginAction }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-300">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="mt-1.5 block w-full rounded-lg border-zinc-700 bg-zinc-900 text-zinc-100 shadow-sm placeholder:text-zinc-600 focus:border-yellow-400 focus:ring-yellow-400"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-zinc-300">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                class="mt-1.5 block w-full rounded-lg border-zinc-700 bg-zinc-900 text-zinc-100 shadow-sm placeholder:text-zinc-600 focus:border-yellow-400 focus:ring-yellow-400"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <label class="flex cursor-pointer select-none items-center gap-2">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-zinc-600 bg-zinc-800 text-yellow-400 focus:ring-yellow-400/50 focus:ring-offset-0"
                                >
                                <span class="text-sm text-zinc-400">Ingat saya</span>
                            </label>

                            <a href="{{ $forgotUrl }}" class="text-sm font-medium text-yellow-400 transition hover:text-yellow-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                                Lupa password?
                            </a>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-yellow-400 px-4 py-2.5 text-sm font-semibold text-black transition hover:bg-yellow-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                            Masuk
                        </button>
                    </form>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-zinc-700"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-wider">
                            <span class="bg-[#0a0a0b] px-3 text-zinc-500">atau masuk dengan</span>
                        </div>
                    </div>

                    <a href="{{ $googleUrl }}" class="inline-flex w-full items-center justify-center gap-3 rounded-lg border border-zinc-700 bg-transparent px-4 py-2.5 text-sm font-medium text-zinc-300 transition hover:bg-zinc-800/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l3.66-2.84z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06L5.84 9.9C6.71 7.3 9.14 5.38 12 5.38z"/>
                        </svg>
                        Masuk dengan Google
                    </a>
                </div>
            </section>
        </main>

        <footer class="shrink-0 border-t border-zinc-800 px-6 py-4 lg:px-12">
            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-1 text-xs text-zinc-500 lg:justify-start">
                <span class="inline-flex items-center gap-1.5 font-medium text-zinc-400">
                    <img src="/images/image4-removebg-preview.png" alt="Logo EtalaseKu" class="h-5">
                    EtalaseKu
                </span>
                <a href="#" class="transition hover:text-zinc-300">Syarat Layanan</a>
                <a href="#" class="transition hover:text-zinc-300">Kebijakan Privasi</a>
                <a href="#" class="transition hover:text-zinc-300">Pusat Bantuan</a>
            </div>
        </footer>
    </div>
</body>
</html>
