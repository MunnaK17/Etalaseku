<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan - EtalaseKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Figtree', 'sans-serif'] },
                },
            },
        }
    </script>
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-4">
        <!-- 404 Icon -->
        <div class="mb-6">
            <svg class="w-32 h-32 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <!-- Error Code -->
        <div class="text-8xl font-bold text-gray-800 mb-2">404</div>

        <!-- Error Title -->
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Halaman Tidak Ditemukan</h1>

        <!-- Error Message -->
        <p class="text-gray-500 mb-8">
            Maaf, halaman yang Anda cari tidak dapat ditemukan.
            Halaman mungkin telah dipindahkan atau dihapus.
        </p>

        <!-- Actions -->
        <div class="space-y-4">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Debug Info (only in local) -->
        @if(app()->environment('local') && isset($exception))
        <div class="mt-8 p-4 bg-gray-100 rounded-lg text-left">
            <p class="text-xs text-gray-500 font-mono break-all">
                <strong>Exception:</strong> {{ $exception->getMessage() }}
            </p>
        </div>
        @endif
    </div>
</body>
</html>
