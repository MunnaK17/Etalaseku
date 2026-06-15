<?php
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

    // Demo stores for showcase (dummy data)
    $showcaseStores = collect([
        [
            'name' => 'Akses Mandiri',
            'username' => 'aksesmandiri',
            'logo_initial' => 'A',
            'header_gradient_start' => '#7c3aed',
            'header_gradient_end' => '#5b21b6',
            'description' => 'Alat Bantu Disabilitas',
            'about_text' => 'Penyedia alat bantu disabilitas berkualitas untuk kemandirian sehari-hari.',
            'products' => [
                ['name' => 'Tongkat Lipat', 'price' => 85000, 'emoji' => '🦯'],
                ['name' => 'Kursi Roda Lipat', 'price' => 2450000, 'emoji' => '🦽'],
            ],
            'cta_button_color' => '#7c3aed',
            'is_verified' => true,
            'is_inclusive' => true,
            'stats' => ['products' => 24, 'visits' => 1200, 'orders' => 89],
        ],
        [
            'name' => 'Sahabat Tuli Indonesia',
            'username' => 'sahabattuli',
            'logo_initial' => 'S',
            'header_gradient_start' => '#2563eb',
            'header_gradient_end' => '#1d4ed8',
            'description' => 'Pendidikan Inklusif',
            'about_text' => 'Komunitas pendidikan dan pelatihan bahasa isyarat untuk komunitas Tuli.',
            'products' => [
                ['name' => 'Kamus BISINDO', 'price' => 65000, 'emoji' => '📖'],
                ['name' => 'Kelas Bahasa Isyarat', 'price' => 150000, 'emoji' => '🎓'],
            ],
            'cta_button_color' => '#2563eb',
            'is_verified' => true,
            'is_inclusive' => true,
            'stats' => ['products' => 18, 'visits' => 3400, 'orders' => 156],
        ],
        [
            'name' => 'Difabel Berkarya',
            'username' => 'difabelberkarya',
            'logo_initial' => 'D',
            'header_gradient_start' => '#059669',
            'header_gradient_end' => '#047857',
            'description' => 'Kerajinan, Inklusif',
            'about_text' => 'Kerajinan tangan unik karya penyandang disabilitas, berkualitas tinggi.',
            'products' => [
                ['name' => 'Tas Rajut Eksklusif', 'price' => 120000, 'emoji' => '👜'],
                ['name' => 'Dompet Batik Tuli', 'price' => 55000, 'emoji' => '👛'],
            ],
            'cta_button_color' => '#059669',
            'is_inclusive' => true,
            'stats' => ['products' => 32, 'visits' => 2800, 'orders' => 0],
        ],
        [
            'name' => 'Kriya Nusantara',
            'username' => 'kriyanusantara',
            'logo_initial' => 'K',
            'header_gradient_start' => '#0d9488',
            'header_gradient_end' => '#0f766e',
            'description' => 'Kerajinan Nusantara',
            'about_text' => 'Kerajinan Nusantara asli dari pengrajin lokal Indonesia.',
            'products' => [
                ['name' => 'Patung Kayu', 'price' => 350000, 'emoji' => '🗿'],
                ['name' => 'Anyaman Bambu', 'price' => 180000, 'emoji' => '🪵'],
            ],
            'cta_button_color' => '#0d9488',
            'is_verified' => true,
            'stats' => ['products' => 45, 'visits' => 5200, 'orders' => 234],
        ],
        [
            'name' => 'Rasa Inklusif',
            'username' => 'rasainklusif',
            'logo_initial' => 'R',
            'header_gradient_start' => '#ea580c',
            'header_gradient_end' => '#c2410c',
            'description' => 'Makanan & Minuman',
            'about_text' => 'Makanan dan minuman sehat untuk semua, diproduksi secara inklusif.',
            'products' => [
                ['name' => 'Kue Kering Pack', 'price' => 85000, 'emoji' => '🍪'],
                ['name' => 'Wedang Rempah', 'price' => 45000, 'emoji' => '🍵'],
            ],
            'cta_button_color' => '#ea580c',
            'is_inclusive' => true,
            'stats' => ['products' => 28, 'visits' => 4100, 'orders' => 178],
        ],
        [
            'name' => 'Busana Adopsi',
            'username' => 'busanaadopsi',
            'logo_initial' => 'B',
            'header_gradient_start' => '#db2777',
            'header_gradient_end' => '#be185d',
            'description' => 'Fashion Adaptif',
            'about_text' => 'Fashion adaptif untuk semua kebutuhan, nyaman dan stylish.',
            'products' => [
                ['name' => 'Baju Adaptif', 'price' => 175000, 'emoji' => '👕'],
                ['name' => 'Celana Sensitif', 'price' => 125000, 'emoji' => '👖'],
            ],
            'cta_button_color' => '#db2777',
            'is_inclusive' => true,
            'stats' => ['products' => 36, 'visits' => 890, 'orders' => 45],
        ],
        [
            'name' => 'Craft Studio',
            'username' => 'craftstudio',
            'logo_initial' => 'C',
            'header_gradient_start' => '#d97706',
            'header_gradient_end' => '#b45309',
            'description' => 'Kerajinan Tangan',
            'about_text' => 'Studio kerajinan tangan dengan bahan berkualitas dan desain modern.',
            'products' => [
                ['name' => 'Scrapbook Kit', 'price' => 75000, 'emoji' => '📒'],
                ['name' => 'Resin Art', 'price' => 120000, 'emoji' => '💎'],
            ],
            'cta_button_color' => '#d97706',
            'is_verified' => true,
            'stats' => ['products' => 52, 'visits' => 3600, 'orders' => 112],
        ],
    ]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EtalaseKu - Katalog Digital Inklusif untuk UMKM Indonesia. Buat katalog produk online, terima pesanan via WhatsApp, dan tingkatkan penjualan.">
    <title>EtalaseKu - Katalog Digital Inklusif untuk UMKM</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* Theme CSS Variables */
        :root {
            --bg-primary: #0a0a0b;
            --bg-secondary: #181818;
            --bg-tertiary: #272722;
            --bg-card: rgba(24, 24, 24, 0.4);
            --border-color: rgba(38, 38, 38, 0.6);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #FFD700;
            --accent-hover: #fbbf24;
            --accent-light: rgba(255, 215, 0, 0.1);
            --success: #10b981;
            --nav-bg: rgba(24, 24, 24, 0.8);
            --glow-yellow: rgba(255, 215, 0, 0.1);
            --glow-yellow-light: rgba(255, 215, 0, 0.05);
            --shadow-color: rgba(0, 0, 0, 0.4);
        }

        html.light {
            --bg-primary: #ffffff;
            --bg-secondary: #f1f5f9;
            --bg-tertiary: #e2e8f0;
            --bg-card: #ffffff;
            --border-color: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #334155;
            --text-muted: #64748b;
            --accent: #d97706;
            --accent-hover: #b45309;
            --accent-light: rgba(217, 119, 6, 0.12);
            --success: #059669;
            --nav-bg: rgba(255, 255, 255, 0.95);
            --glow-yellow: rgba(217, 119, 6, 0.15);
            --glow-yellow-light: rgba(217, 119, 6, 0.08);
            --shadow-color: rgba(15, 23, 42, 0.1);
        }

        /* Theme Transition - Enhanced */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Faster transitions for interactive elements */
        button, a, input, select, textarea {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease,
                        transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease !important;
        }

        /* Disable transition on page load */
        .no-transition, .no-transition * {
            transition: none !important;
        }

        /* ============================================
           SCROLL ANIMATIONS
           ============================================ */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-on-scroll.fade-left {
            transform: translateX(-40px);
        }
        .animate-on-scroll.fade-left.visible {
            transform: translateX(0);
        }

        .animate-on-scroll.fade-right {
            transform: translateX(40px);
        }
        .animate-on-scroll.fade-right.visible {
            transform: translateX(0);
        }

        .animate-on-scroll.scale-in {
            transform: scale(0.9);
        }
        .animate-on-scroll.scale-in.visible {
            transform: scale(1);
        }

        /* Staggered delay for children */
        .stagger-children > * {
            transition-delay: calc(var(--stagger-index, 0) * 0.1s);
        }

        /* ============================================
           ENHANCED CARD EFFECTS
           ============================================ */
        .feature-card {
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.3s ease;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                rgba(255, 215, 0, 0.05) 0%,
                transparent 50%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px var(--shadow-color),
                        0 0 30px rgba(255, 215, 0, 0.1);
            border-color: rgba(255, 215, 0, 0.3);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:active {
            transform: translateY(-4px) scale(1.01);
        }

        /* ============================================
           BUTTON EFFECTS
           ============================================ */
        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-glow:hover::after {
            width: 300px;
            height: 300px;
        }

        .btn-primary-enhanced {
            position: relative;
            overflow: hidden;
        }

        .btn-primary-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-enhanced:hover::before {
            left: 100%;
        }

        /* ============================================
           AMBIENT GLOW ANIMATIONS
           ============================================ */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }

        .gradient-animated {
            background-size: 200% 200%;
            animation: gradient-shift 8s ease infinite;
        }

        /* ============================================
           SECTION TRANSITIONS
           ============================================ */
        section {
            position: relative;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom,
                transparent,
                transparent);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        section.in-view::before {
            opacity: 0;
        }

        /* Smooth gradient divider between sections */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg,
                transparent,
                var(--border-color) 20%,
                var(--border-color) 80%,
                transparent);
            position: relative;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 20px var(--accent);
        }

        /* ============================================
           INCLUSIVE CTA SECTION
           ============================================ */
        .inclusive-gradient {
            background: linear-gradient(135deg,
                rgba(168, 85, 247, 0.08) 0%,
                rgba(236, 72, 153, 0.08) 50%,
                rgba(168, 85, 247, 0.08) 100%);
            position: relative;
            overflow: hidden;
        }

        .inclusive-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle,
                rgba(168, 85, 247, 0.1) 0%,
                transparent 50%);
            animation: pulse-glow 8s ease-in-out infinite;
        }

        /* ============================================
           PRICING CARD HOVER
           ============================================ */
        .pricing-card {
            position: relative;
            overflow: hidden;
        }

        .pricing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg,
                var(--accent),
                #fbbf24,
                var(--accent));
            background-size: 200% 100%;
            animation: gradient-shift 3s ease infinite;
        }

        .pricing-card:hover {
            transform: translateY(-5px);
        }

        .pricing-card.popular {
            border-width: 2px;
        }

        /* ============================================
           AUDIENCE BADGES
           ============================================ */
        .audience-badge {
            position: relative;
            overflow: hidden;
        }

        .audience-badge::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle,
                rgba(255, 215, 0, 0.1) 0%,
                transparent 30%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .audience-badge:hover {
            transform: scale(1.05);
            border-color: var(--accent);
        }

        .audience-badge:hover::after {
            opacity: 1;
        }

        /* ============================================
           FAQ ACCORDION
           ============================================ */
        .faq-item {
            transition: transform 0.3s ease;
        }

        .faq-item:hover {
            transform: translateX(4px);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        opacity 0.3s ease,
                        padding 0.3s ease;
            opacity: 0;
        }

        .faq-answer.open {
            max-height: 200px;
            opacity: 1;
        }

        .skip-link {
            position: absolute;
            top: -100%;
            left: 1rem;
            z-index: 100;
            border-radius: .5rem;
            background: var(--accent);
            color: #000;
            padding: .5rem 1rem;
            font-size: .875rem;
            font-weight: 600;
            transition: top .2s;
        }

        .skip-link:focus {
            top: 1rem;
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

        /* Body styles using CSS variables */
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Navigation styles */
        .nav-container {
            background: var(--nav-bg);
            border-color: var(--border-color);
        }
        .nav-link {
            color: var(--text-secondary);
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: var(--text-primary);
        }
        html.light .nav-link:hover {
            color: var(--accent);
        }

        /* Text colors */
        .text-heading {
            color: var(--text-primary);
        }
        .text-body {
            color: var(--text-secondary);
        }
        .text-muted {
            color: var(--text-muted);
        }
        .text-accent {
            color: var(--accent);
        }

        /* Background colors */
        .bg-card {
            background: var(--bg-card);
            border-color: var(--border-color);
        }
        .bg-secondary {
            background: var(--bg-secondary);
        }
        .bg-tertiary {
            background: var(--bg-tertiary);
        }

        /* Border colors */
        .border-custom {
            border-color: var(--border-color);
        }

        /* Glow effects */
        .glow-yellow {
            background: var(--glow-yellow);
        }
        .glow-yellow-light {
            background: var(--glow-yellow-light);
        }
    </style>
    <script>
        // Theme Management
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
    <a href="#hero" class="skip-link">Langsung ke konten utama</a>

    <div class="min-h-screen overflow-x-hidden">
        <header class="fixed left-0 right-0 top-0 z-50 px-4 py-3 md:px-8" role="banner">
            <nav class="nav-container mx-auto flex max-w-7xl items-center justify-between rounded-2xl border px-5 py-3 backdrop-blur-xl md:px-8" aria-label="Navigasi utama">
                <a href="<?php echo e(route('home')); ?>" class="flex shrink-0 items-center gap-2" aria-label="EtalaseKu beranda">
                    <img src="<?php echo e(asset('images/image4-removebg-preview.png')); ?>" alt="Logo EtalaseKu" class="h-10 md:h-12">
                    <span class="text-2xl font-extrabold tracking-tight md:text-3xl">
                        <span>Etalase</span><span class="text-accent">Ku</span>
                    </span>
                </a>

                <div class="hidden items-center gap-6 md:flex">
                    <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#<?php echo e($link['id']); ?>" class="nav-link rounded px-2 py-1 text-sm transition focus-visible:outline-none focus-visible:ring-2" style="--tw-ring-color: var(--accent);">
                            <?php echo e($link['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="hidden items-center gap-3 md:flex">
                    <!-- Theme Toggle -->
                    <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme">
                        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $user = auth()->user();
                            $store = $user->store;
                        ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    @click.away="open = false"
                                    class="flex items-center gap-2 rounded-lg border px-3 py-2 text-sm transition"
                                    style="border-color: var(--border-color); color: var(--text-secondary);"
                                    aria-label="Menu akun">
                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-yellow-500/20 font-semibold" style="color: var(--accent);">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <span class="hidden lg:inline"><?php echo e($user->name); ?></span>
                                <svg class="h-4 w-4" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open"
                                 x-transition
                                 class="absolute right-0 top-full mt-2 w-56 overflow-hidden rounded-xl border shadow-xl"
                                 style="background: var(--bg-secondary); border-color: var(--border-color);">
                                <div class="border-b px-4 py-3" style="border-color: var(--border-color);">
                                    <p class="text-sm font-medium" style="color: var(--text-primary);"><?php echo e($user->name); ?></p>
                                    <p class="text-xs" style="color: var(--text-muted);"><?php echo e($user->email); ?></p>
                                </div>
                                <div class="py-2">
                                    <a href="<?php echo e(route('seller.dashboard')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm transition-colors" style="color: var(--text-secondary);">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        Dashboard
                                    </a>
                                    <?php if($store): ?>
                                        <a href="<?php echo e($store->public_url); ?>" target="_blank" class="flex items-center gap-3 px-4 py-2 text-sm transition-colors" style="color: var(--text-secondary);">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                            Lihat Etalase Saya
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="border-t py-2" style="border-color: var(--border-color);">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-sm transition-colors" style="color: #ef4444;">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="rounded-lg border px-4 py-2 text-sm font-medium transition" style="border-color: var(--border-color); color: var(--text-secondary);">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="rounded-lg px-5 py-2 text-sm font-semibold transition" style="background: var(--accent); color: #000;">Daftar Gratis</a>
                    <?php endif; ?>
                </div>

                <button id="mobileMenuButton" type="button" class="rounded-lg p-2 md:hidden" style="color: var(--text-secondary);" aria-label="Buka menu" aria-expanded="false">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </nav>

            <div id="mobileMenu" class="mx-auto mt-2 hidden max-w-7xl rounded-2xl px-5 py-4 backdrop-blur-xl md:hidden" style="background: var(--nav-bg); border: 1px solid var(--border-color);">
                <div class="space-y-2">
                    <!-- Theme Toggle Mobile -->
                    <button onclick="toggleTheme()" class="theme-toggle w-full justify-center mb-2" title="Toggle theme">
                        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <span>Ganti Tema</span>
                    </button>
                    <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#<?php echo e($link['id']); ?>" class="nav-link block rounded px-2 py-2 text-sm"><?php echo e($link['label']); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr style="border-color: var(--border-color);">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('seller.dashboard')); ?>" class="block rounded-lg border px-4 py-2 text-center text-sm font-medium text-center" style="border-color: var(--border-color); color: var(--text-secondary);">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="mt-2 w-full rounded-lg px-4 py-2 text-center text-sm font-medium" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">Keluar</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="block rounded-lg border px-4 py-2 text-center text-sm font-medium" style="border-color: var(--border-color); color: var(--text-secondary);">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="block rounded-lg px-4 py-2 text-center text-sm font-semibold text-center" style="background: var(--accent); color: #000;">Daftar Gratis</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <main id="hero">
            <section class="relative overflow-hidden px-6 pb-16 pt-36 md:pb-24 md:pt-44">
                <div class="pointer-events-none absolute -left-24 -top-48 h-[500px] w-[500px] rounded-full blur-[120px] pulse-glow" style="background: var(--glow-yellow);" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-36 -right-24 h-[400px] w-[400px] rounded-full blur-[100px] pulse-glow" style="background: var(--glow-yellow-light); animation-delay: -2s;" aria-hidden="true"></div>

                <div class="relative z-10 mx-auto max-w-7xl">
                    <div class="grid items-center gap-10 md:grid-cols-2 md:gap-16">
                        <div class="animate-on-scroll">
                            <div class="mb-6 inline-flex items-center gap-2 rounded-full border px-4 py-1.5 text-xs" style="border-color: var(--border-color); background: var(--bg-tertiary); color: var(--text-secondary);">
                                <span class="h-2 w-2 rounded-full animate-pulse" style="background: var(--success);"></span>
                                Gratis untuk UMKM - tanpa biaya awal
                            </div>

                            <h1 class="text-3xl font-extrabold leading-tight tracking-tight md:text-5xl lg:text-6xl" style="color: var(--text-primary);">
                                Katalog Digital Inklusif
                                <br>
                                <span style="color: var(--accent);">untuk UMKM</span>
                                <br>
                                yang Ingin Lebih Mudah Ditemukan
                            </h1>

                            <p class="mt-5 max-w-xl text-base leading-relaxed md:text-lg" style="color: var(--text-secondary);">
                                Buat katalog toko online dalam hitungan menit. Bagikan satu tautan ke pelanggan agar mereka bisa melihat produk, menghubungi via WhatsApp, dan pesan langsung.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="<?php echo e(route('register')); ?>" class="btn-glow inline-flex items-center justify-center gap-2 rounded-xl px-7 py-3.5 font-semibold shadow-lg btn-primary-enhanced transition-all duration-300" style="background: var(--accent); color: #000; box-shadow: 0 10px 25px -5px var(--shadow-color, rgba(255, 215, 0, 0.3));">
                                    Mulai Gratis
                                    <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">-></span>
                                </a>
                                <a href="#showcase" class="inline-flex items-center justify-center gap-2 rounded-xl border px-7 py-3.5 font-semibold transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]" style="border-color: var(--border-color); color: var(--text-secondary);">
                                    Lihat Contoh Katalog
                                </a>
                            </div>

                            <div class="mt-7 flex flex-wrap gap-x-5 gap-y-2 text-sm" style="color: var(--text-muted);">
                                <span style="color: var(--success);">✓ <span>Gratis selamanya</span></span>
                                <span style="color: var(--success);">✓ <span>Aksesibilitas WCAG AA</span></span>
                                <span style="color: var(--success);">✓ <span>Ribuan UMKM bergabung</span></span>
                            </div>
                        </div>

                        <div class="relative mx-auto w-full max-w-sm md:max-w-md animate-on-scroll fade-right" style="animation-delay: 0.2s;">
                            <div class="rounded-[2rem] border p-5 shadow-xl float-animation" style="background: var(--bg-secondary); border-color: var(--border-color); box-shadow: 0 25px 50px -12px var(--shadow-color, rgba(0,0,0,0.25));">
                                <div class="flex items-center gap-3 border-b pb-4" style="border-color: var(--border-color);">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full font-bold" style="background: var(--accent-light); color: var(--accent);">K</div>
                                    <div>
                                        <p class="font-semibold" style="color: var(--text-primary);">Kue Bu Ani</p>
                                        <p class="text-xs" style="color: var(--text-muted);">Kue & Camilan Rumahan</p>
                                    </div>
                                </div>

                                <p class="mt-4 text-sm" style="color: var(--text-secondary);">Toko kue rumahan siap antar. Pesan sekarang!</p>

                                <div class="mt-3 flex gap-2">
                                    <span class="rounded-md px-2 py-1 text-xs font-semibold" style="background: rgba(16, 185, 129, 0.1); color: var(--success);">WhatsApp</span>
                                    <span class="rounded-md px-2 py-1 text-xs font-semibold" style="background: rgba(236, 72, 153, 0.1); color: #ec4899;">Instagram</span>
                                </div>

                                <div class="mt-5 space-y-3">
                                    <?php $__currentLoopData = [['Kue Ulang Tahun', 'Rp 85.000'], ['Kue Kering Lebaran', 'Rp 45.000'], ['Cupcake Kustom', 'Rp 25.000']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center gap-3 rounded-xl p-3 transition-all duration-300 hover:scale-[1.02] hover:bg-[var(--bg-tertiary)]" style="background: var(--bg-tertiary);">
                                            <div class="h-12 w-12 rounded-lg" style="background: var(--accent-light);"></div>
                                            <div>
                                                <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e($product[0]); ?></p>
                                                <p class="text-xs" style="color: var(--text-muted);"><?php echo e($product[1]); ?></p>
                                                <p class="text-xs font-semibold" style="color: var(--success);">Pesan via WhatsApp</p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fitur" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Fitur Utama untuk <span style="color: var(--accent);">UMKM Digital</span></h2>
                        <p class="mt-4 text-sm leading-relaxed md:text-base" style="color: var(--text-muted);">Semua yang dibutuhkan untuk membuat katalog online yang rapi, mudah dibagikan, dan dipercaya pelanggan.</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 stagger-children">
                        <?php $__currentLoopData = $fiturUtama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="feature-card rounded-2xl border p-5 animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); --stagger-index: <?php echo e($index); ?>;">
                                <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl transition-transform duration-300 hover:scale-110" style="background: var(--accent-light); color: var(--accent);">✓</div>
                                <h3 class="font-semibold" style="color: var(--text-primary);"><?php echo e($item['title']); ?></h3>
                                <p class="mt-2 text-sm leading-relaxed" style="color: var(--text-secondary);"><?php echo e($item['desc']); ?></p>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>

            <section id="showcase" class="px-6 py-16 md:py-24 animate-on-scroll" style="background: var(--bg-secondary);">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Contoh Katalog UMKM di <span style="color: var(--accent);">EtalaseKu</span></h2>
                        <p class="mt-4 text-sm md:text-base" style="color: var(--text-muted);">Tampilan katalog yang sederhana, profesional, dan mudah digunakan pelanggan.</p>
                    </div>

                    <!-- Store Carousel -->
                    <div class="store-carousel-wrapper">
                        <!-- Navigation Arrows -->
                        <button type="button"
                                class="carousel-nav-btn prev"
                                onclick="scrollCarousel(this, -1)"
                                aria-label="Sebelumnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <div class="store-carousel" id="storeCarousel">
                            <?php $__currentLoopData = $showcaseStores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginal4ee6d2dad7e78095161f35fa7a094231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4ee6d2dad7e78095161f35fa7a094231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.store-preview-card','data' => ['store' => $store]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('store-preview-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['store' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($store)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4ee6d2dad7e78095161f35fa7a094231)): ?>
<?php $attributes = $__attributesOriginal4ee6d2dad7e78095161f35fa7a094231; ?>
<?php unset($__attributesOriginal4ee6d2dad7e78095161f35fa7a094231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4ee6d2dad7e78095161f35fa7a094231)): ?>
<?php $component = $__componentOriginal4ee6d2dad7e78095161f35fa7a094231; ?>
<?php unset($__componentOriginal4ee6d2dad7e78095161f35fa7a094231); ?>
<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <button type="button"
                                class="carousel-nav-btn next"
                                onclick="scrollCarousel(this, 1)"
                                aria-label="Selanjutnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Scroll Hint -->
                    <div class="carousel-scroll-hint">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        <span class="text-xs">Geser untuk melihat lebih banyak</span>
                    </div>
                </div>
            </section>

            <section id="layanan" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-6xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Layanan yang Membantu <span style="color: var(--accent);">Usaha Tumbuh</span></h2>
                    </div>

                    <div class="grid gap-4 md:grid-cols-3 stagger-children">
                        <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="feature-card rounded-2xl border p-6 animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); --stagger-index: <?php echo e($index); ?>;">
                                <h3 class="font-semibold" style="color: var(--text-primary);"><?php echo e($item['title']); ?></h3>
                                <p class="mt-2 text-sm leading-relaxed" style="color: var(--text-secondary);"><?php echo e($item['desc']); ?></p>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>

            <section id="untuk-siapa" class="px-6 py-16 md:py-24 animate-on-scroll" style="background: var(--bg-secondary);">
                <div class="mx-auto max-w-5xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Untuk Siapa <span style="color: var(--accent);">Template Ini?</span></h2>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 stagger-children">
                        <?php $__currentLoopData = $audiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $audience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="audience-badge rounded-2xl border p-5 text-center font-semibold animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); color: var(--text-primary); --stagger-index: <?php echo e($index); ?>;"><?php echo e($audience); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>

            <!-- Inclusive Program CTA -->
            <section class="inclusive-gradient px-6 py-16 md:py-24">
                <div class="relative z-10 mx-auto max-w-4xl text-center animate-on-scroll">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-2xl float-animation" style="background: linear-gradient(135deg, #a855f7, #ec4899);">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">
                        Penyandang Disabilitas?
                    </h2>
                    <p class="mx-auto mt-4 max-w-2xl text-base md:text-lg" style="color: var(--text-secondary);">
                        Dapatkan akses Plan Pro EtalaseKu <strong style="color: var(--accent);">GRATIS selama 6 bulan</strong> untuk mendukung usaha Anda.
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4 stagger-children" style="max-width: 700px; margin-left: auto; margin-right: auto;">
                        <?php $__currentLoopData = [
                            ['value' => 'Pro', 'label' => 'Plan Gratis'],
                            ['value' => '∞', 'label' => 'Produk'],
                            ['value' => '0', 'label' => 'Watermark'],
                            ['value' => '6', 'label' => 'Bulan Gratis']
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="pricing-card rounded-xl border p-4 animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); --stagger-index: <?php echo e($index); ?>;">
                                <p class="text-2xl font-bold" style="color: var(--accent);"><?php echo e($stat['value']); ?></p>
                                <p class="text-sm" style="color: var(--text-muted);"><?php echo e($stat['label']); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <a href="<?php echo e(route('inclusive-program.form')); ?>" class="btn-glow btn-primary-enhanced mt-8 inline-flex items-center gap-2 rounded-xl px-8 py-4 font-semibold transition-all duration-300" style="background: linear-gradient(135deg, #a855f7, #ec4899); color: #fff;">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Daftar Program Inclusive
                    </a>
                </div>
            </section>

            <section id="harga" class="px-6 py-16 md:py-24">
                <div class="mx-auto max-w-5xl">
                    <div class="mx-auto mb-12 max-w-3xl text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Pilih Paket yang Sesuai untuk <span style="color: var(--accent);">Usaha Anda</span></h2>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2 stagger-children">
                        <article class="pricing-card rounded-2xl border p-6 animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); --stagger-index: 0;">
                            <p class="text-sm font-semibold" style="color: var(--text-secondary);">Gratis</p>
                            <p class="mt-3 text-4xl font-extrabold" style="color: var(--text-primary);">Rp 0</p>
                            <p class="mt-2 text-sm" style="color: var(--text-muted);">Untuk UMKM yang baru memulai katalog digital.</p>
                            <ul class="mt-6 space-y-3 text-sm" style="color: var(--text-secondary);">
                                <li>✓ Maks 10 produk</li>
                                <li>✓ Profil toko</li>
                                <li>✓ Link bisnis tak terbatas</li>
                                <li>✓ Statistik dasar</li>
                            </ul>
                            <a href="<?php echo e(route('register')); ?>" class="mt-6 block rounded-xl px-5 py-3 text-center font-semibold transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]" style="background: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">Daftar Gratis</a>
                        </article>

                        <article class="pricing-card popular relative rounded-2xl border-2 p-6 shadow-lg animate-on-scroll" style="background: var(--bg-card); border-color: var(--accent); box-shadow: 0 20px 40px -12px var(--shadow-color, rgba(217, 119, 6, 0.2)); --stagger-index: 1;">
                            <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full px-4 py-1 text-xs font-bold" style="background: var(--accent); color: #000;">PALING POPULER</span>
                            <p class="text-sm font-semibold" style="color: var(--accent);">Pro</p>
                            <p class="mt-3 text-4xl font-extrabold" style="color: var(--text-primary);">Rp 49.000 <span class="text-sm font-medium" style="color: var(--text-muted);">/bulan</span></p>
                            <p class="mt-2 text-sm" style="color: var(--text-muted);">Untuk UMKM yang ingin berkembang dengan fitur lengkap.</p>
                            <ul class="mt-6 space-y-3 text-sm" style="color: var(--text-secondary);">
                                <li>✓ Produk tanpa batas</li>
                                <li>✓ Statistik lengkap</li>
                                <li>✓ Tema custom</li>
                                <li>✓ Verified Seller</li>
                                <li>✓ QRIS Payment</li>
                            </ul>
                            <a href="<?php echo e(route('register')); ?>?plan=pro" class="btn-glow btn-primary-enhanced mt-6 block rounded-xl px-5 py-3 text-center font-semibold transition-all duration-300" style="background: var(--accent); color: #000;">Upgrade ke Pro</a>
                        </article>
                    </div>
                </div>
            </section>

            <section id="faq" class="px-6 py-16 md:py-24 animate-on-scroll" style="background: var(--bg-secondary);">
                <div class="mx-auto max-w-3xl">
                    <div class="mb-12 text-center animate-on-scroll">
                        <h2 class="text-2xl font-extrabold tracking-tight md:text-4xl" style="color: var(--text-primary);">Pertanyaan <span style="color: var(--accent);">Umum</span></h2>
                    </div>

                    <div class="space-y-3 stagger-children">
                        <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="faq-item overflow-hidden rounded-2xl border animate-on-scroll" style="background: var(--bg-card); border-color: var(--border-color); --stagger-index: <?php echo e($index); ?>;">
                                <button type="button" class="faq-button flex w-full items-center justify-between gap-4 px-5 py-4 text-left transition-all duration-300 hover:bg-[var(--bg-tertiary)]" aria-expanded="false">
                                    <span class="text-sm font-medium" style="color: var(--text-primary);"><?php echo e($item['q']); ?></span>
                                    <span class="faq-icon transition-transform duration-300" style="color: var(--text-muted);">⌄</span>
                                </button>
                                <div class="faq-answer px-5 pb-4">
                                    <p class="text-sm leading-relaxed" style="color: var(--text-secondary);"><?php echo e($item['a']); ?></p>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>

            <section class="relative overflow-hidden px-6 py-16 md:py-24">
                <div class="pointer-events-none absolute -left-24 -top-48 h-[500px] w-[500px] rounded-full blur-[120px] pulse-glow" style="background: var(--glow-yellow);" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-36 -right-24 h-[400px] w-[400px] rounded-full blur-[100px] pulse-glow" style="background: var(--glow-yellow-light); animation-delay: -2s;" aria-hidden="true"></div>

                <div class="relative z-10 mx-auto max-w-3xl text-center animate-on-scroll">
                    <h2 class="text-2xl font-extrabold tracking-tight md:text-5xl" style="color: var(--text-primary);">
                        Siap Membawa UMKM Anda
                        <br>
                        <span style="color: var(--accent);">ke Dunia Digital?</span>
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-sm leading-relaxed md:text-base" style="color: var(--text-secondary);">
                        Mulai buat katalog digital dan tautan bisnis yang mudah dibagikan ke pelanggan.
                    </p>
                    <a href="<?php echo e(route('register')); ?>" class="btn-glow btn-primary-enhanced mt-8 inline-flex rounded-xl px-8 py-3.5 font-semibold transition-all duration-300 hover:scale-[1.03] active:scale-[0.98]" style="background: var(--accent); color: #000;">Mulai Gratis Sekarang</a>
                </div>
            </section>
        </main>

        <footer class="border-t px-6 py-10 md:py-14" style="border-color: var(--border-color);">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-2">
                        <img src="<?php echo e(asset('images/image4-removebg-preview.png')); ?>" alt="Logo EtalaseKu" class="h-10">
                        <span class="text-2xl font-extrabold"><span>Etalase</span><span style="color: var(--accent);">Ku</span></span>
                    </a>
                    <p class="mt-3 max-w-sm text-sm leading-relaxed" style="color: var(--text-muted);">Platform katalog digital inklusif untuk UMKM Indonesia.</p>
                </div>

                <div class="flex flex-wrap gap-6 text-sm" style="color: var(--text-muted);">
                    <a href="#" class="transition-colors hover:opacity-80" style="color: var(--text-secondary);">Syarat & Ketentuan</a>
                    <a href="#" class="transition-colors hover:opacity-80" style="color: var(--text-secondary);">Privasi</a>
                    <a href="#" class="transition-colors hover:opacity-80" style="color: var(--text-secondary);">Bantuan</a>
                    <a href="#" class="transition-colors hover:opacity-80" style="color: var(--text-secondary);">Kontak</a>
                </div>

                <p class="text-xs" style="color: var(--text-muted);">&copy; <?php echo e(date('Y')); ?> EtalaseKu. Semua hak dilindungi.</p>
            </div>
        </footer>
    </div>

    <script>
        // Mobile menu toggle
        const menuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        menuButton?.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            menuButton.setAttribute('aria-expanded', String(!isHidden));
        });

        document.querySelectorAll('#mobileMenu a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuButton?.setAttribute('aria-expanded', 'false');
            });
        });

        // ============================================
        // FAQ ACCORDION - Enhanced with smooth animation
        // ============================================
        document.querySelectorAll('.faq-button').forEach((button) => {
            button.addEventListener('click', () => {
                const item = button.closest('.faq-item');
                const answer = item.querySelector('.faq-answer');
                const icon = button.querySelector('.faq-icon');
                const isOpen = answer.classList.contains('open');

                // Close all others first
                document.querySelectorAll('.faq-item').forEach((faqItem) => {
                    const faqAnswer = faqItem.querySelector('.faq-answer');
                    const faqIcon = faqItem.querySelector('.faq-icon');
                    const faqButton = faqItem.querySelector('.faq-button');

                    faqAnswer.classList.remove('open');
                    faqIcon.style.transform = 'rotate(0deg)';
                    faqButton.setAttribute('aria-expanded', 'false');
                });

                // Toggle current with animation
                if (!isOpen) {
                    answer.classList.add('open');
                    icon.style.transform = 'rotate(180deg)';
                    button.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // ============================================
        // SMOOTH SCROLL FOR ANCHOR LINKS
        // ============================================
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // ============================================
        // INTERSECTION OBSERVER FOR SCROLL ANIMATIONS
        // ============================================
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Add visible class to trigger animation
                    entry.target.classList.add('visible');

                    // Handle staggered children animation
                    const children = entry.target.querySelectorAll('.animate-on-scroll');
                    children.forEach((child, index) => {
                        setTimeout(() => {
                            child.classList.add('visible');
                        }, index * 100);
                    });
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach((el) => {
            animationObserver.observe(el);
        });

        // ============================================
        // STORE CAROUSEL NAVIGATION
        // ============================================
        function scrollCarousel(button, direction) {
            const wrapper = button.closest('.store-carousel-wrapper');
            const carousel = wrapper.querySelector('.store-carousel');
            const cardWidth = 320 + 20; // card width + gap
            const scrollAmount = cardWidth * 2; // scroll 2 cards at a time

            carousel.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        // Update arrow visibility based on scroll position
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('storeCarousel');
            if (carousel) {
                const updateArrows = () => {
                    const wrapper = carousel.closest('.store-carousel-wrapper');
                    const prevBtn = wrapper.querySelector('.prev');
                    const nextBtn = wrapper.querySelector('.next');

                    if (prevBtn) prevBtn.disabled = carousel.scrollLeft <= 0;
                    if (nextBtn) nextBtn.disabled = carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 10;
                };

                carousel.addEventListener('scroll', updateArrows);
                updateArrows(); // Initial state
            }
        });

        // ============================================
        // PARALLAX EFFECT FOR BACKGROUND GLOWS
        // ============================================
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const glows = document.querySelectorAll('.pulse-glow');
                    glows.forEach((glow, index) => {
                        const speed = index === 0 ? 0.1 : 0.05;
                        glow.style.transform = `translateY(${scrolled * speed}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/landing.blade.php ENDPATH**/ ?>