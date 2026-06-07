<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EtalaseKU') }} - {{ $title ?? 'Auth' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined:wght,FILL@0..1,wght@0..1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #131313;
            color: #e5e2e1;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Focus Indicators */
        *:focus-visible {
            outline: 2px solid #e9c0e9;
            outline-offset: 2px;
            border-radius: 8px;
        }

        /* Input styling */
        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #1f1f1f !important;
        }

        .input-modern:focus {
            border-color: #e9c0e9 !important;
            box-shadow: 0 0 0 4px rgba(233, 192, 233, 0.1) !important;
        }

        /* Button hover effect */
        .btn-modern {
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        /* Checkbox styling */
        .checkbox-modern {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #4c444b;
            border-radius: 5px;
            background: #1f1f1f;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .checkbox-modern:checked {
            background: #5b3c5e;
            border-color: #5b3c5e;
        }

        .checkbox-modern:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: solid #e2bae2;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Password visibility toggle */
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #988e96;
            transition: color 0.2s ease;
            padding: 4px;
            background: none;
            border: none;
        }

        .password-toggle:hover {
            color: #e9c0e9;
        }

        /* Hero gradient */
        .hero-gradient {
            background: linear-gradient(180deg, rgba(19,19,19,0.3) 0%, rgba(19,19,19,0.85) 100%);
        }

        /* Parallax effect */
        .parallax-bg {
            transition: transform 0.1s ease-out;
        }

        /* Animations */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out forwards;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-container {
                flex-direction: column !important;
            }

            .auth-image-panel {
                display: none !important;
            }

            .auth-form-panel {
                width: 100% !important;
                min-height: 100vh !important;
            }
        }
    </style>
</head>
<body class="selection:bg-[#e9c0e9] selection:text-[#432646] min-h-screen flex items-center justify-center p-4 md:p-10">
    <!-- Header -->
    <header class="absolute top-0 left-0 w-full flex justify-between items-center px-6 md:px-10 py-5 z-50">
        <a href="{{ url('/') }}" class="text-xl font-bold text-[#e5e2e1]">EtalaseKU</a>
        <a class="group flex items-center gap-2 bg-[#2a2a2a]/40 hover:bg-[#2a2a2a] py-2 px-5 rounded-full text-sm font-semibold text-[#e5e2e1] transition-all duration-300" href="{{ url('/') }}">
            Kembali ke website
            <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
    </header>

    <!-- Main Auth Container -->
    <main class="w-full max-w-[1200px] aspect-video min-h-[700px] flex flex-col md:flex-row overflow-hidden rounded-2xl shadow-2xl bg-[#0e0e0e]">
        <!-- Left Side: Atmospheric Hero -->
        <section class="relative w-full md:w-1/2 min-h-[400px] md:min-h-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center parallax-bg" data-alt="hero-bg"
                 style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=80'); transform: scale(1.1);">
            </div>
            <div class="absolute inset-0 hero-gradient"></div>

            <!-- Hero Content -->
            <div class="absolute bottom-0 left-0 p-6 md:p-10 z-10 max-w-md">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                    Capturing Moments,<br>Creating Memories
                </h2>
                <!-- Carousel Indicators -->
                <div class="flex gap-2">
                    <div class="h-1 w-8 rounded-full bg-[#353535]/50"></div>
                    <div class="h-1 w-8 rounded-full bg-[#353535]/50"></div>
                    <div class="h-1 w-12 rounded-full bg-[#e9c0e9]"></div>
                </div>
            </div>
        </section>

        <!-- Right Side: Auth Form -->
        <section class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-10 bg-[#131313]">
            <div class="w-full max-w-md animate-fade-in-up">
                {{-- Yield content for views using @section --}}
                @yield('content')

                {{-- Slot for views using Blade components --}}
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="absolute bottom-0 right-0 w-full md:w-1/2 flex justify-center items-center gap-6 py-6 z-50">
        <div class="text-sm font-bold text-[#e5e2e1] hidden md:block">EtalaseKU</div>
        <div class="flex gap-4">
            <a class="text-sm font-semibold text-[#988e96] hover:text-[#e5e2e1] transition-colors duration-200 hover:underline" href="#">Syarat Layanan</a>
            <a class="text-sm font-semibold text-[#988e96] hover:text-[#e5e2e1] transition-colors duration-200 hover:underline" href="#">Kebijakan Privasi</a>
            <a class="text-sm font-semibold text-[#988e96] hover:text-[#e5e2e1] transition-colors duration-200 hover:underline" href="#">Pusat Bantuan</a>
        </div>
    </footer>

    <script>
        // Atmospheric micro-interaction: Subtle parallax on the background image
        document.addEventListener('mousemove', (e) => {
            const heroImage = document.querySelector('[data-alt="hero-bg"]');
            if (!heroImage) return;

            const x = (e.clientX - window.innerWidth / 2) / 100;
            const y = (e.clientY - window.innerHeight / 2) / 100;

            heroImage.style.transform = `scale(1.1) translate(${x}px, ${y}px)`;
        });
    </script>
</body>
</html>