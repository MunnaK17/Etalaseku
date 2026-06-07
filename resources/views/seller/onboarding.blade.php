@extends('layouts.guest')

@section('title', 'Setup Etalase - EtalaseKu')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Buat Etalase Kamu</h1>
    <p class="mt-2 text-gray-600">Langkah pertama untuk mulai berjualan secara online</p>
</div>

<form method="POST" action="{{ route('seller.onboarding.store') }}">
    @csrf

    <div class="space-y-6">
        <!-- Store Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Etalase')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" placeholder="Contoh: Toko Sembako Makmur" aria-describedby="name-hint" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <p id="name-hint" class="mt-1 text-xs text-gray-500">Nama etalase yang akan ditampilkan di halaman publik</p>
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    etalaseku.test/
                </span>
                <x-text-input id="username" class="block w-full rounded-none rounded-r-md" type="text" name="username" :value="old('username')" required autocomplete="off" placeholder="tokosembako" spellcheck="false" />
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan tanda strip (-). Contoh: tokosembako-makmur</p>
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Deskripsi singkat tentang etalase kamu">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- WhatsApp -->
        <div>
            <x-input-label for="whatsapp" :value="__('Nomor WhatsApp (Opsional)')" />
            <x-text-input id="whatsapp" class="block mt-1 w-full" type="tel" name="whatsapp" :value="old('whatsapp')" autocomplete="tel" placeholder="081234567890" />
            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-500">Nomor WhatsApp untuk kontak customer (opsional)</p>
        </div>
    </div>

    <div class="mt-8">
        <x-primary-button class="w-full justify-center py-3">
            {{ __('Buat Etalase Sekarang') }}
        </x-primary-button>
    </div>
</form>

<div class="mt-6 text-center">
    <p class="text-sm text-gray-600">
        Dengan membuat etalase, kamu menyetujui
        <a href="#" class="text-indigo-600 hover:underline">Syarat & Ketentuan</a>
        kami.
    </p>
</div>
@endsection