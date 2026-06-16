<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Atur Password Google') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Buat password untuk akun Google Anda agar bisa login tanpa menggunakan Google.
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div class="flex items-center gap-4 rounded-lg border border-green-200 bg-green-50 p-4">
            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-green-800">
                    Akun Anda terdaftar menggunakan Google OAuth
                </p>
                <p class="text-xs text-green-600">
                    Login dengan Google aktif. Buat password untuk login manual.
                </p>
            </div>
        </div>

        @if (session('status') === 'google-password-set')
            <div class="rounded-lg border border-green-200 bg-green-50 p-4">
                <p class="text-sm font-medium text-green-800">
                    ✓ Password berhasil dibuat!
                </p>
                <p class="text-xs text-green-600">
                    Sekarang Anda bisa login menggunakan email dan password.
                </p>
            </div>
        @endif

        <a href="{{ route('google.set-password.form') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-yellow-500 px-4 py-2 text-sm font-semibold text-black transition hover:bg-yellow-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500 focus-visible:ring-offset-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
            {{ __('Atur Password') }}
        </a>
    </div>
</section>
