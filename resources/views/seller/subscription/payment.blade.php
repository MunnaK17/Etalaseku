@extends('layouts.seller')

@section('title', 'Pembayaran Pro - EtalaseKu')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Pembayaran Plan Pro</h1>
            <p class="mt-2 text-gray-600">Selesaikan pembayaran untuk mengaktifkan fitur Pro</p>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>

            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Plan</span>
                    <span class="font-semibold text-gray-900">{{ App\Models\Subscription::getPlanName($subscription->plan) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Periode</span>
                    <span class="font-semibold text-gray-900">{{ $subscription->plan === 'yearly' ? '1 Tahun' : '1 Bulan' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Order ID</span>
                    <span class="font-mono text-sm text-gray-500">{{ $subscription->midtrans_order_id }}</span>
                </div>
                <div class="border-t pt-4 flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total</span>
                    <span class="text-2xl font-bold text-purple-600">Rp {{ number_format($subscription->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        @if($subscription->payment_status === 'paid')
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-green-900">Pembayaran Berhasil!</h3>
                        <p class="text-sm text-green-700">Fitur Pro sudah aktif di tokomu.</p>
                    </div>
                </div>
            </div>
        @elseif($subscription->payment_status === 'pending')
            <!-- Midtrans Snap Button -->
            @if($snapToken)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Metode Pembayaran</h2>
                    <p class="text-sm text-gray-500 mb-4">Klik tombol di bawah untuk memilih metode pembayaran</p>
                    <button id="pay-button" class="w-full py-4 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Bayar Sekarang
                    </button>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-yellow-900">Menunggu Pembayaran</h3>
                            <p class="text-sm text-yellow-700">Selesaikan pembayaran untuk mengaktifkan fitur Pro.</p>
                        </div>
                    </div>
                </div>
            @endif
 @else
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-red-900">Pembayaran Gagal</h3>
                        <p class="text-sm text-red-700">Silakan coba lagi.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('seller.upgrade') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                ← Kembali ke Halaman Upgrade
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($snapToken && $subscription->payment_status === 'pending')
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = '{{ route('seller.subscription.finish', $subscription->midtrans_order_id) }}';
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route('seller.subscription.finish', $subscription->midtrans_order_id) }}';
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal. Silakan coba lagi.');
 },
                    onClose: function() {
                        // User closed the payment popup
                    }
                });
            });
        }
    </script>
@endif
@endpush
