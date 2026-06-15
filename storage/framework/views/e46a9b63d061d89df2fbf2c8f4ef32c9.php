<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Daftar Program Inclusive - EtalaseKu</title>

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
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --nav-bg: rgba(24, 24, 24, 0.8);
            --purple: #a855f7;
            --pink: #ec4899;
        }

        html.light {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-card: #ffffff;
            --border-color: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --accent: #d97706;
            --accent-hover: #b45309;
            --accent-light: rgba(217, 119, 6, 0.1);
            --success: #059669;
            --error: #dc2626;
            --warning: #d97706;
            --info: #2563eb;
            --nav-bg: rgba(255, 255, 255, 0.9);
            --purple: #9333ea;
            --pink: #db2777;
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

        /* Theme Toggle */
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
        .theme-toggle svg { width: 18px; height: 18px; }
        .sun-icon { display: block; }
        .moon-icon { display: none; }
        html.light .sun-icon { display: none; }
        html.light .moon-icon { display: block; }

        /* Form Styles */
        .form-input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1.5px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-primary);
            font-size: 15px;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }
        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-error {
            color: var(--error);
            font-size: 13px;
            margin-top: 4px;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 140px;
        }

        select.form-input {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 20px;
            padding-right: 48px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px 24px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--purple) 0%, var(--pink) 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px -3px rgba(168, 85, 247, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -5px rgba(168, 85, 247, 0.4);
        }

        .benefit-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .benefit-card:hover {
            border-color: var(--purple);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px -12px rgba(168, 85, 247, 0.25);
        }
        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .benefit-icon svg {
            width: 24px;
            height: 24px;
        }
        .benefit-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }
        .benefit-desc {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.08) 0%, rgba(236, 72, 153, 0.08) 100%);
            border: 1px solid rgba(168, 85, 247, 0.2);
            border-radius: 16px;
            padding: 20px;
        }
        .info-box-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-box-title svg {
            width: 20px;
            height: 20px;
            color: var(--purple);
        }
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-list li {
            font-size: 13px;
            color: var(--text-secondary);
            padding: 8px 0;
            border-bottom: 1px solid rgba(168, 85, 247, 0.1);
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .info-list li:last-child {
            border-bottom: none;
        }
        .info-list li::before {
            content: "✓";
            color: var(--purple);
            font-weight: 600;
        }

        /* File Upload Box Styles */
        .file-upload-wrapper {
            position: relative;
        }
        .file-upload-box {
            border: 2px dashed var(--border-color);
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--bg-card);
            position: relative;
        }
        .file-upload-box:hover {
            border-color: var(--purple);
            background: rgba(168, 85, 247, 0.05);
        }
        .file-upload-box.dragover {
            border-color: var(--purple);
            background: rgba(168, 85, 247, 0.1);
            transform: scale(1.02);
        }
        .file-upload-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-content {
            pointer-events: none;
        }
        .file-upload-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .file-upload-icon svg {
            width: 28px;
            height: 28px;
        }
        .file-upload-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }
        .file-upload-action {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }
        .file-upload-hint {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* File Preview Box */
        .file-preview-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
        }
        .file-preview-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(236, 72, 153, 0.15));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .file-preview-icon-box svg {
            width: 24px;
            height: 24px;
            color: var(--purple);
        }
        .file-preview-text {
            flex: 1;
            min-width: 0;
            text-align: left;
        }
        .file-preview-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .file-preview-size {
            font-size: 12px;
            color: var(--text-muted);
        }
        .file-preview-remove-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.1);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .file-preview-remove-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }
        .file-preview-remove-btn svg {
            width: 16px;
            height: 16px;
            color: var(--error);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
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
    <div class="min-h-screen">
        <!-- Header -->
        <header class="px-6 py-4 lg:px-12">
            <div class="mx-auto flex max-w-6xl items-center justify-between">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 transition hover:opacity-90">
                    <img src="<?php echo e(asset('images/image4-removebg-preview.png')); ?>" alt="Logo EtalaseKu" class="h-10 md:h-12">
                    <span class="text-2xl font-extrabold tracking-tight lg:text-3xl">
                        <span>Etalase</span><span style="color: var(--accent);">Ku</span>
                    </span>
                </a>

                <div class="flex items-center gap-3">
                    <button onclick="toggleTheme()" class="theme-toggle" title="Ganti Tema">
                        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                    <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-1.5 rounded-md px-3 py-2 text-sm transition" style="color: var(--text-muted);">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="px-6 py-8 lg:px-12">
            <div class="mx-auto max-w-3xl">
                <!-- Success/Info Messages -->
                <?php if(session('success')): ?>
                    <div class="mb-6 rounded-xl border p-4" style="background: rgba(16, 185, 129, 0.1); border-color: var(--success); color: var(--success);">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <?php echo e(session('success')); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('info')): ?>
                    <div class="mb-6 rounded-xl border p-4" style="background: rgba(59, 130, 246, 0.1); border-color: var(--info); color: var(--info);">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <?php echo e(session('info')); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-6 rounded-xl border p-4" style="background: rgba(239, 68, 68, 0.1); border-color: var(--error); color: var(--error);">
                        <ul class="list-inside list-disc">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Header Section -->
                <div class="mb-10 text-center animate-fade-in">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-3xl" style="background: linear-gradient(135deg, var(--purple), var(--pink)); box-shadow: 0 8px 32px -4px rgba(168, 85, 247, 0.4);">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-3" style="color: var(--text-primary);">Program Inclusive</h1>
                    <p class="text-lg" style="color: var(--text-secondary);">EtalaseKu untuk Penyandang Disabilitas Indonesia</p>
                </div>

                <!-- Benefits Section -->
                <div class="mb-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="benefit-card animate-fade-in delay-100">
                        <div class="benefit-icon" style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(236, 72, 153, 0.15));">
                            <svg style="color: var(--purple);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="benefit-title">Plan Pro Gratis</h3>
                        <p class="benefit-desc">6 bulan akses gratis semua fitur premium</p>
                    </div>
                    <div class="benefit-card animate-fade-in delay-200">
                        <div class="benefit-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));">
                            <svg style="color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="benefit-title">Produk Unlimited</h3>
                        <p class="benefit-desc">Tanpa batas jumlah produk</p>
                    </div>
                    <div class="benefit-card animate-fade-in delay-300">
                        <div class="benefit-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.15));">
                            <svg style="color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <h3 class="benefit-title">Produk Digital</h3>
                        <p class="benefit-desc">Jual e-book, template & digital</p>
                    </div>
                    <div class="benefit-card animate-fade-in delay-400">
                        <div class="benefit-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.15));">
                            <svg style="color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="benefit-title">Tanpa Watermark</h3>
                        <p class="benefit-desc">Etalase bersih tanpa watermark</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="rounded-3xl border p-8 sm:p-10" style="background: var(--bg-card); border-color: var(--border-color); backdrop-filter: blur(10px);">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--purple), var(--pink));">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color: var(--text-primary);">Formulir Pendaftaran</h2>
                            <p class="text-sm" style="color: var(--text-muted);">Lengkapi data di bawah untuk mengajukan permohonan</p>
                        </div>
                    </div>

                    <form action="<?php echo e(route('inclusive-program.submit')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <!-- Name -->
                            <div>
                                <label for="applicant_name" class="form-label">
                                    Nama Lengkap <span style="color: var(--pink);">*</span>
                                </label>
                                <input type="text" id="applicant_name" name="applicant_name" required
                                       value="<?php echo e(old('applicant_name')); ?>"
                                       class="form-input <?php $__errorArgs = ['applicant_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       placeholder="Masukkan nama lengkap Anda">
                                <?php $__errorArgs = ['applicant_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-error"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="form-label">
                                    Email <span style="color: var(--pink);">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                       value="<?php echo e(old('email')); ?>"
                                       class="form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       placeholder="nama@email.com">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-error"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <!-- WhatsApp -->
                            <div>
                                <label for="whatsapp" class="form-label">
                                    Nomor WhatsApp <span style="color: var(--pink);">*</span>
                                </label>
                                <input type="tel" id="whatsapp" name="whatsapp" required
                                       value="<?php echo e(old('whatsapp')); ?>"
                                       class="form-input <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       placeholder="08xxxxxxxxxx">
                                <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-error"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Disability Type -->
                            <div>
                                <label for="disability_type" class="form-label">
                                    Jenis Disabilitas <span style="color: var(--pink);">*</span>
                                </label>
                                <select id="disability_type" name="disability_type" required
                                        class="form-input <?php $__errorArgs = ['disability_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">Pilih jenis disabilitas</option>
                                    <option value="physical" <?php echo e(old('disability_type') === 'physical' ? 'selected' : ''); ?>>Disabilitas Fisik</option>
                                    <option value="visual" <?php echo e(old('disability_type') === 'visual' ? 'selected' : ''); ?>>Disabilitas Netra / Tunanetra</option>
                                    <option value="hearing" <?php echo e(old('disability_type') === 'hearing' ? 'selected' : ''); ?>>Disabilitas Rungu / Wicara</option>
                                    <option value="intellectual" <?php echo e(old('disability_type') === 'intellectual' ? 'selected' : ''); ?>>Disabilitas Intelektual</option>
                                    <option value="mental" <?php echo e(old('disability_type') === 'mental' ? 'selected' : ''); ?>>Disabilitas Mental / Psikososial</option>
                                    <option value="multiple" <?php echo e(old('disability_type') === 'multiple' ? 'selected' : ''); ?>>Disabilitas Ganda</option>
                                </select>
                                <?php $__errorArgs = ['disability_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-error"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Reason / Story -->
                        <div>
                            <label for="reason" class="form-label">
                                Ceritakan Kisah Anda <span style="color: var(--pink);">*</span>
                            </label>
                            <textarea id="reason" name="reason" required
                                      class="form-input <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      placeholder="Ceritakan bagaimana EtalaseKu dapat membantu usaha atau pekerjaan Anda... (minimal 50 karakter)"><?php echo e(old('reason')); ?></textarea>
                            <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="form-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Expected Benefits (Optional) -->
                        <div>
                            <label for="expected_benefits" class="form-label">
                                Manfaat yang Diharapkan <span class="text-sm" style="color: var(--text-muted);">(opsional)</span>
                            </label>
                            <textarea id="expected_benefits" name="expected_benefits"
                                      class="form-input <?php $__errorArgs = ['expected_benefits'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      placeholder="Apa yang Anda harapkan dari program ini..."><?php echo e(old('expected_benefits')); ?></textarea>
                        </div>

                        <!-- File Uploads -->
                        <div>
                            <h3 class="form-label mb-4" style="font-size: 15px; display: flex; align-items: center; gap: 8px;">
                                <svg class="w-5 h-5" style="color: var(--purple);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Unggah Dokumen <span class="text-sm" style="color: var(--text-muted); font-weight: 400;">(opsional)</span>
                            </h3>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <!-- KTP -->
                                <div class="file-upload-wrapper">
                                    <div class="file-upload-box" id="ktp_upload">
                                        <input type="file" name="ktp_file" id="ktp_file" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="file-upload-content">
                                            <div class="file-upload-icon" style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(236, 72, 153, 0.15));">
                                                <svg style="color: var(--purple);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                                </svg>
                                            </div>
                                            <p class="file-upload-title">KTP</p>
                                            <p class="file-upload-action">Klik atau drag file ke sini</p>
                                            <p class="file-upload-hint">JPG, PNG, atau PDF (maks 2MB)</p>
                                        </div>
                                    </div>
                                    <div class="file-preview-box" id="ktp_preview" style="display: none;">
                                        <div class="file-preview-icon-box">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="file-preview-text">
                                            <p class="file-preview-name" id="ktp_filename"></p>
                                            <p class="file-preview-size" id="ktp_filesize"></p>
                                        </div>
                                        <button type="button" class="file-preview-remove-btn" onclick="removeFile('ktp')">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Certificate -->
                                <div class="file-upload-wrapper">
                                    <div class="file-upload-box" id="cert_upload">
                                        <input type="file" name="certificate_file" id="certificate_file" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="file-upload-content">
                                            <div class="file-upload-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));">
                                                <svg style="color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <p class="file-upload-title">Sertifikat</p>
                                            <p class="file-upload-action">Klik atau drag file ke sini</p>
                                            <p class="file-upload-hint">JPG, PNG, atau PDF (maks 2MB)</p>
                                        </div>
                                    </div>
                                    <div class="file-preview-box" id="cert_preview" style="display: none;">
                                        <div class="file-preview-icon-box" style="background: linear-gradient(135deg, var(--purple), var(--pink));">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="file-preview-text">
                                            <p class="file-preview-name" id="cert_filename"></p>
                                            <p class="file-preview-size" id="cert_filesize"></p>
                                        </div>
                                        <button type="button" class="file-preview-remove-btn" onclick="removeFile('cert')">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="info-box-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Penting
                            </div>
                            <ul class="info-list">
                                <li>Review dilakukan dalam 1-3 hari kerja</li>
                                <li>Kami mungkin akan menghubungi untuk verifikasi</li>
                                <li>Akun akan dibuat otomatis setelah disetujui</li>
                                <li>Password login akan dikirim via Email</li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Permohonan
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-12 border-t px-6 py-6 lg:px-12" style="border-color: var(--border-color);">
            <div class="mx-auto max-w-6xl text-center text-sm" style="color: var(--text-muted);">
                <p>&copy; <?php echo e(date('Y')); ?> EtalaseKu. Semua hak dilindungi.</p>
            </div>
        </footer>
    </div>

    <script>
        // Show filename when file is selected
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function handleFileSelect(input, previewId, filenameId, filesizeId, uploadId) {
            const file = input.files[0];
            if (file) {
                document.getElementById(filenameId).textContent = file.name;
                document.getElementById(filesizeId).textContent = formatFileSize(file.size);
                document.getElementById(previewId).style.display = 'flex';
                document.getElementById(uploadId).style.display = 'none';
            }
        }

        function removeFile(type) {
            if (type === 'ktp') {
                document.getElementById('ktp_file').value = '';
                document.getElementById('ktp_preview').style.display = 'none';
                document.getElementById('ktp_upload').style.display = 'block';
            } else {
                document.getElementById('certificate_file').value = '';
                document.getElementById('cert_preview').style.display = 'none';
                document.getElementById('cert_upload').style.display = 'block';
            }
        }

        // File input handlers
        document.getElementById('ktp_file').addEventListener('change', function() {
            handleFileSelect(this, 'ktp_preview', 'ktp_filename', 'ktp_filesize', 'ktp_upload');
        });

        document.getElementById('certificate_file').addEventListener('change', function() {
            handleFileSelect(this, 'cert_preview', 'cert_filename', 'cert_filesize', 'cert_upload');
        });

        // Drag and drop handlers
        ['ktp_upload', 'cert_upload'].forEach(id => {
            const uploadArea = document.getElementById(id);
            if (uploadArea) {
                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.add('dragover');
                });

                uploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.remove('dragover');
                });

                uploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.remove('dragover');
                    const inputId = id === 'ktp_upload' ? 'ktp_file' : 'certificate_file';
                    const input = document.getElementById(inputId);
                    if (e.dataTransfer.files.length) {
                        input.files = e.dataTransfer.files;
                        input.dispatchEvent(new Event('change'));
                    }
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\EtalaseKU\resources\views/inclusive-program/form.blade.php ENDPATH**/ ?>