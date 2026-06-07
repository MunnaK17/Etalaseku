<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-surface-container flex items-center justify-center rounded-full border border-border-dark">
                <span class="material-symbols-outlined text-surface-raised text-3xl">key</span>
            </div>
            <h1 class="text-2xl font-bold text-on-surface">Lupa Password?</h1>
            <p class="text-text-muted mt-2">Tidak masalah. Masukkan email Anda dan kami akan mengirim link untuk reset password.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@contoh.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <x-primary-button class="w-full justify-center">
                <span class="material-symbols-outlined text-sm mr-2">mail</span>
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </form>

        <!-- Back to Login -->
        <p class="text-center text-on-surface-variant text-sm">
            Ingat password Anda?
            <a href="{{ route('login') }}" class="text-surface-raised font-semibold hover:opacity-80 transition-opacity">
                Masuk di sini
            </a>
        </p>
    </div>
</x-guest-layout>
