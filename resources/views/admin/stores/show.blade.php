@extends('layouts.admin')

@section('title', 'Store Detail - Admin EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Back Button -->
    <a href="{{ route('admin.stores.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <!-- Store Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex items-center gap-4">
            @if($store->logo)
                <img src="{{ $store->logo }}" alt="" class="w-16 h-16 rounded-xl object-cover">
            @else
                <div class="w-16 h-16 rounded-xl bg-indigo-100 flex items-center justify-center">
                    <span class="text-2xl font-bold text-indigo-600">{{ substr($store->name, 0, 1) }}</span>
                </div>
            @endif
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $store->name }}</h1>
                <p class="text-gray-500">/{{ $store->username }}</p>
            </div>
            <div class="flex gap-2">
                @if($store->is_inclusive_seller)
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-pink-100 text-pink-800">
                        Inclusive Seller
                    </span>
                @else
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $store->plan === 'pro' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($store->plan) }}
                    </span>
                @endif
                <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $store->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $store->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Pengunjung</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_views']) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Klik Produk</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['product_clicks']) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Produk</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_products']) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Pesanan</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_orders']) }}</p>
        </div>
    </div>

    <!-- Store Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Owner Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemilik</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-900">{{ $store->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $store->user->email }}</p>
                </div>
               <div>
                    <p class="text-sm text-gray-500">WhatsApp</p>
                    <p class="font-medium text-gray-900">{{ $store->whatsapp ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Bergabung</p>
                    <p class="font-medium text-gray-900">{{ $store->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Store Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Store</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Deskripsi</p>
                    <p class="font-medium text-gray-900">{{ $store->description ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tema</p>
                    <p class="font-medium text-gray-900">{{ ucfirst($store->theme) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Plan Expires</p>
                    <p class="font-medium text-gray-900">{{ $store->plan_expires_at ? $store->plan_expires_at->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Link Publik</p>
                    <a href="{{ $store->public_url }}" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-800">
                        {{ $store->public_url }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-8">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Produk ({{ $store->products()->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($store->products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-500">{{ ucfirst($product->product_type) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900">{{ $product->formatted_price ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Tidak ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection