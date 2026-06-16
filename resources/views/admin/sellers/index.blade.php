@extends('layouts.admin')

@section('title', 'Seller Management - Admin EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Seller Management</h1>
        <p class="text-gray-600">Kelola semua seller di EtalaseKu - Hide, Suspend, Inclusive Rights, dan Subscription</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Sellers</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Hidden</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($stats['hidden']) }}</p>
                </div>
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Suspended</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ number_format($stats['suspended']) }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pro Sellers</p>
                    <p class="text-2xl font-bold text-purple-600 mt-1">{{ number_format($stats['pro']) }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Inclusive</p>
                    <p class="text-2xl font-bold text-pink-600 mt-1">{{ number_format($stats['inclusive']) }}</p>
                </div>
                <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <form method="GET" action="{{ route('admin.sellers.index') }}" class="flex gap-2">
                    <div class="relative flex-1">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama store, username, atau email..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Status Filter -->
            <div class="flex gap-1 bg-gray-100 p-1 rounded-lg">
                <a href="{{ route('admin.sellers.index', request()->except(['status'])) }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ !request('status') ? 'bg-white text-gray-900 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Semua
                </a>
                <a href="{{ route('admin.sellers.index', array_merge(request()->except(['status']), ['status' => 'hidden'])) }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request('status') === 'hidden' ? 'bg-white text-amber-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Hidden
                </a>
                <a href="{{ route('admin.sellers.index', array_merge(request()->except(['status']), ['status' => 'suspended'])) }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request('status') === 'suspended' ? 'bg-white text-red-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Suspended
                </a>
                <a href="{{ route('admin.sellers.index', array_merge(request()->except(['status']), ['status' => 'pro'])) }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request('status') === 'pro' ? 'bg-white text-purple-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Pro
                </a>
                <a href="{{ route('admin.sellers.index', array_merge(request()->except(['status']), ['status' => 'inclusive'])) }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request('status') === 'inclusive' ? 'bg-white text-pink-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Inclusive
                </a>
            </div>
        </div>
    </div>

    <!-- Sellers Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Store</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bergabung</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($sellers as $seller)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($seller->logo)
                                        <img src="{{ $seller->logo }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                                            <span class="font-bold text-white">{{ substr($seller->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-gray-900 flex items-center gap-2">
                                            {{ $seller->name }}
                                            @if($seller->is_hidden)
                                                <span class="inline-flex px-1.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700" title="Hidden">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                    </svg>
                                                </span>
                                            @endif
                                            @if($seller->is_suspended)
                                                <span class="inline-flex px-1.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700" title="Suspended">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                    </svg>
                                                </span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">/{{ $seller->username }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $seller->user->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $seller->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @if($seller->is_inclusive_seller)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-pink-100 text-pink-800">
                                            Inclusive
                                        </span>
                                    @endif
                                    @if($seller->is_verified_seller)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            Verified
                                        </span>
                                    @endif
                                    @if(!$seller->is_active)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            Inactive
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $seller->plan === 'pro' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($seller->plan) }}
                                </span>
                                @if($seller->plan_expires_at)
                                    <p class="text-xs text-gray-500 mt-1">
                                        Exp: {{ $seller->plan_expires_at->format('d M Y') }}
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $seller->products()->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $seller->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.sellers.show', $seller->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                    Kelola
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p>Tidak ada seller ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sellers->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $sellers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection