<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-surface-container flex items-center justify-center rounded-full border border-border-dark">
                <span class="material-symbols-outlined text-surface-raised text-3xl">lock_reset</span>
            </div>
            <h1 class="text-2xl font-bold text-on-surface">Reset Password</h1>
            <p class="text-text-muted mt-2">Buat password baru untuk akun Anda.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="nama@contoh.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password Baru')" />
                <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" class="block mt-2 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Masukkan password erneut" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <x-primary-button class="w-full justify-center">
                <span class="material-symbols-outlined text-sm mr-2">check_circle</span>
                {{ __('Reset Password') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
