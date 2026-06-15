@extends('layouts.seller')

@section('title', 'Pesanan - EtalaseKu')
@section('breadcrumb', 'Pesanan')

@section('content')
<div class="py-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold" style="color: var(--dashboard-text);">Pesanan</h1>
        <p class="mt-1 text-sm" style="color: var(--dashboard-text-muted);">Kelola pesanan dari pelanggan</p>
    </div>

    <!-- Orders Table -->
    <div class="rounded-xl overflow-hidden" style="background-color: var(--dashboard-card-bg); border: 1px solid var(--dashboard-card-border);">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y" style="border-color: var(--dashboard-card-border);">
                <thead style="background-color: var(--dashboard-table-header);">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Pesanan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Produk</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Pelanggan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Total</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--dashboard-text-muted);">Tanggal</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody style="background-color: var(--dashboard-card-bg);">
                    @forelse($orders as $order)
                        <tr class="transition" style="border-color: var(--dashboard-card-border);">
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="font-semibold text-sm" style="color: var(--dashboard-text);">{{ $order->order_number }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if($order->product && $order->product->image)
                                        <img src="{{ $order->product->image }}" alt="" class="w-9 h-9 rounded-lg object-cover">
                                    @else
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background-color: var(--dashboard-input-bg);">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--dashboard-text-muted);">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-sm" style="color: var(--dashboard-text);">{{ $order->product->name ?? 'Produk dihapus' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="text-sm" style="color: var(--dashboard-text);">{{ $order->customer_name }}</div>
                                <div class="text-xs" style="color: var(--dashboard-text-muted);">{{ $order->customer_email }}</div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--dashboard-text);">
                                {{ $order->formatted_amount }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $order->payment_status_badge_class }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $order->order_status_badge_class }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm" style="color: var(--dashboard-text-muted);">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('seller.orders.show', $order->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg transition"
                                   style="color: var(--accent); border: 1px solid var(--accent);">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color: var(--dashboard-input-bg);">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--dashboard-text-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <p class="text-sm" style="color: var(--dashboard-text-muted);">Belum ada pesanan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="px-5 py-4 border-t" style="border-color: var(--dashboard-card-border);">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
