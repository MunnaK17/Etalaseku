@php
    $navLinks = [
        ['id' => 'fitur', 'label' => 'Fitur'],
        ['id' => 'showcase', 'label' => 'Showcase'],
        ['id' => 'layanan', 'label' => 'Layanan'],
        ['id' => 'untuk-siapa', 'label' => 'Untuk Siapa'],
        ['id' => 'harga', 'label' => 'Harga'],
        ['id' => 'faq', 'label' => 'FAQ'],
    ];

    $fiturUtama = [
        ['title' => 'Katalog Produk Online', 'desc' => 'Tampilkan produk UMKM dalam katalog digital yang rapi dengan gambar, harga, dan deskripsi.'],
        ['title' => 'Tautan Bisnis', 'desc' => 'Kumpulkan WhatsApp, Instagram, TikTok, dan marketplace dalam satu halaman.'],
        ['title' => 'Checkout Web & WhatsApp', 'desc' => 'Pelanggan bisa pesan langsung lewat tombol checkout WhatsApp atau form web.'],
        ['title' => 'Statistik Kunjungan', 'desc' => 'Pantau jumlah pengunjung katalog dan interaksi dengan tautan bisnis.'],
        ['title' => 'Aksesibilitas WCAG AA', 'desc' => 'Katalog ramah disabilitas dengan dukungan screen reader, keyboard, dan kontras warna.'],
        ['title' => 'Verified & Trust Badge', 'desc' => 'Tingkatkan kepercayaan pembeli dengan lencana toko terverifikasi.'],
        ['title' => 'Lokasi Toko', 'desc' => 'Cantumkan alamat toko fisik agar pelanggan mudah menemukan lokasi usaha Anda.'],
        ['title' => 'QRIS untuk UMKM', 'desc' => 'Tampilkan QRIS statis di halaman toko untuk pembayaran non-tunai.'],
    ];

    $layanan = [
        ['title' => 'Katalog Digital UMKM', 'desc' => 'Buat katalog produk online yang mudah dibagikan tanpa perlu membuat website dari nol.'],
        ['title' => 'Pemesanan WhatsApp', 'desc' => 'Pelanggan dapat langsung menghubungi merchant melalui WhatsApp.'],
        ['title' => 'Checkout Online', 'desc' => 'Terima pesanan langsung dari katalog dengan form checkout sederhana.'],
        ['title' => 'Profil & Lokasi Toko', 'desc' => 'Tampilkan nama toko, deskripsi, WhatsApp, alamat, kota, provinsi, dan link Google Maps.'],
        ['title' => 'Verified Seller', 'desc' => 'Bantu merchant membangun kepercayaan melalui badge seller terverifikasi.'],
        ['title' => 'Aksesibilitas untuk Semua', 'desc' => 'Dukung pengalaman belanja yang inklusif dengan tampilan mudah dibaca.'],
    ];

    $audiences = [
        'UMKM Makanan & Minuman',
        'Kerajinan Tangan',
        'Fashion Adaptif',
        'Alat Bantu Disabilitas',
        'Jasa Lokal',
        'Komunitas & Usaha Sosial',
    ];

    $faq = [
        ['q' => 'Apakah pembeli harus login untuk melihat katalog saya?', 'a' => 'Tidak. Katalog bersifat publik dan bisa diakses siapa saja tanpa login.'],
        ['q' => 'Apakah pelanggan bisa pesan langsung lewat WhatsApp?', 'a' => 'Bisa. Setiap produk memiliki tombol checkout yang terhubung langsung ke nomor WhatsApp bisnis Anda.'],
        ['q' => 'Apakah cocok untuk UMKM kecil?', 'a' => 'Sangat cocok. Paket gratis sudah cukup untuk memulai katalog digital sederhana.'],
        ['q' => 'Apakah mendukung pelaku usaha disabilitas?', 'a' => 'Ya. Template ini mengutamakan kontras, struktur heading, navigasi keyboard, dan teks yang mudah dibaca.'],
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EtalaseKu - Katalog Digital Inklusif untuk UMKM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .skip-link {
            position: absolute;
            top: -100%;
            left: 1rem;
            z-index: 100;
            border-radius: .5rem;
            background: #FFD700;
            color: #000;
            padding: .5rem 1rem;
            font-size: .875rem;
            font-weight: 600;
            transition: top .2s;
        }

        .skip-link:focus {
            top: 1rem;
        }
    </style>
</head>
<body class="bg-[#0a0a0b] text-white antialiased">
    <a href="#hero" class="skip-link">Langsung ke konten utama</a>

    <div class="min-h-screen overflow-x-hidden">
        <header class="fixed left-0 right-0 top-0 z-50 px-4 py-3 md:px-8" role="banner">
            <nav class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-zinc-800/60 bg-zinc-900/80 px-5 py-3 backdrop-blur-xl md:px-8" aria-label="Navigasi utama">
                <a href="/" class="flex shrink-0 items-center gap-2" aria-label="EtalaseKu beranda">
                    <img src="/images/image4-removebg-preview.png" alt="Logo EtalaseKu" class="h-10 md:h-12">
                    <span class="text-2xl font-extrabold tracking-tight md:text-3xl">
                        <span>Etalase</span><span class="text-[#FFD700]">Ku</span>
                    </span>
                </a>

                <div class="hidden items-center gap-6 md:flex">
                    @foreach ($navLinks as $link)
                        <a href="#{{ $link['id'] }}" class="rounded px-2 py-1 text-sm text-zinc-400 transition hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-400/50">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="hidden items-center gap-3 md:flex">
                    <a href="/login" class="rounded-lg border border-zinc-700 px-4 py-2 text-sm font-medium text-zinc-300 transition hover:border-zinc-500 hover:text-white">Masuk</a>
                    <a href="/register" class="rounded-lg bg-[#FFD700] px-5 py-2 text-sm font-semibold text-black transition hover:bg-yellow-300">Daftar Gratis</a>
                </div>

                <button id="mobileMenuButton" type="button" class="rounded-lg p-2 text-zinc-400 hover:text-white md:hidden" aria-label="Buka menu" aria-expanded="false">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </nav>

            <div id="mobileMenu" class="mx-auto mt-2 hidden max-w-7xl rounded-2xl border border-zinc-800/60 bg-zinc-900/95 px-5 py-4 backdrop-blur-xl md:hidden">
                <div class="space-y-2">
                    @foreach ($navLinks as $link)
                        <a href="#{{ $link['id'] }}" class="block rounded px-2 py-2 text-sm text-zinc-400 hover:text-white">{{ $link['label'] }}</a>
                    @endforeach
                    <hr class="border-zinc-800">
                    <a href="/login" class="block rounded-lg border border-zinc-700 px-4 py-2 text-center text-sm font-medium text-zinc-300">Masuk</a>
                    <a href="/register" class="block rounded-lg bg-[#FFD700] px-4 py-2 text-center text-sm font-semibold text-black">Daftar Gratis</a>
                </div>
            </div>
        </header>

        <main id="hero">
            <section class="relative overflow-hidden px-6 pb-16 pt-36 md:pb-24 md:pt-44">
                <div class="pointer-events-none absolute -left-24 -top-48 h-[500px] w-[500px] rounded-full bg-yellow-500/10 blur-[120px]" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-36 -right-24 h-[400px] w-[400px] rounded-full bg-yellow-500/5 blur-[100px]" aria-hidden="true"></div>

                <div class="relative z-10 mx-auto max-w-7xl">
                    <div class="grid items-center gap-10 md:grid-cols-2 md:gap-16">
                        <div>
                            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-zinc-700/60 bg-zinc-800/60 px-4 py-1.5 text-xs text-zinc-400">
                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                Gratis untuk UMKM - tanpa biaya awal
                            </div>

                            <h1 class="text-3xl font-extrabold leading-tight tracking-tight md:text-5xl lg:text-6xl">
                                Katalog Digital Inklusif
                                <br>
                                <span class="text-[#FFD700]">untuk UMKM</span>
                                <br>
                                yang Ingin Lebih Mudah Ditemukan
                            </h1>

                            <p class="mt-5 max-w-xl text-base leading-relaxed text-zinc-300 md:text-lg">
                                Buat katalog toko online dalam hitungan menit. Bagikan satu tautan ke pelanggan agar mereka bisa melihat produk, menghubungi via WhatsApp, dan pesan langsung.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="/register" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FFD700] px-7 py-3.5 font-semibold text-black shadow-lg shadow-yellow-500/20 transition hover:bg-yellow-300">
                                    Mulai Gratis
                                    <span aria-hidden="true">-&gt;</span>
                                </a>
                                <a href="#showcase" class="inline-flex items-center justify-center rounded-xl border border-zinc-700 px-7 py-3.5 font-semibold text-zinc-200 transition hover:border-zinc-500 hover:text-white">
                                    Lihat Contoh Katalog
                                </a>
                            </div>

                            <div class="mt-7 flex flex-wrap gap-x-5 gap-y-2 text-sm text-zinc-500">
                                <span class="text-emerald-400">✓ <span class="text-zinc-500">Gratis selamanya</span></span>
                                <span class="text-emerald-400">✓ <span class="text-zinc-500">Aksesibilitas WCAG AA</span></span>
                                <span class="text-emerald-400">✓ <span class="text-zinc-500">Ribuan UMKM bergabung</span></span>
                            </div>
                        </div>

                        <div class="relative mx-auto w-full max-w-sm md:max-w-md">
                            <div class="rounded-[2rem] border border-zinc-700 bg-zinc-900 p-5 shadow-2xl shadow-black/40">
                                <div class="flex items-center gap-3 border-b border-zinc-800 pb-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-500/20 font-bold text-[#FFD700]">K</div>
                                    <div>
                                        <p class="font-semibold">Kue Bu Ani</p>
                                        <p class="text-xs text-zinc-500">Kue & Camilan Rumahan</p>
                                    </div>
                                </div>

                                <p class="mt-4 text-sm text-zinc-400">Toko kue rumahan siap antar. Pesan sekarang!</p>

                                <div class="mt-3 flex gap-2">
                                    <span class="rounded-md bg-emerald-500/10 px-2 py-1 text-xs font-semibold text-emerald-400">WhatsApp</span>
                                    <span class="rounded-md bg-pink-500/10 px-2 py-1 text-xs font-semibold text-pink-400">Instagram</span>
                                </div>

                                <div class="mt-5 space-y-3">
                                    @foreach ([['Kue Ulang Tahun', 'Rp 85.000'], ['Kue Kering Lebaran', 'Rp 45.000'], ['Cupcake Kustom', 'Rp 25.000']] as $product)
                                        <div class="flex items-center gap-3 rounded-xl bg-zinc-800/60 p-3">
                                            <div class="h-12 w-12 rounded-lg bg-yellow-500/20"></div>
                                            <div>
                                                <p class="text-sm font-semibold">{{ $product[0] }}</p>
                                                <p class="text-xs text-zinc-500">{{ $product[1] }}</p>
                                                <p class="text-xs font-semibold text-emerald-400">Pesan via WhatsApp</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fitur" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Fitur Utama untuk <span class="text-[#FFD700]">UMKM Digital</span></h2>
                        <p class="mt-4 text-sm leading-relaxed text-zinc-400 md:text-base">Semua yang dibutuhkan untuk membuat katalog online yang rapi, mudah dibagikan, dan dipercaya pelanggan.</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($fiturUtama as $item)
                            <article class="rounded-2xl border border-zinc-800/60 bg-zinc-900/40 p-5">
                                <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFD700]/10 text-[#FFD700]">✓</div>
                                <h3 class="font-semibold">{{ $item['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $item['desc'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="showcase" class="bg-zinc-900/30 px-6 py-16 md:py-24">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Contoh Katalog UMKM di <span class="text-[#FFD700]">EtalaseKu</span></h2>
                        <p class="mt-4 text-sm text-zinc-400 md:text-base">Tampilan katalog yang sederhana, profesional, dan mudah digunakan pelanggan.</p>
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        @foreach ([['Akses Mandiri', 'Alat Bantu Disabilitas'], ['Difabel Berkarya', 'Kerajinan Tangan'], ['Rasa Inklusif', 'Makanan & Minuman']] as $merchant)
                            <article class="rounded-2xl border border-zinc-800/60 bg-zinc-950 p-5">
                                <div class="mb-5 h-32 rounded-xl bg-gradient-to-br from-yellow-500/20 to-zinc-800"></div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-[#FFD700]">{{ $merchant[1] }}</p>
                                <h3 class="mt-2 text-lg font-bold">{{ $merchant[0] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-zinc-400">Profil toko, produk, kontak, dan pesanan dalam satu halaman katalog.</p>
                                <a href="#" class="mt-5 inline-flex text-sm font-semibold text-[#FFD700]">Lihat katalog -&gt;</a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="layanan" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Layanan yang Membantu <span class="text-[#FFD700]">Usaha Tumbuh</span></h2>
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        @foreach ($layanan as $item)
                            <article class="rounded-2xl border border-zinc-800/60 bg-zinc-900/40 p-6">
                                <h3 class="font-semibold">{{ $item['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $item['desc'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="untuk-siapa" class="bg-zinc-900/30 px-6 py-16 md:py-24">
                <div class="mx-auto max-w-5xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Untuk Siapa <span class="text-[#FFD700]">Template Ini?</span></h2>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($audiences as $audience)
                            <div class="rounded-2xl border border-zinc-800/60 bg-zinc-950 p-5 text-center font-semibold text-zinc-200">{{ $audience }}</div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="harga" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-5xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Pilih Paket yang Sesuai untuk <span class="text-[#FFD700]">Usaha Anda</span></h2>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <article class="rounded-2xl border border-zinc-800/60 bg-zinc-900/40 p-6">
                            <p class="text-sm font-semibold text-zinc-400">Gratis</p>
                            <p class="mt-3 text-4xl font-extrabold">Rp 0</p>
                            <p class="mt-2 text-sm text-zinc-400">Untuk UMKM yang baru memulai katalog digital.</p>
                            <ul class="mt-6 space-y-3 text-sm text-zinc-300">
                                <li>✓ Maks 10 produk</li>
                                <li>✓ Profil toko</li>
                                <li>✓ Link bisnis tak terbatas</li>
                                <li>✓ Statistik dasar</li>
                            </ul>
                            <a href="/register" class="mt-6 block rounded-xl bg-zinc-800 px-5 py-3 text-center font-semibold text-zinc-200">Daftar Gratis</a>
                        </article>

                        <article class="relative rounded-2xl border border-[#FFD700]/40 bg-[#003366]/10 p-6 shadow-lg shadow-yellow-500/5">
                            <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-[#FFD700] px-4 py-1 text-xs font-bold text-black">PALING POPULER</span>
                            <p class="text-sm font-semibold text-[#FFD700]">Pro</p>
                            <p class="mt-3 text-4xl font-extrabold">Rp 49.000 <span class="text-sm font-medium text-zinc-400">/bulan</span></p>
                            <p class="mt-2 text-sm text-zinc-400">Untuk UMKM yang ingin berkembang dengan fitur lengkap.</p>
                            <ul class="mt-6 space-y-3 text-sm text-zinc-300">
                                <li>✓ Produk tanpa batas</li>
                                <li>✓ Statistik lengkap</li>
                                <li>✓ Tema custom</li>
                                <li>✓ Verified Seller</li>
                                <li>✓ QRIS Payment</li>
                            </ul>
                            <a href="/register" class="mt-6 block rounded-xl bg-[#FFD700] px-5 py-3 text-center font-semibold text-black">Upgrade ke Pro</a>
                        </article>
                    </div>
                </div>
            </section>

            <section id="faq" class="bg-zinc-900/30 px-6 py-16 md:py-24">
                <div class="mx-auto max-w-3xl">
                    <div class="mb-12 text-center">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl">Pertanyaan <span class="text-[#FFD700]">Umum</span></h2>
                    </div>

                    <div class="space-y-3">
                        @foreach ($faq as $i => $item)
                            <article class="overflow-hidden rounded-2xl border border-zinc-800/60 bg-zinc-900/40">
                                <button type="button" class="faq-button flex w-full items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false">
                                    <span class="text-sm font-medium">{{ $item['q'] }}</span>
                                    <span class="text-zinc-500">⌄</span>
                                </button>
                                <div class="faq-answer hidden px-5 pb-4">
                                    <p class="text-sm leading-relaxed text-zinc-400">{{ $item['a'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="relative overflow-hidden px-6 py-16 md:py-24">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-2xl font-extrabold tracking-tight md:text-5xl">
                        Siap Membawa UMKM Anda
                        <br>
                        <span class="text-[#FFD700]">ke Dunia Digital?</span>
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-sm leading-relaxed text-zinc-400 md:text-base">
                        Mulai buat katalog digital dan tautan bisnis yang mudah dibagikan ke pelanggan.
                    </p>
                    <a href="/register" class="mt-8 inline-flex rounded-xl bg-[#FFD700] px-8 py-3.5 font-semibold text-black transition hover:bg-yellow-300">Mulai Gratis Sekarang</a>
                </div>
            </section>
        </main>

        <footer class="border-t border-zinc-800 px-6 py-10 md:py-14">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <a href="/" class="inline-flex items-center gap-2">
                        <img src="/images/image4-removebg-preview.png" alt="Logo EtalaseKu" class="h-10">
                        <span class="text-2xl font-extrabold"><span>Etalase</span><span class="text-[#FFD700]">Ku</span></span>
                    </a>
                    <p class="mt-3 max-w-sm text-sm leading-relaxed text-zinc-500">Platform katalog digital inklusif untuk UMKM Indonesia.</p>
                </div>

                <p class="text-xs text-zinc-600">&copy; {{ date('Y') }} EtalaseKu. Semua hak dilindungi.</p>
            </div>
        </footer>
    </div>

    <script>
        const menuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        menuButton?.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            menuButton.setAttribute('aria-expanded', String(!isHidden));
        });

        document.querySelectorAll('#mobileMenu a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuButton.setAttribute('aria-expanded', 'false');
            });
        });

        document.querySelectorAll('.faq-button').forEach((button) => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                const isOpen = !answer.classList.contains('hidden');

                document.querySelectorAll('.faq-answer').forEach((item) => item.classList.add('hidden'));
                document.querySelectorAll('.faq-button').forEach((item) => item.setAttribute('aria-expanded', 'false'));

                if (!isOpen) {
                    answer.classList.remove('hidden');
                    button.setAttribute('aria-expanded', 'true');
                }
            });
        });
    </script>
</body>
</html>
