@extends('layouts.admin')

@section('title', 'Pesanan Checkout - Admin Panel')

@section('content')
<div class="py-6">
    <div class="max-w-[1600px] mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pesanan Checkout</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola pembayaran checkout dari pelanggan</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="w-48">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Cari Toko</label>
                    <input type="text" name="store" value="{{ request('store') }}" placeholder="Nama toko..."
                           class="w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-900 text-sm">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Orders Table with Horizontal Scroll -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-[1200px] w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Order</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Toko / Seller</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="font-mono text-sm font-medium text-gray-900">{{ $order->order_number }}</p>
                                    <p class="text-xs text-gray-500">
                                        <span class="{{ $order->store->isPro() ? 'text-purple-600' : 'text-gray-500' }}">
                                            {{ $order->store->isPro() ? 'Pro (3%)' : 'Free (5%)' }}
                                        </span>
                                    </p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm font-medium text-gray-900">{{ $order->store->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ '@' . ($order->store->username ?? 'N/A') }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        @if($order->product && $order->product->image)
                                            <img src="{{ $order->product->image }}" alt="" class="h-8 w-8 rounded object-cover mr-2 flex-shrink-0">
                                        @else
                                            <div class="h-8 w-8 rounded bg-gray-200 flex items-center justify-center mr-2 flex-shrink-0">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate max-w-[150px]">{{ $order->product->name ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">Rp {{ number_format($order->product->price ?? 0, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-gray-500 truncate max-w-[150px]">{{ $order->customer_email }}</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm font-bold text-gray-900">{{ $order->formatted_amount }}</p>
                                    <p class="text-xs">
                                        <span class="text-gray-500">Net:</span>
                                        <span class="text-green-600 font-medium">
                                            Rp {{ number_format(($order->product->price ?? 0) * ($order->store->isPro() ? 0.97 : 0.95), 0, ',', '.') }}
                                        </span>
                                    </p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            'pending' => [
                                                'class' => 'bg-yellow-100 text-yellow-700',
                                                'icon' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                                'label' => 'Menunggu'
                                            ],
                                            'paid' => [
                                                'class' => 'bg-green-100 text-green-700',
                                                'icon' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                                                'label' => 'Lunas'
                                            ],
                                            'failed' => [
                                                'class' => 'bg-red-100 text-red-700',
                                                'icon' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
                                                'label' => 'Gagal'
                                            ],
                                        ];
                                        $config = $statusConfig[$order->payment_status] ?? ['class' => 'bg-gray-100 text-gray-700', 'icon' => '', 'label' => ucfirst($order->payment_status)];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}" title="{{ $config['label'] }}">
                                        {!! $config['icon'] !!}{{ $config['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($order->payment_status === 'pending')
                                        <div class="flex items-center gap-1">
                                            <form method="POST" action="{{ route('admin.orders.approve', $order) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Setuju
                                                </button>
                                            </form>

                                            <button type="button"
                                                    onclick="openRejectModal({{ $order->id }})"
                                                    class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Belum ada order checkout</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection

<!-- Reject Modal -->
<div id="tolakModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
     role="dialog"
     aria-modal="true"
     aria-labelledby="tolakModalTitle"
     aria-describedby="tolakModalDesc">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4" role="document">
        <h3 id="tolakModalTitle" class="text-lg font-semibold text-gray-900 mb-4">Tolak Order</h3>
        <p id="tolakModalDesc" class="sr-only">Form untuk menolak order checkout dan menambahkan alasan penolakan</p>
        <form id="tolakForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                    Alasan Penolakan (opsional)
                </label>
                <textarea name="note"
                          id="note"
                          rows="3"
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Contoh: Pembayaran tidak valid"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const tolakModal = document.getElementById('tolakModal');
    const tolakForm = document.getElementById('tolakForm');
    const firstFocusable = tolakForm.querySelector('textarea');
    const closeButtons = tolakForm.querySelectorAll('button');

    function openRejectModal(orderId) {
        tolakForm.action = '{{ route('admin.orders.reject', ':id') }}'.replace(':id', orderId);
        tolakModal.classList.remove('hidden');
        tolakModal.classList.add('flex');
        // Focus trap - move focus to textarea
        firstFocusable.focus();
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        tolakModal.classList.add('hidden');
        tolakModal.classList.remove('flex');
        // Restore body scroll
        document.body.style.overflow = '';
    }

    // Focus trap for modal
    tolakModal.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRejectModal();
            return;
        }
        if (e.key !== 'Tab') return;

        const focusable = tolakForm.querySelectorAll('button, textarea, input, select');
        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
    });

    tolakModal.addEventListener('click', function(e) {
        if (e.target === tolakModal) {
            closeRejectModal();
        }
    });
</script>