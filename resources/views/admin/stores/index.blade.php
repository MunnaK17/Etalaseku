@extends('layouts.admin')

@section('title', 'Stores - Admin EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Header -->
    <div class="mb-8">
<h1 class="text-3xl font-bold text-gray-900">Stores</h1>
        <p class="text-gray-600">Kelola semua store di EtalaseKu</p>
    </div>

    <!-- Stores Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Store</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($stores as $store)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
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
                                        <p class="text-xs text-gray-500">/{{ $store->username }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $store->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $store->user->email }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($store->is_inclusive_seller)
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-pink-100 text-pink-800">
                                        Inclusive
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $store->plan === 'pro' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($store->plan) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $store->products()->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $store->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.stores.show', $store->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada store</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($stores->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $stores->links() }}
            </div>
        @endif
    </div>
</div>
@endsection