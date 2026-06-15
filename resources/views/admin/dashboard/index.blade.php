@extends('layouts.admin')

@section('title', 'Admin Dashboard - EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600">Selamat datang di panel admin EtalaseKu</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total User</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_users']) }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Store</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_stores']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_products']) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_orders']) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Store Pro</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['pro_stores']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Inclusive Sellers</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['inclusive_sellers']) }}</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Applications</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['pending_applications']) }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Stores -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-900">Store Terbaru</h2>
                <a href="{{ route('admin.stores.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Lihat semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentStores as $store)
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            @if($store->logo)
                                <img src="{{ $store->logo }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <span class="font-bold text-gray-500">{{ substr($store->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-900">{{ $store->name }}</p>
                                <p class="text-xs text-gray-500">{{ $store->user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $store->is_inclusive_seller ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $store->is_inclusive_seller ? 'Inclusive' : ucfirst($store->plan) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">Belum ada store</div>
                @endforelse
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-900">Permohonan Inklusif Pending</h2>
                <a href="{{ route('admin.inclusive-applications.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Lihat semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentApplications as $application)
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $application->store->name ?? 'Toko tidak ditemukan' }}</p>
                            <p class="text-xs text-gray-500">{{ $application->disability_type }} - {{ $application->created_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('admin.inclusive-applications.show', $application->id) }}"
                           class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition">
                            Review
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">Tidak ada permohonan pending</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection