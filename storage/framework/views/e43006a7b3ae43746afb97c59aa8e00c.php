<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="<?php echo e($store->description ?? 'Kunjungi etalase ' . $store->name); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($store->name); ?> - EtalaseKu</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛒</text></svg>">

    <!-- Dynamic Google Font Loader -->
    <?php
        $fontFamily = $store->font_family ?? 'Inter';
        $fontUrl = '';
        $fallbackFamily = 'sans-serif';

        $fontMap = [
            'Helvetica' => ['url' => null, 'fallback' => 'system-ui, sans-serif'],
            'Lato' => ['url' => 'Lato:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Raleway' => ['url' => 'Raleway:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Montserrat' => ['url' => 'Montserrat:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Roboto' => ['url' => 'Roboto:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Poppins' => ['url' => 'Poppins:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Inter' => ['url' => 'Inter:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Playfair Display' => ['url' => 'Playfair+Display:wght@400;500;600;700', 'fallback' => 'serif'],
            'Bodoni MT' => ['url' => null, 'fallback' => "'Bodoni MT', 'Times New Roman', serif"],
            'JetBrains Mono' => ['url' => 'JetBrains+Mono:wght@400;500;600;700', 'fallback' => 'monospace'],
            'Great Vibes' => ['url' => 'Great+Vibes:wght@400;500;600;700', 'fallback' => 'cursive'],
            'East Sea Dokdo' => ['url' => 'East+Sea+Dokdo:wght@400', 'fallback' => 'cursive'],
            'Satisfy' => ['url' => 'Satisfy:wght@400', 'fallback' => 'cursive'],
            'Fredoka' => ['url' => 'Fredoka:wght@400;500;600;700', 'fallback' => 'sans-serif'],
            'Letter Gothic Std' => ['url' => 'Roboto+Mono:wght@400;500', 'fallback' => 'monospace'],
            'Roboto Mono' => ['url' => 'Roboto+Mono:wght@400;500', 'fallback' => 'monospace'],
        ];

        if (isset($fontMap[$fontFamily])) {
            if ($fontMap[$fontFamily]['url']) {
                $fontUrl = 'https://fonts.googleapis.com/css2?family=' . $fontMap[$fontFamily]['url'] . '&display=swap';
            }
            $fallbackFamily = $fontMap[$fontFamily]['fallback'];
        }
    ?>

    <?php if($fontUrl): ?>
    <!-- Dynamic Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo e($fontUrl); ?>" rel="stylesheet">
    <?php endif; ?>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['<?php echo e($fontFamily); ?>', '<?php echo e($fallbackFamily); ?>'],
                    },
                    colors: {
                        primary: {
                            50: '<?php echo e($store->header_gradient_start ?? '#6366f1'); ?>15',
                            100: '<?php echo e($store->header_gradient_start ?? '#6366f1'); ?>25',
                            500: '<?php echo e($store->header_gradient_start ?? '#6366f1'); ?>',
                            600: '<?php echo e($store->header_gradient_end ?? '#4f46e5'); ?>',
                            700: '<?php echo e($store->header_gradient_end ?? '#4338ca'); ?>',
                        },
                        whatsapp: {
                            500: '#25D366',
                            600: '#128C7E',
                        },
                    },
                },
            },
        }
    </script>

    <style>
        /* CSS Variables for Template - Uses Store Settings */
        :root {
            --bg-color: <?php echo e($store->background_color ?? $store->getCurrentTemplateConfig()['bg_color'] ?? '#FFFFFF'); ?>;
            --bg-secondary: <?php echo e($store->background_color ? $store->background_color : ($store->getCurrentTemplateConfig()['bg_secondary'] ?? 'transparent')); ?>;
            --button-color: <?php echo e($store->cta_button_color ?? $store->getCurrentTemplateConfig()['button_color'] ?? '#4F46E5'); ?>;
            --text-color: <?php echo e($store->getCurrentTemplateConfig()['text_color'] ?? '#1F2937'); ?>;
            --header-start: <?php echo e($store->header_gradient_start ?? $store->getCurrentTemplateConfig()['header_gradient_start'] ?? '#4F46E5'); ?>;
            --header-end: <?php echo e($store->header_gradient_end ?? $store->getCurrentTemplateConfig()['header_gradient_end'] ?? '#4338CA'); ?>;
            --card-bg: <?php echo e($store->getCurrentTemplateConfig()['card_bg'] ?? '#FFFFFF'); ?>;
            --card-text: <?php echo e($store->getCurrentTemplateConfig()['card_text'] ?? '#1F2937'); ?>;
        }

        /* Apply background based on store settings */
        <?php
            $bgColor = $store->background_color ?? $store->getCurrentTemplateConfig()['bg_color'] ?? '#FFFFFF';
            $bgType = $store->background_type ?? 'flat';
            $gradientStart = $store->background_gradient_start ?? $store->header_gradient_start ?? '#4F46E5';
            $gradientEnd = $store->background_gradient_end ?? $bgColor;
            $pageBackgroundStyle = match ($bgType) {
                'gradient_up' => "background: linear-gradient(180deg, {$gradientStart} 0%, {$gradientEnd} 100%);",
                'gradient_down' => "background: linear-gradient(0deg, {$gradientStart} 0%, {$gradientEnd} 100%);",
                'image' => ($store->background_image && $store->isPro())
                    ? "background-image: url('{$store->background_image}'); background-size: cover; background-position: center; background-attachment: fixed;"
                    : "background-color: {$bgColor};",
                default => "background-color: {$bgColor};",
            };
        ?>
        <?php if($bgType === 'gradient_up'): ?>
            body { background: linear-gradient(180deg, <?php echo e($gradientStart); ?> 0%, <?php echo e($gradientEnd); ?> 100%) !important; }
        <?php elseif($bgType === 'gradient_down'): ?>
            body { background: linear-gradient(0deg, <?php echo e($gradientStart); ?> 0%, <?php echo e($gradientEnd); ?> 100%) !important; }
        <?php elseif($bgType === 'image' && $store->background_image && $store->isPro()): ?>
            body { background-image: url('<?php echo e($store->background_image); ?>') !important; background-size: cover; background-position: center; background-attachment: fixed; }
        <?php else: ?>
            body { background-color: <?php echo e($bgColor); ?> !important; }
        <?php endif; ?>

        .store-shell {
            <?php echo $pageBackgroundStyle; ?>

        }
        .store-main {
            <?php echo $pageBackgroundStyle; ?>

        }
        .layout-classic .profile-card {
            align-items: center;
            text-align: center;
            flex-direction: column;
        }
        .layout-classic .profile-copy {
            text-align: center;
        }
        .layout-classic .profile-name-row {
            justify-content: center;
        }
        .layout-clean .store-header {
            background: transparent !important;
            color: #111827;
        }
        .layout-clean .header-wave,
        .layout-clean .profile-media,
        .layout-clean .header-actions {
            display: none;
        }
        .layout-clean .profile-card {
            margin-bottom: 0;
        }
        .layout-clean .profile-copy,
        .layout-clean .profile-name-row {
            text-align: center;
            justify-content: center;
        }
        .layout-clean .profile-name,
        .layout-clean .profile-about {
            color: var(--card-text) !important;
        }
        .store-social-links a {
            color: var(--card-text);
        }

        /* Smooth transitions */
        .block-item {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .block-item:active {
            transform: scale(0.98);
        }

        /* Hide scrollbar but allow scroll */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

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

        /* Focus Indicators - WCAG 2.2 AA */
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
        input:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
        a:focus-visible {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
        }

        /* Social icon colors */
        .social-instagram { color: #E4405F; }
        .social-tiktok { color: #000000; }
        .social-youtube { color: #FF0000; }
        .social-twitter { color: #1DA1F2; }
        .social-facebook { color: #1877F2; }
        .social-whatsapp { color: #25D366; }
        .social-telegram { color: #0088CC; }

        /* Button Shape Styles */
        <?php
            $buttonShape = $store->cta_button_shape ?? 'rounded';
            $ctaColor = $store->cta_button_color ?? $store->getCurrentTemplateConfig()['button_color'] ?? '#4F46E5';
            $ctaTextColor = $store->cta_button_text_color ?? $store->getCurrentTemplateConfig()['text_color'] ?? '#FFFFFF';
            $ctaStyle = $store->cta_button_style ?? 'fill';
        ?>

        /* CTA Button Base Styles */
        .cta-btn {
            <?php if($ctaStyle === 'outline'): ?>
                border: 2px solid <?php echo e($ctaColor); ?>;
                background: transparent;
                color: <?php echo e($ctaColor); ?>;
            <?php else: ?>
                background-color: <?php echo e($ctaColor); ?>;
                color: <?php echo e($ctaTextColor); ?>;
            <?php endif; ?>
        }
        .cta-btn:hover {
            <?php if($ctaStyle === 'outline'): ?>
                background: <?php echo e($ctaColor); ?>;
                color: white;
            <?php else: ?>
                filter: brightness(1.1);
            <?php endif; ?>
        }

        /* Hard Shadow Buttons */
        .btn-hard-shadow {
            box-shadow: 4px 4px 0px #000;
        }
        .btn-hard-shadow:hover {
            box-shadow: 2px 2px 0px #000;
            transform: translate(2px, 2px);
        }

        /* Soft Shadow Buttons */
        .btn-soft-shadow {
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-soft-shadow:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        }

        /* Rainbow Border Button */
        .btn-rainbow {
            position: relative;
            background: <?php echo e($ctaColor); ?>;
            border: none;
        }
        .btn-rainbow::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 3px;
            border-radius: inherit;
            background: linear-gradient(to right, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #8b00ff);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        /* Bracket Style Button */
        .btn-bracket::before { content: '<'; margin-right: 4px; opacity: 0.6; }
        .btn-bracket::after { content: '>'; margin-left: 4px; opacity: 0.6; }

        /* Scribble Style Button */
        .btn-scribble {
            position: relative;
            text-decoration: none;
        }
        .btn-scribble::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 15%;
            width: 70%;
            height: 3px;
            background: <?php echo e($ctaTextColor); ?>;
            opacity: 0.6;
            transform: rotate(-2deg);
            border-radius: 2px;
        }

        /* Glow Effects for Neon/Cyberpunk Templates */
        <?php if($store->getTemplateSpecialClass() === 'glow-neon'): ?>
            .btn-glow {
                box-shadow: 0 0 10px var(--button-color), 0 0 20px var(--button-color), 0 0 30px var(--button-color);
                animation: pulse-glow 2s ease-in-out infinite;
            }
            .btn-glow:hover {
                box-shadow: 0 0 15px var(--button-color), 0 0 30px var(--button-color), 0 0 45px var(--button-color);
            }
            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 10px var(--button-color), 0 0 20px var(--button-color); }
                50% { box-shadow: 0 0 15px var(--button-color), 0 0 30px var(--button-color), 0 0 40px var(--button-color); }
            }
        <?php endif; ?>

        <?php if($store->getTemplateSpecialClass() === 'glow-cyberpunk'): ?>
            .btn-glow {
                box-shadow: 0 0 12px #ff007f, 0 0 24px rgba(255, 0, 127, 0.5);
                animation: cyberpunk-pulse 1.5s ease-in-out infinite;
            }
            .btn-glow:hover {
                box-shadow: 0 0 20px #ff007f, 0 0 40px rgba(255, 0, 127, 0.7);
            }
            @keyframes cyberpunk-pulse {
                0%, 100% { box-shadow: 0 0 12px #ff007f, 0 0 24px rgba(255, 0, 127, 0.5); }
                50% { box-shadow: 0 0 18px #ff007f, 0 0 36px rgba(255, 0, 127, 0.7); }
            }
        <?php endif; ?>

        /* Monochrome Border Style */
        <?php if($store->getTemplateSpecialClass() === 'border-monochrome'): ?>
            .btn-outline-black {
                border: 2px solid #000000;
                background: transparent;
                color: #000000;
            }
            .btn-outline-black:hover {
                background: #000000;
                color: #ffffff;
            }
        <?php endif; ?>
    </style>
</head>
<?php
    $layout = $store->layout ?? 'modern';
    $socialLinks = $store->social_links ?? [];
?>
<body class="font-sans antialiased min-h-screen layout-<?php echo e($layout); ?> <?php if($store->getTemplateSpecialClass()): ?> body-template-<?php echo e($store->getTemplateSpecialClass()); ?> <?php endif; ?>" style="background-color: var(--bg-color);">
    <!-- Skip to Content - Accessibility -->
    <a href="#blocks-section" class="skip-to-content">Langsung ke konten</a>

    <div class="store-shell max-w-lg mx-auto min-h-screen shadow-xl flex flex-col">
        <!-- Store Header -->
        <header class="store-header" style="background: linear-gradient(135deg, <?php echo e($store->header_gradient_start ?? $store->getCurrentTemplateConfig()['header_gradient_start'] ?? '#4F46E5'); ?> 0%, <?php echo e($store->header_gradient_end ?? $store->getCurrentTemplateConfig()['header_gradient_end'] ?? '#4338CA'); ?> 100%);">
            <?php if($store->banner): ?>
            <!-- Banner -->
            <div class="h-32 bg-cover bg-center" style="background-image: url('<?php echo e($store->banner); ?>');"></div>
            <?php endif; ?>
            <div class="px-5 pt-6 pb-6">
                <!-- Profile Section -->
                <div class="profile-card flex items-center gap-4 mb-4">
                    <?php if (! ($layout === 'clean')): ?>
                        <div class="profile-media flex-shrink-0">
                            <?php if($store->profile_image): ?>
                                <img src="<?php echo e($store->profile_image); ?>"
                                     alt="<?php echo e($store->name); ?>"
                                     class="w-20 h-20 rounded-2xl object-cover border-4 border-white/20 shadow-lg">
                            <?php elseif($store->logo): ?>
                                <img src="<?php echo e($store->logo); ?>"
                                     alt="<?php echo e($store->name); ?>"
                                     class="w-20 h-20 rounded-2xl object-cover border-4 border-white/20 shadow-lg">
                            <?php else: ?>
                                <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center border-4 border-white/20">
                                    <span class="text-3xl font-bold"><?php echo e(substr($store->name, 0, 1)); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="profile-copy flex-1">
                        <div class="profile-name-row flex items-center gap-2">
                            <h1 class="profile-name text-2xl font-bold" style="color: <?php echo e($store->profile_text_color ?? '#FFFFFF'); ?>;"><?php echo e($store->name); ?></h1>
                            <?php if($store->is_verified_seller): ?>
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-500 rounded-full" title="Seller Terverifikasi">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if($store->about_text): ?>
                            <p class="profile-about text-sm mt-1 line-clamp-2" style="color: <?php echo e($layout === 'clean' ? 'var(--card-text)' : ($store->profile_text_color ?? '#FFFFFF')); ?>; opacity: <?php echo e($layout === 'clean' ? '1' : '0.85'); ?>;"><?php echo e($store->about_text); ?></p>
                        <?php elseif($store->description): ?>
                            <p class="profile-about text-sm mt-1 line-clamp-2" style="color: <?php echo e($layout === 'clean' ? 'var(--card-text)' : ($store->profile_text_color ?? '#FFFFFF')); ?>; opacity: <?php echo e($layout === 'clean' ? '1' : '0.85'); ?>;"><?php echo e($store->description); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons Row -->
                <div class="header-actions flex gap-3 mt-5">
                    <?php if($store->whatsapp): ?>
                        <a href="<?php echo e($store->whatsapp_link); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="cta-btn flex-1 flex items-center justify-center gap-2 font-semibold py-3 px-4 rounded-xl transition-all active:scale-[0.98] <?php if($store->getTemplateSpecialClass() === 'glow-neon' || $store->getTemplateSpecialClass() === 'glow-cyberpunk'): ?> btn-glow <?php endif; ?>">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Chat WhatsApp</span>
                        </a>
                    <?php endif; ?>

                    <!-- Share Button -->
                    <button onclick="shareStore()" class="flex items-center justify-center gap-2 bg-white/20 text-white font-semibold py-3 px-4 rounded-xl hover:bg-white/30 transition-all active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                    </button>
                </div>

                <?php if(count($socialLinks) > 0): ?>
                    <div class="store-social-links flex flex-wrap justify-center gap-2 mt-5">
                        <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($url); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-white/80 border border-white/40 text-xs font-semibold shadow-sm hover:bg-white transition"
                               title="<?php echo e(ucfirst($platform)); ?>">
                                <?php echo e(ucfirst($platform)); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Wave decoration -->
            <svg class="header-wave w-full h-6 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C57.1,118.92,156.63,69.08,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </header>

        <!-- Blocks Section -->
        <main id="blocks-section" class="store-main px-5 py-6 <?php echo e($layout === 'clean' ? 'pt-3' : '-mt-4'); ?> flex-1">
            <?php if($blocks->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php switch($block->type):
                            
                            case ('link'): ?>
                                <?php
                                    $linkContent = $block->content ? json_decode($block->content, true) : [];
                                    $linkUrl = $linkContent['url'] ?? '#';
                                    $openNewTab = $linkContent['open_in_new_tab'] ?? true;
                                ?>
                                <a href="<?php echo e($linkUrl); ?>"
                                   target="<?php echo e($openNewTab ? '_blank' : '_self'); ?>"
                                   rel="noopener noreferrer"
                                   class="block-item w-full flex items-center gap-3 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl p-4 transition-all">
                                    <div class="w-12 h-12 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 text-left">
                                        <p class="font-semibold text-gray-900"><?php echo e($block->title ?? 'Link'); ?></p>
                                        <p class="text-sm text-gray-500 truncate"><?php echo e($linkUrl); ?></p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            <?php break; ?>

                            
                            <?php case ('text'): ?>
                                <?php
                                    $textContent = $block->content ? json_decode($block->content, true) : [];
                                    $text = $textContent['text'] ?? '';
                                ?>
                                <div class="block-item bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <?php if($block->title): ?>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2"><?php echo e($block->title); ?></h3>
                                    <?php endif; ?>
                                    <div class="text-gray-700 prose prose-sm max-w-none">
                                        <?php echo nl2br(e($text)); ?>

                                    </div>
                                </div>
                            <?php break; ?>

                            
                            <?php case ('image'): ?>
                                <?php
                                    $imageContent = $block->content ? json_decode($block->content, true) : [];
                                    $alt = $imageContent['alt'] ?? $block->title ?? 'Image';
                                    $imageUrl = $imageContent['thumbnail_url'] ?? $block->thumbnail_url ?? '';
                                    $imageLink = $imageContent['link'] ?? '';
                                ?>
                                <div class="block-item rounded-xl overflow-hidden border border-gray-200">
                                    <?php if($imageLink): ?>
                                        <a href="<?php echo e($imageLink); ?>" target="_blank" rel="noopener noreferrer">
                                            <img src="<?php echo e($imageUrl); ?>"
                                                 alt="<?php echo e($alt); ?>"
                                                 class="w-full h-auto object-cover hover:opacity-90 transition-opacity"
                                                 loading="lazy">
                                        </a>
                                    <?php elseif($imageUrl): ?>
                                        <img src="<?php echo e($imageUrl); ?>"
                                             alt="<?php echo e($alt); ?>"
                                             class="w-full h-auto object-cover"
                                             loading="lazy">
                                    <?php endif; ?>
                                    <?php if($block->title): ?>
                                        <div class="p-3 bg-gray-50">
                                            <p class="text-sm text-gray-600"><?php echo e($block->title); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php break; ?>

                            
                            <?php case ('video'): ?>
                                <?php
                                    $videoContent = $block->content ? json_decode($block->content, true) : [];
                                    $embedUrl = $videoContent['embed_url'] ?? $videoContent['video_url'] ?? '';
                                ?>
                                <div class="block-item rounded-xl overflow-hidden border border-gray-200">
                                    <?php if($embedUrl): ?>
                                        <div class="relative pt-[56.25%] bg-gray-900">
                                            <iframe
                                                src="<?php echo e($embedUrl); ?>"
                                                class="absolute inset-0 w-full h-full"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                                loading="lazy">
                                            </iframe>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($block->title): ?>
                                        <div class="p-3 bg-gray-50">
                                            <p class="font-medium text-gray-900"><?php echo e($block->title); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php break; ?>

                            
                            <?php case ('social_network'): ?>
                            <?php case ('social_connect'): ?>
                                <?php
                                    $socialContent = $block->content ? json_decode($block->content, true) : [];
                                    $socials = $socialContent['socials'] ?? [];
                                ?>
                                <?php if(count($socials) > 0): ?>
                                <div class="block-item bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <?php if($block->title): ?>
                                        <h3 class="font-semibold text-gray-900 mb-3"><?php echo e($block->title); ?></h3>
                                    <?php endif; ?>
                                    <div class="flex flex-wrap justify-center gap-3">
                                        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($data['value']) && $data['value']): ?>
                                                <div class="flex flex-col items-center">
                                                    <a href="<?php echo e($store->formatSocialLink($platform, $data['value'])); ?>"
                                                       target="_blank"
                                                       rel="noopener noreferrer"
                                                       class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:scale-110 transition-transform shadow-sm"
                                                       title="<?php echo e(ucfirst($platform)); ?>">
                                                        <?php switch($platform):
                                                            case ('instagram'): ?>
                                                                <svg class="w-5 h-5 social-instagram" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('tiktok'): ?>
                                                                <svg class="w-5 h-5 social-tiktok" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('youtube'): ?>
                                                                <svg class="w-5 h-5 social-youtube" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('twitter'): ?>
                                                            <?php case ('x'): ?>
                                                                <svg class="w-5 h-5 social-twitter" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('facebook'): ?>
                                                                <svg class="w-5 h-5 social-facebook" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('whatsapp'): ?>
                                                                <svg class="w-5 h-5 social-whatsapp" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('telegram'): ?>
                                                                <svg class="w-5 h-5 social-telegram" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('shopee'): ?>
                                                                <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z"/></svg>
                                                                <?php break; ?>
                                                            <?php case ('tokopedia'): ?>
                                                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.02c-5.51 0-9.98 4.47-9.98 9.98s4.47 9.98 9.98 9.98 9.98-4.47 9.98-9.98-4.47-9.98-9.98-9.98zm0 1.5c4.69 0 8.48 3.81 8.48 8.48s-3.79 8.48-8.48 8.48-8.48-3.79-8.48-8.48 3.79-8.48 8.48-8.48zm-.5 2.48v5.18l4.16 2.42-.08.14-4.08-2.38v-5.36h-.5z"/></svg>
                                                                <?php break; ?>
                                                            <?php default: ?>
                                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                                        <?php endswitch; ?>
                                                    </a>
                                                    <?php if(isset($data['label']) && $data['label']): ?>
                                                        <span class="mt-1 text-xs font-semibold text-gray-700"><?php echo e($data['label']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php break; ?>

                            
                            <?php case ('product'): ?>
                            <?php case ('digital_product'): ?>
                                <?php
                                    $productContent = $block->content ? json_decode($block->content, true) : [];
                                    $productName = $productContent['name'] ?? $block->title ?? 'Produk';
                                    $productEmoji = $productContent['emoji'] ?? '';
                                    $productDescription = $productContent['description'] ?? '';
                                    $productPrice = $productContent['price'] ?? 0;
                                    $productImage = $productContent['image'] ?? $block->thumbnail_url ?? '';
                                    $ctaType = $productContent['cta_type'] ?? ($block->type === 'digital_product' ? 'checkout' : 'whatsapp');
                                    if ($ctaType === 'checkout' && empty($productContent['product_id'])) {
                                        $ctaType = 'whatsapp';
                                    }

                                    $whatsappLink = $store->whatsapp_link_with_message
                                        ? $store->whatsapp_link_with_message . '?text=' . urlencode("Halo, saya tertarik dengan \"{$productName}\" di etalase {$store->name}")
                                        : $store->whatsapp_link;
                                ?>
                                <div class="block-item bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                                    <?php if($productImage): ?>
                                        <div class="aspect-square bg-gray-100 overflow-hidden">
                                            <img src="<?php echo e($productImage); ?>"
                                                 alt="<?php echo e($productName); ?>"
                                                 class="w-full h-full object-cover"
                                                 loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                    <div class="p-4">
                                        <div class="flex items-start gap-2 mb-2">
                                            <?php if($productEmoji): ?>
                                                <span class="text-xl"><?php echo e($productEmoji); ?></span>
                                            <?php endif; ?>
                                            <h3 class="font-semibold text-gray-900 flex-1"><?php echo e($productName); ?></h3>
                                        </div>
                                        <?php if($productDescription): ?>
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3"><?php echo e($productDescription); ?></p>
                                        <?php endif; ?>
                                        <?php if($productPrice > 0): ?>
                                            <p class="font-bold text-lg text-primary-600 mb-3">Rp <?php echo e(number_format($productPrice, 0, ',', '.')); ?></p>
                                        <?php endif; ?>
                                        <div class="flex gap-2">
                                            <?php if($ctaType === 'whatsapp' && $store->whatsapp): ?>
                                                <a href="<?php echo e($whatsappLink); ?>"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="cta-btn flex-1 flex items-center justify-center gap-2 font-semibold py-3 px-4 transition-all active:scale-[0.98] <?php echo e($store->cta_button_shape === 'sharp' ? 'rounded-none' : ($store->cta_button_shape === 'pill' || $store->cta_button_shape === 'pill-hard' ? 'rounded-full' : ($store->cta_button_shape === 'sharp-hard' ? 'rounded-none' : 'rounded-lg'))); ?> <?php echo e(in_array($store->cta_button_shape, ['sharp-hard', 'rounded-hard', 'pill-hard']) ? 'btn-hard-shadow' : ''); ?> <?php echo e(in_array($store->cta_button_shape, ['square-soft', 'rounded-soft']) ? 'btn-soft-shadow' : ''); ?> <?php echo e($store->cta_button_shape === 'rainbow' ? 'btn-rainbow text-white' : ''); ?> <?php echo e($store->cta_button_shape === 'bracket' ? 'btn-bracket' : ''); ?> <?php echo e($store->cta_button_shape === 'scribble' ? 'btn-scribble' : ''); ?> <?php if($store->getTemplateSpecialClass() === 'glow-neon' || $store->getTemplateSpecialClass() === 'glow-cyberpunk'): ?> btn-glow <?php endif; ?>"
                                                   style="<?php if($store->cta_button_shape === 'sharp-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'rounded-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'pill-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'square-soft'): ?> box-shadow: 0 4px 15px rgba(0,0,0,0.2); <?php elseif($store->cta_button_shape === 'rounded-soft'): ?> box-shadow: 0 4px 15px rgba(0,0,0,0.2); <?php endif; ?> <?php echo e($store->cta_button_shadow && !in_array($store->cta_button_shape, ['sharp-hard', 'rounded-hard', 'pill-hard', 'square-soft', 'rounded-soft']) ? 'shadow-lg' : ''); ?>">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                                    </svg>
                                                    <span>Hubungi</span>
                                                </a>
                                            <?php elseif($ctaType === 'checkout'): ?>
                                                <a href="<?php echo e(route('checkout.show', ['product' => $productContent['product_id'] ?? 0])); ?>"
                                                   class="cta-btn flex-1 flex items-center justify-center gap-2 font-semibold py-3 px-4 transition-all active:scale-[0.98] <?php echo e($store->cta_button_shape === 'sharp' ? 'rounded-none' : ($store->cta_button_shape === 'pill' || $store->cta_button_shape === 'pill-hard' ? 'rounded-full' : ($store->cta_button_shape === 'sharp-hard' ? 'rounded-none' : 'rounded-lg'))); ?> <?php echo e(in_array($store->cta_button_shape, ['sharp-hard', 'rounded-hard', 'pill-hard']) ? 'btn-hard-shadow' : ''); ?> <?php echo e(in_array($store->cta_button_shape, ['square-soft', 'rounded-soft']) ? 'btn-soft-shadow' : ''); ?> <?php echo e($store->cta_button_shape === 'rainbow' ? 'btn-rainbow text-white' : ''); ?> <?php echo e($store->cta_button_shape === 'bracket' ? 'btn-bracket' : ''); ?> <?php echo e($store->cta_button_shape === 'scribble' ? 'btn-scribble' : ''); ?> <?php if($store->getTemplateSpecialClass() === 'glow-neon' || $store->getTemplateSpecialClass() === 'glow-cyberpunk'): ?> btn-glow <?php endif; ?>"
                                                   style="<?php if($store->cta_button_shape === 'sharp-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'rounded-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'pill-hard'): ?> box-shadow: 4px 4px 0px #000; <?php elseif($store->cta_button_shape === 'square-soft'): ?> box-shadow: 0 4px 15px rgba(0,0,0,0.2); <?php elseif($store->cta_button_shape === 'rounded-soft'): ?> box-shadow: 0 4px 15px rgba(0,0,0,0.2); <?php endif; ?> <?php echo e($store->cta_button_shadow && !in_array($store->cta_button_shape, ['sharp-hard', 'rounded-hard', 'pill-hard', 'square-soft', 'rounded-soft']) ? 'shadow-lg' : ''); ?>">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                    <span>Beli Sekarang</span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php break; ?>

                            <?php default: ?>
                                <div class="block-item bg-gray-100 rounded-xl p-4 border border-gray-200 text-gray-500 text-sm">
                                    Unknown block type: <?php echo e($block->type); ?>

                                </div>
                        <?php endswitch; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Belum Ada Konten</h3>
                    <p class="text-gray-500 mt-1">Toko ini belum menambahkan konten.</p>
                </div>
            <?php endif; ?>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-8 px-5 mt-auto">
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <img src="<?php echo e(asset('images/image4-removebg-preview.png')); ?>"
                         alt="Logo EtalaseKu"
                         class="h-9 w-auto object-contain">
                    <span class="font-semibold text-white">EtalaseKu</span>
                </div>
                <p class="text-sm">Buat etalase digitalmu di</p>
                <a href="<?php echo e(url('/')); ?>" class="text-primary-400 hover:text-primary-300 font-medium">etalaseku.test</a>
                <p class="text-xs mt-4 text-gray-500">© <?php echo e(date('Y')); ?> EtalaseKu. Hak cipta dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- EtalaseKu Support Floating Button -->
    <button type="button"
            onclick="openSupportModal()"
            aria-label="Laporkan kendala ke Customer Service EtalaseKu"
            class="fixed bottom-6 right-6 z-50 text-white p-4 rounded-full shadow-2xl transition-all hover:scale-110 active:scale-95"
            style="background: #fbbf24; color: #ffffff; font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a6 6 0 10-12 0v4a3 3 0 003 3h1m8-7v4a3 3 0 01-3 3h-1m-4 0h4m-2 0v2m-6-5H5a2 2 0 01-2-2v-1a2 2 0 012-2h1m12 5h1a2 2 0 002-2v-1a2 2 0 00-2-2h-1"/>
        </svg>
    </button>

    <div id="supportModal"
         class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 px-5"
         style="font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;"
         role="dialog"
         aria-modal="true"
         aria-labelledby="supportModalTitle">
        <div class="w-full max-w-sm rounded-2xl bg-white p-5 shadow-2xl">
            <div class="flex items-start gap-3">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full text-white" style="background: #fbbf24;">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a6 6 0 10-12 0v4a3 3 0 003 3h1m8-7v4a3 3 0 01-3 3h-1m-4 0h4m-2 0v2m-6-5H5a2 2 0 01-2-2v-1a2 2 0 012-2h1m12 5h1a2 2 0 002-2v-1a2 2 0 00-2-2h-1"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 id="supportModalTitle" class="text-lg font-bold text-gray-900">Customer Service EtalaseKu</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Gunakan fitur ini untuk melaporkan kendala, penyalahgunaan, atau kejadian mencurigakan pada etalase ini kepada admin EtalaseKu.
                    </p>
                </div>
            </div>
            <div class="mt-5 flex gap-3">
                <button type="button"
                        onclick="closeSupportModal()"
                        class="flex-1 rounded-xl border px-4 py-3 text-sm font-semibold transition"
                        style="border-color: #fbbf24; color: #92400e; background: #ffffff;">
                    Batal
                </button>
                <a id="supportWhatsAppLink"
                   href="#"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex-1 rounded-xl px-4 py-3 text-center text-sm font-semibold text-white transition"
                   style="background: #fbbf24; color: #ffffff;">
                    Lanjut ke WhatsApp
                </a>
            </div>
        </div>
    </div>

    <script>
        const supportModal = document.getElementById('supportModal');
        const supportWhatsAppLink = document.getElementById('supportWhatsAppLink');
        const supportPhone = '6285891565501';

        function openSupportModal() {
            const message = [
                'Halo Admin EtalaseKu, saya ingin melaporkan kendala pada etalase:',
                <?php echo json_encode($store->name, 15, 512) ?>,
                window.location.href,
            ].join('\n');

            supportWhatsAppLink.href = `https://wa.me/${supportPhone}?text=${encodeURIComponent(message)}`;
            supportModal.classList.remove('hidden');
            supportModal.classList.add('flex');
        }

        function closeSupportModal() {
            supportModal.classList.add('hidden');
            supportModal.classList.remove('flex');
        }

        supportModal.addEventListener('click', function (event) {
            if (event.target === supportModal) {
                closeSupportModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !supportModal.classList.contains('hidden')) {
                closeSupportModal();
            }
        });

        // Share functionality
        function shareStore() {
            const shareData = {
                title: '<?php echo e($store->name); ?>',
                text: 'Lihat etalase <?php echo e($store->name); ?> di EtalaseKu',
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .catch(err => console.log('Error sharing:', err));
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link berhasil disalin!');
                });
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\EtalaseKU\resources\views/public/store.blade.php ENDPATH**/ ?>