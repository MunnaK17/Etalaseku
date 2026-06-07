<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-surface-container flex items-center justify-center rounded-full border border-border-dark">
                <span class="material-symbols-outlined text-surface-raised text-3xl">shield</span>
            </div>
            <h1 class="text-2xl font-bold text-on-surface">Konfirmasi Password</h1>
            <p class="text-text-muted mt-2">Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-2 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="Masukkan password Anda" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <x-primary-button class="w-full justify-center">
                <span class="material-symbols-outlined text-sm mr-2">verified_user</span>
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>