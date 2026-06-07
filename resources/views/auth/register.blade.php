<x-guest-layout title="Daftar">
    <div class="space-y-5">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-[#e5e2e1] mb-2">Buat Akun Baru</h1>
            <p class="text-[#cfc3cc] text-base">
                Sudah punya akun? <a class="text-[#e2bae2] hover:underline font-bold transition-all" href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name (Full Width) -->
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-[#cfc3cc] block">Nama Lengkap</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                       class="w-full bg-[#1f1f1f] border-2 border-[#1e2330] text-[#e5e2e1] rounded-lg px-4 py-3 focus:outline-none transition-all placeholder-[#4c444b] input-modern"
                       placeholder="Masukkan nama lengkap" />
                @if($errors->get('name'))
                    <div class="flex items-center gap-2 text-[#ffb4ab] text-sm mt-1.5">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>{{ $errors->get('name')[0] }}</span>
                    </div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-[#cfc3cc] block">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                       class="w-full bg-[#1f1f1f] border-2 border-[#1e2330] text-[#e5e2e1] rounded-lg px-4 py-3 focus:outline-none transition-all placeholder-[#4c444b] input-modern"
                       placeholder="nama@contoh.com" />
                @if($errors->get('email'))
                    <div class="flex items-center gap-2 text-[#ffb4ab] text-sm mt-1.5">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>{{ $errors->get('email')[0] }}</span>
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-[#cfc3cc] block">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full bg-[#1f1f1f] border-2 border-[#1e2330] text-[#e5e2e1] rounded-lg px-4 py-3 focus:outline-none transition-all placeholder-[#4c444b] pr-12 input-modern"
                           placeholder="Minimal 8 karakter" />
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#988e96] hover:text-[#e5e2e1] transition-colors" tabindex="-1">
                        <span class="material-symbols-outlined text-xl" id="password-icon">visibility</span>
                    </button>
                </div>
                @if($errors->get('password'))
                    <div class="flex items-center gap-2 text-[#ffb4ab] text-sm mt-1.5">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>{{ $errors->get('password')[0] }}</span>
                    </div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="text-sm font-semibold text-[#cfc3cc] block">Konfirmasi Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full bg-[#1f1f1f] border-2 border-[#1e2330] text-[#e5e2e1] rounded-lg px-4 py-3 focus:outline-none transition-all placeholder-[#4c444b] pr-12 input-modern"
                           placeholder="Masukkan password lagi" />
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#988e96] hover:text-[#e5e2e1] transition-colors" tabindex="-1">
                        <span class="material-symbols-outlined text-xl" id="password_confirmation-icon">visibility</span>
                    </button>
                </div>
                @if($errors->get('password_confirmation'))
                    <div class="flex items-center gap-2 text-[#ffb4ab] text-sm mt-1.5">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>{{ $errors->get('password_confirmation')[0] }}</span>
                    </div>
                @endif
            </div>

            <!-- Terms -->
            <div class="flex items-center gap-3 py-2">
                <input id="terms" type="checkbox" class="checkbox-modern" required>
                <label for="terms" class="text-sm text-[#cfc3cc]">
                    Saya agree dengan <a class="text-[#e5e2e1] font-bold underline" href="#">Syarat & Ketentuan</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-modern w-full py-4 bg-[#e9c0e9] text-[#432646] font-bold text-base rounded-full hover:opacity-90 active:scale-[0.98] transition-all mt-4 relative overflow-hidden flex items-center justify-center gap-2">
                <span>Daftar Gratis</span>
                <span class="material-symbols-outlined text-xl">person_add</span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t border-[#1e2330]"></span>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-[#131313] px-4 text-[#988e96]">atau daftar dengan</span>
            </div>
        </div>

        <!-- Social Logins -->
        <div class="grid grid-cols-2 gap-4">
            <button class="flex items-center justify-center gap-2 py-3 px-4 border-2 border-[#1e2330] rounded-full hover:bg-[#2a2a2a] transition-all active:scale-[0.98]">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                </svg>
                <span class="text-sm font-semibold text-[#e5e2e1]">Google</span>
            </button>
            <button class="flex items-center justify-center gap-2 py-3 px-4 border-2 border-[#1e2330] rounded-full hover:bg-[#2a2a2a] transition-all active:scale-[0.98]">
                <svg class="w-5 h-5 fill-[#e5e2e1]" viewBox="0 0 384 512">
                    <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 21.8-88.5 21.8-11.4 0-51.1-22.2-84.6-21.8-44 1.6-84.6 24.5-106.7 66.3-45.8 83-11.5 204.7 33 273.6 22 31.7 48.2 65.1 81.3 63.8 31.9-1.3 44-20.6 82.5-20.6 38.6 0 49.3 20.6 82.5 19.8 34.3-.8 57.6-30.2 79.5-62.1 25.4-36.9 35.8-72.6 36.1-74.4-.8-.4-69.8-26.8-70.1-106.7zM249.1 82.5c16.4-19.4 27.5-46.3 24.5-73.4-23.4 1-51.8 15.6-68.6 35.2-15.1 17.5-28.3 44.9-24.8 71.3 26.2 2 52.5-13.7 68.9-33.1z"></path>
                </svg>
                <span class="text-sm font-semibold text-[#e5e2e1]">Apple</span>
            </button>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</x-guest-layout>