@extends('layouts.seller')

@section('title', 'Edit Produk - EtalaseKu')
@section('breadcrumb', 'Edit Produk')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('seller.products.index') }}" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Produk</h1>
                    <p class="mt-1 text-gray-600">{{ $product->name }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form method="POST" action="{{ route('seller.products.update', $product) }}" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <!-- Product Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Produk')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" :value="__('Deskripsi')" />
                    <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Price -->
                <div>
                    <x-input-label for="price" :value="__('Harga (Rp)')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)" min="0" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <!-- Product Type -->
                <div>
                    <x-input-label for="product_type" :value="__('Tipe Produk')" />
                    <select id="product_type" name="product_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="physical" {{ $product->product_type == 'physical' ? 'selected' : '' }}>Produk Fisik</option>
                        <option value="service" {{ $product->product_type == 'service' ? 'selected' : '' }}>Jasa/Layanan</option>
                        <option value="digital" {{ $product->product_type == 'digital' ? 'selected' : '' }}>Produk Digital</option>
                        <option value="custom" {{ $product->product_type == 'custom' ? 'selected' : '' }}>Custom Order</option>
                        <option value="external" {{ $product->product_type == 'external' ? 'selected' : '' }}>Link Eksternal</option>
                    </select>
                    <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                </div>

                <!-- CTA Type -->
                <div>
                    <x-input-label for="cta_type" :value="__('Aksi Tombol (CTA)')" />
                    <select id="cta_type" name="cta_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="whatsapp" {{ $product->cta_type == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="checkout" {{ $product->cta_type == 'checkout' ? 'selected' : '' }}>Checkout (Simulasi) ⭐ Pro</option>
                        <option value="download" {{ $product->cta_type == 'download' ? 'selected' : '' }}>Download</option>
                        <option value="external_link" {{ $product->cta_type == 'external_link' ? 'selected' : '' }}>Link Eksternal ⭐ Pro</option>
                    </select>
                    <x-input-error :messages="$errors->get('cta_type')" class="mt-2" />
                    @unless($store->isPro())
                        <p class="mt-2 text-xs text-amber-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Fitur Checkout dan Link Eksternal hanya tersedia untuk Plan Pro. <a href="{{ route('home') }}#pricing" class="underline font-semibold">Upgrade sekarang</a>
                        </p>
                    @endunless
                </div>

                <!-- CTA URL -->
                <div id="cta_url_container">
                    <x-input-label for="cta_url" :value="__('URL Tujuan')" />
                    <x-text-input id="cta_url" class="block mt-1 w-full" type="url" name="cta_url" :value="old('cta_url', $product->cta_url)" placeholder="https://" />
                    <x-input-error :messages="$errors->get('cta_url')" class="mt-2" />
                </div>

                <!-- Image URL -->
                <div>
                    <x-input-label for="image" :value="__('URL Gambar')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="url" name="image" :value="old('image', $product->image)" placeholder="https://" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Active Status -->
                <div class="flex items-center">
                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktifkan produk</label>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end gap-4 pt-4 border-t">
                    <a href="{{ route('seller.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-wider hover:bg-gray-50">
                        Batal
                    </a>
                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const ctaType = document.getElementById('cta_type');
    const ctaUrlContainer = document.getElementById('cta_url_container');

    function toggleCtaUrl() {
        const showUrl = ['external_link', 'download'].includes(ctaType.value);
        ctaUrlContainer.style.display = showUrl ? 'block' : 'none';
    }

    ctaType.addEventListener('change', toggleCtaUrl);
    toggleCtaUrl();
</script>
@endpush
@endsection