{{-- ============================================
    EtalaseKU - Landing Page
    Connectly-Inspired Dark Theme Design
    Satu Link Untuk Semua Karya Kamu
=========================================== --}}

<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EtalaseKU - Satu Link Untuk Semua Karya Kamu. Platform terbaik untuk kreator membangun audiens, mengelola konten, dan memaksimalkan pendapatan.">
    <title>EtalaseKU | Satu Link Untuk Semua Karya Kamu</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-secondary-container": "#d0a9d0",
                      "surface-tint": "#c6c6c6",
                      "surface-container-highest": "#353535",
                      "on-error": "#690005",
                      "tertiary-container": "#000000",
                      "surface-bright": "#393939",
                      "secondary": "#e2bae2",
                      "on-background": "#e2e2e2",
                      "surface-raised": "#e9c0e9",
                      "secondary-fixed-dim": "#e2bae2",
                      "surface-variant": "#353535",
                      "on-tertiary-fixed": "#1a1c1b",
                      "inverse-primary": "#5e5e5e",
                      "border-dark": "#1e2330",
                      "tertiary-fixed": "#e2e3e1",
                      "surface": "#131313",
                      "on-error-container": "#ffdad6",
                      "inverse-on-surface": "#303030",
                      "surface-container": "#1f1f1f",
                      "on-primary-container": "#757575",
                      "on-secondary-fixed-variant": "#5b3c5e",
                      "on-surface": "#e2e2e2",
                      "on-surface-variant": "#cfc4c5",
                      "surface-neutral": "#f3f3f1",
                      "on-primary-fixed-variant": "#474747",
                      "error-container": "#93000a",
                      "tertiary-fixed-dim": "#c6c7c5",
                      "secondary-fixed": "#ffd6fe",
                      "surface-container-lowest": "#0e0e0e",
                      "on-secondary-fixed": "#2c1130",
                      "surface-container-high": "#2a2a2a",
                      "on-primary": "#303030",
                      "error": "#ffb4ab",
                      "primary-fixed": "#e2e2e2",
                      "primary": "#c6c6c6",
                      "on-tertiary-fixed-variant": "#454746",
                      "on-primary-fixed": "#1b1b1b",
                      "outline-variant": "#4c4546",
                      "surface-container-low": "#1b1b1b",
                      "inverse-surface": "#e2e2e2",
                      "primary-fixed-dim": "#c6c6c6",
                      "secondary-container": "#5b3c5e",
                      "background": "#131313",
                      "text-muted": "#676b5f",
                      "on-tertiary": "#2f3130",
                      "surface-dim": "#131313",
                      "primary-container": "#000000",
                      "on-secondary": "#432646",
                      "on-tertiary-container": "#747674",
                      "outline": "#988e90",
                      "tertiary": "#c6c7c5"
              },
              "borderRadius": {
                      "DEFAULT": "1rem",
                      "lg": "2rem",
                      "xl": "3rem",
                      "full": "9999px"
              },
              "spacing": {
                      "stack-lg": "5rem",
                      "container-margin": "2rem",
                      "unit": "8px",
                      "stack-sm": "1rem",
                      "gutter": "1.5rem",
                      "stack-md": "2.5rem"
              },
              "fontFamily": {
                      "headline-lg-mobile": ["Plus Jakarta Sans"],
                      "headline-xl": ["Plus Jakarta Sans"],
                      "body-lg": ["Plus Jakarta Sans"],
                      "headline-lg": ["Plus Jakarta Sans"],
                      "body-md": ["Plus Jakarta Sans"],
                      "label-md": ["Plus Jakarta Sans"]
              },
              "fontSize": {
                      "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                      "headline-xl": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                      "body-lg": ["20px", {"lineHeight": "30px", "fontWeight": "400"}],
                      "headline-lg": ["40px", {"lineHeight": "1.2", "fontWeight": "700"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}]
              }
            },
          },
        }
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            background-color: #000000;
            color: #e2e2e2;
            -webkit-font-smoothing: antialiased;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }
        /* Navbar scroll effect */
        .navbar-scrolled {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="font-body-md selection:bg-surface-raised selection:text-primary-container">

    <!-- ============================================
         NAVBAR
    ============================================ -->
    <nav class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-8 py-4 bg-surface/80 backdrop-blur-md rounded-full mt-4 mx-auto w-[90%] max-w-7xl border border-border-dark transition-all duration-300">
        <a href="{{ url('/') }}" class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-on-surface hover:text-surface-raised transition-colors">EtalaseKU</a>
        <div class="hidden md:flex items-center gap-8">
            <a class="text-primary font-bold border-b-2 border-primary pb-1 font-label-md text-label-md hover:text-secondary transition-colors" href="#fitur">Fitur</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors" href="#harga">Harga</a>
        </div>
        <div class="flex items-center gap-4">
            @auth
                @php
                    $user = auth()->user();
                    $store = $user->store;
                @endphp
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            @click.away="open = false"
                            class="flex items-center gap-2 px-4 py-2 bg-surface-container hover:bg-surface-container-high rounded-lg transition-colors"
                            aria-label="Menu akun">
                        <div class="w-8 h-8 bg-surface-raised rounded-full flex items-center justify-center">
                            <span class="text-on-secondary text-sm font-semibold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open"
                         x-transition
                         class="absolute right-0 mt-2 w-56 bg-surface-container rounded-xl border border-border-dark py-2 z-50">
                        <div class="px-4 py-3 border-b border-border-dark">
                            <p class="text-sm font-medium text-on-surface">{{ $user->name }}</p>
                            <p class="text-xs text-text-muted">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                        @if($store)
                            <a href="{{ $store->public_url }}" target="_blank" class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Lihat Etalase Saya
                            </a>
                        @endif
                        <div class="border-t border-border-dark mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-error hover:bg-surface-container-high transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hidden md:block font-label-md text-label-md text-on-surface hover:text-secondary transition-colors px-4 py-2">Log in</a>
                <a href="{{ route('register') }}" class="bg-surface-neutral text-primary-container px-6 py-3 rounded-full font-label-md text-label-md font-bold scale-95 active:scale-90 transition-transform hover:bg-surface-raised">Sign Up</a>
            @endauth
        </div>
    </nav>

    <main>
        <!-- ============================================
             HERO SECTION
        ============================================ -->
        <section class="min-h-screen flex flex-col items-center justify-center pt-32 px-container-margin text-center">
            <div class="max-w-4xl space-y-stack-md">
                <h1 class="font-headline-xl text-headline-xl text-on-surface animate-fade-in">
                    Satu Link Untuk <span class="text-surface-raised">Semua Karya</span> Kamu
                </h1>
                <p class="font-body-lg text-body-lg text-text-muted max-w-2xl mx-auto">
                    Platform terbaik untuk kreator membangun audiens, mengelola konten, dan memaksimalkan pendapatan hanya dengan satu tautan bio yang elegan.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-gutter pt-8">
                    <a href="{{ route('register') }}" class="bg-surface-raised text-primary-container px-12 py-6 rounded-full font-headline-lg-mobile text-headline-lg-mobile font-bold hover:opacity-90 transition-all scale-100 hover:scale-105 active:scale-95 shadow-xl shadow-surface-raised/20">
                        Mulai Gratis Sekarang
                    </a>
                </div>
                <div class="pt-12">
                    <div class="inline-flex items-center gap-4 bg-surface-container-low border border-border-dark px-6 py-3 rounded-full">
                        <div class="flex -space-x-3">
                            <div class="w-8 h-8 rounded-full border-2 border-background bg-secondary"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-background bg-primary"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-background bg-tertiary"></div>
                        </div>
                        <span class="text-body-md font-semibold text-on-surface">Dipercaya oleh 10rb+ Kreator</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================
             BENEFIT SECTION - BENTO CARDS
        ============================================ -->
        <section id="fitur" class="py-stack-lg px-container-margin max-w-7xl mx-auto">
            <div class="mb-stack-md text-center">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-4">Sederhana tapi Powerful</h2>
                <p class="text-text-muted text-body-lg">Semua yang kamu butuhkan untuk tumbuh ada di sini.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Bento Card 1 -->
                <div class="bg-surface-container-lowest border border-border-dark p-12 rounded-xl flex flex-col justify-between group overflow-hidden relative">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-surface-raised text-4xl mb-6">analytics</span>
                        <h3 class="font-headline-lg text-headline-lg-mobile text-on-surface mb-4">Analitik Real-time</h3>
                        <p class="text-text-muted text-body-md">Pantau performa tautan kamu setiap detiknya. Ketahui dari mana asal pengunjung dan konten apa yang paling mereka sukai.</p>
                    </div>
                    <div class="mt-12 h-64 bg-gradient-to-tr from-surface-container-high to-background rounded-lg border border-border-dark flex items-end p-6 gap-2">
                        <div class="flex-1 bg-surface-raised/20 rounded-t-md h-[40%] transition-all group-hover:h-[60%]"></div>
                        <div class="flex-1 bg-surface-raised/40 rounded-t-md h-[70%] transition-all group-hover:h-[90%]"></div>
                        <div class="flex-1 bg-surface-raised rounded-t-md h-[50%] transition-all group-hover:h-[70%]"></div>
                        <div class="flex-1 bg-surface-raised/60 rounded-t-md h-[80%] transition-all group-hover:h-[100%]"></div>
                    </div>
                </div>
                <!-- Bento Card 2 -->
                <div class="bg-surface-neutral p-12 rounded-xl flex flex-col justify-between text-primary-container group">
                    <div>
                        <span class="material-symbols-outlined text-4xl mb-6">palette</span>
                        <h3 class="font-headline-lg text-headline-lg-mobile mb-4">Kustomisasi Penuh</h3>
                        <p class="text-on-primary-container text-body-md">Sesuaikan tampilan bio kamu dengan brand identity-mu. Ganti warna, font, hingga layout hanya dengan beberapa klik.</p>
                    </div>
                    <div class="mt-12 flex flex-wrap gap-4">
                        <div class="px-6 py-3 bg-primary-container text-on-primary rounded-full font-bold">Warna Pastel</div>
                        <div class="px-6 py-3 border-2 border-primary-container rounded-full font-bold">Neo-Brutalism</div>
                        <div class="px-6 py-3 bg-surface-raised rounded-full font-bold">Glassmorphism</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================
             FEATURE GRID SECTION
        ============================================ -->
        <section class="py-stack-lg bg-surface-container-low px-container-margin">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-3 gap-gutter">
                    <div class="p-10 border border-border-dark rounded-lg hover:border-surface-raised transition-colors duration-500">
                        <span class="material-symbols-outlined text-surface-raised mb-4 text-3xl">shopping_bag</span>
                        <h4 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2">Integrasi Toko</h4>
                        <p class="text-text-muted text-body-md">Jual produk digital atau merchandise langsung dari halaman Connectly kamu.</p>
                    </div>
                    <div class="p-10 border border-border-dark rounded-lg hover:border-surface-raised transition-colors duration-500">
                        <span class="material-symbols-outlined text-surface-raised mb-4 text-3xl">mail</span>
                        <h4 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2">Koleksi Email</h4>
                        <p class="text-text-muted text-body-md">Bangun daftar emailmu dengan form berlangganan yang terintegrasi rapi.</p>
                    </div>
                    <div class="p-10 border border-border-dark rounded-lg hover:border-surface-raised transition-colors duration-500">
                        <span class="material-symbols-outlined text-surface-raised mb-4 text-3xl">schedule</span>
                        <h4 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2">Penjadwalan Tautan</h4>
                        <p class="text-text-muted text-body-md">Atur kapan tautan harus muncul atau menghilang secara otomatis.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================
             PRICING SECTION
        ============================================ -->
        <section id="harga" class="py-stack-lg px-container-margin max-w-5xl mx-auto">
            <div class="text-center mb-stack-md">
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Pilih Rencana Pertumbuhanmu</h2>
                <p class="text-text-muted text-body-lg mt-4">Transparan, simpel, tanpa biaya tersembunyi.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-stack-sm">
                <!-- Free Plan -->
                <div class="bg-surface-container p-12 rounded-xl border border-border-dark flex flex-col justify-between">
                    <div>
                        <div class="text-label-md text-surface-raised uppercase tracking-widest mb-4">Starter</div>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface mb-2">Gratis</h3>
                        <p class="text-text-muted mb-8">Selamanya gratis untuk kreator baru.</p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-on-surface">
                                <span class="material-symbols-outlined text-surface-raised">check_circle</span>
                                Tautan Tak Terbatas
                            </li>
                            <li class="flex items-center gap-3 text-on-surface">
                                <span class="material-symbols-outlined text-surface-raised">check_circle</span>
                                Analitik Dasar
                            </li>
                            <li class="flex items-center gap-3 text-on-surface">
                                <span class="material-symbols-outlined text-surface-raised">check_circle</span>
                                Tema Standar
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}" class="mt-12 w-full py-4 border-2 border-border-dark rounded-full font-bold hover:bg-surface-variant transition-colors text-center">
                        Pilih Free
                    </a>
                </div>
                <!-- Pro Plan -->
                <div class="bg-surface-raised p-12 rounded-xl flex flex-col justify-between shadow-2xl shadow-surface-raised/20 relative overflow-hidden">
                    <div class="absolute top-8 right-8 bg-primary-container text-on-primary px-4 py-1 rounded-full text-xs font-bold uppercase">Populer</div>
                    <div class="relative z-10">
                        <div class="text-label-md text-primary-container/60 uppercase tracking-widest mb-4 font-bold">Pro</div>
                        <h3 class="font-headline-lg text-headline-lg text-primary-container mb-2">Rp 49.000<span class="text-body-md opacity-60">/bln</span></h3>
                        <p class="text-primary-container/70 mb-8 font-medium">Fitur lengkap untuk kreator profesional.</p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-primary-container font-semibold">
                                <span class="material-symbols-outlined">check_circle</span>
                                Analitik Mendalam
                            </li>
                            <li class="flex items-center gap-3 text-primary-container font-semibold">
                                <span class="material-symbols-outlined">check_circle</span>
                                Integrasi Toko & Pembayaran
                            </li>
                            <li class="flex items-center gap-3 text-primary-container font-semibold">
                                <span class="material-symbols-outlined">check_circle</span>
                                Hapus Branding EtalaseKU
                            </li>
                            <li class="flex items-center gap-3 text-primary-container font-semibold">
                                <span class="material-symbols-outlined">check_circle</span>
                                Prioritas Support 24/7
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}?plan=pro" class="mt-12 w-full py-4 bg-primary-container text-on-primary rounded-full font-bold hover:opacity-90 transition-opacity text-center">
                        Pilih Pro
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================
             FINAL CTA SECTION
        ============================================ -->
        <section class="py-stack-lg px-container-margin text-center">
            <div class="bg-gradient-to-b from-surface-container-high to-black rounded-xl p-20 border border-border-dark max-w-7xl mx-auto">
                <h2 class="font-headline-xl text-headline-lg md:text-headline-xl text-on-surface mb-8">Siap Membangun <br/>Masa Depanmu?</h2>
                <a href="{{ route('register') }}" class="bg-surface-neutral text-primary-container px-12 py-6 rounded-full font-headline-lg-mobile text-headline-lg-mobile font-bold hover:scale-105 active:scale-95 transition-transform inline-block">
                    Daftar Sekarang
                </a>
            </div>
        </section>
    </main>

    <!-- ============================================
         FOOTER
    ============================================ -->
    <footer class="w-full py-stack-lg px-container-margin flex flex-col md:flex-row justify-between items-center gap-gutter bg-background border-t border-border-dark">
        <div class="flex flex-col items-center md:items-start gap-4">
            <a href="{{ url('/') }}" class="font-headline-lg text-headline-lg font-bold text-on-surface hover:text-surface-raised transition-colors">EtalaseKU</a>
            <p class="font-body-md text-body-md text-text-muted">© 2026 EtalaseKU. All rights reserved.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            <a class="text-text-muted font-body-md text-body-md hover:text-on-surface transition-colors opacity-80 hover:opacity-100" href="#">Terms</a>
            <a class="text-text-muted font-body-md text-body-md hover:text-on-surface transition-colors opacity-80 hover:opacity-100" href="#">Privacy</a>
            <a class="text-text-muted font-body-md text-body-md hover:text-on-surface transition-colors opacity-80 hover:opacity-100" href="#">Support</a>
            <a class="text-text-muted font-body-md text-body-md hover:text-on-surface transition-colors opacity-80 hover:opacity-100" href="#">Contact</a>
        </div>
    </footer>

    <script>
        // Simple scroll interaction for navbar
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 20) {
                nav.classList.add('navbar-scrolled', 'py-3');
            } else {
                nav.classList.remove('navbar-scrolled', 'py-3');
            }
        });
    </script>

</body>
</html>