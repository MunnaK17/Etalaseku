<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-surface-container flex items-center justify-center rounded-full border border-border-dark">
                <span class="material-symbols-outlined text-surface-raised text-3xl">mark_email_unread</span>
            </div>
            <h1 class="text-2xl font-bold text-on-surface">Verifikasi Email</h1>
            <p class="text-text-muted mt-2">Terima kasih telah mendaftar! Silakan klik link verifikasi yang telah kami kirim ke email Anda.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="p-4 bg-green-900/20 border border-green-500/30 rounded-xl text-green-400 text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-green-400">check_circle</span>
                Link verifikasi baru telah dikirim ke email yang Anda daftarkan.
            </div>
        @endif

        <div class="space-y-4">
            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button class="w-full justify-center">
                    <span class="material-symbols-outlined text-sm mr-2">refresh</span>
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-3 px-6 text-on-surface-variant font-medium rounded-full hover:bg-surface-container transition-all duration-200">
                    <span class="material-symbols-outlined text-sm mr-2 align-middle">logout</span>
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>