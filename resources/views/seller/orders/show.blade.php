@extends('layouts.seller')

@section('title', 'Detail Pesanan - EtalaseKu')
@section('breadcrumb', 'Detail Pesanan')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('seller.orders.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Pesanan
        </a>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                    <p class="mt-1 text-gray-600">{{ $order->order_number }}</p>
                </div>
                <div class="flex gap-2">
<span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $order->payment_status_badge_class }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $order->order_status_badge_class }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Informasi Pesanan</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Pesanan</p>
                        <p class="font-medium text-gray-900">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pesanan</p>
                        <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                        <p class="font-bold text-xl text-primary-600">{{ $order->formatted_amount }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Toko</p>
                        <p class="font-medium text-gray-900">{{ $order->store->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Produk</h2>
            </div>
            <div class="p-6">
                <div class="flex gap-4">
                    @if($order->product && $order->product->image)
                        <img src="{{ $order->product->image }}" alt="" class="w-20 h-20 rounded-xl object-cover">
                    @else
                        <div class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="font-semibold text-gray-900">{{ $order->product->name ?? 'Produk telah dihapus' }}</p>
                        <p class="text-primary-600 font-bold mt-1">{{ $order->formatted_amount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Data Pelanggan</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_email }}</p>
                    </div>
                    @if($order->customer_phone)
                        <div>
                            <p class="text-sm text-gray-500">WhatsApp</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Update Status</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('seller.orders.update-status', $order->id) }}" method="POST" class="flex flex-wrap gap-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pembayaran</label>
                        <select name="payment_status" class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesanan</label>
                        <select name="order_status" class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="new" {{ $order->order_status === 'new' ? 'selected' : '' }}>Baru</option>
                            <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                            Update
                        </button>
                    </div>
                </form>

                @if(session('success'))
                    <p class="mt-3 text-sm text-green-600">{{ session('success') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
