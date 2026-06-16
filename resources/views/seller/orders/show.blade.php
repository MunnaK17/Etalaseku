@extends('layouts.seller')

@section('title', 'Detail Pesanan - EtalaseKu')
@section('breadcrumb', 'Detail Pesanan')

@section('content')
<div class="py-6 lg:py-8">
    <div class="mx-auto max-w-5xl">
        <!-- Back Button -->
        <a href="{{ route('seller.orders.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium" style="color: var(--dashboard-text-muted);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Pesanan
        </a>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0">
                    <h1 class="text-2xl font-bold sm:text-3xl" style="color: var(--dashboard-text);">Detail Pesanan</h1>
                    <p class="mt-1 break-words text-sm" style="color: var(--dashboard-text-muted);">{{ $order->order_number }}</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $order->payment_status_badge_class }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $order->order_status_badge_class }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-5">
            <div class="space-y-6 lg:col-span-3">
                <!-- Order Details -->
                <div class="overflow-hidden rounded-xl border" style="background-color: var(--dashboard-card-bg); border-color: var(--dashboard-card-border);">
                    <div class="border-b px-5 py-4 sm:px-6" style="border-color: var(--dashboard-card-border);">
                        <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Informasi Pesanan</h2>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Nomor Pesanan</p>
                                <p class="mt-1 break-words font-semibold" style="color: var(--dashboard-text);">{{ $order->order_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Tanggal Pesanan</p>
                                <p class="mt-1 font-semibold" style="color: var(--dashboard-text);">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Total Pembayaran</p>
                                <p class="mt-1 text-2xl font-bold" style="color: var(--accent);">{{ $order->formatted_amount }}</p>
                            </div>
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Toko</p>
                                <p class="mt-1 font-semibold" style="color: var(--dashboard-text);">{{ $order->store->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer -->
                <div class="overflow-hidden rounded-xl border" style="background-color: var(--dashboard-card-bg); border-color: var(--dashboard-card-border);">
                    <div class="border-b px-5 py-4 sm:px-6" style="border-color: var(--dashboard-card-border);">
                        <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Data Pelanggan</h2>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Nama</p>
                                <p class="mt-1 break-words font-semibold" style="color: var(--dashboard-text);">{{ $order->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Email</p>
                                <p class="mt-1 break-words font-semibold" style="color: var(--dashboard-text);">{{ $order->customer_email }}</p>
                            </div>
                            @if($order->customer_phone)
                                <div>
                                    <p class="text-sm" style="color: var(--dashboard-text-muted);">WhatsApp</p>
                                    <p class="mt-1 font-semibold" style="color: var(--dashboard-text);">{{ $order->customer_phone }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border" style="background-color: var(--dashboard-card-bg); border-color: var(--dashboard-card-border);">
                    <div class="border-b px-5 py-4 sm:px-6" style="border-color: var(--dashboard-card-border);">
                        <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Produk</h2>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            @if($order->product && $order->product->image)
                                <img src="{{ $order->product->image }}" alt="" class="h-28 w-28 rounded-xl object-cover">
                            @else
                                <div class="flex h-28 w-28 shrink-0 items-center justify-center rounded-xl" style="background-color: var(--dashboard-input-bg);">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--dashboard-text-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="break-words text-lg font-semibold" style="color: var(--dashboard-text);">{{ $order->product->name ?? 'Produk telah dihapus' }}</p>
                                <p class="mt-2 text-xl font-bold" style="color: var(--accent);">{{ $order->formatted_amount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
