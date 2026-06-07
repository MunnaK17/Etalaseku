@extends('layouts.seller')

@section('title', 'Penarikan - EtalaseKu')

@section('breadcrumb', 'Wallet')
@section('breadcrumb_url', route('seller.wallet.index'))

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('seller.wallet.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Wallet
        </a>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ajukan Penarikan</h1>
            <p class="mt-1 text-gray-600">Tarik saldo ke rekening bank kamu</p>
        </div>

        <!-- Balance Info -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 font-medium">Saldo Available</p>
                    <p class="text-3xl font-bold text-green-700">Rp {{ number_format($availableBalance, 0, ',', '.') }}</p>
                </div>
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
        </div>

        <!-- Withdrawal Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            @if($availableBalance < 10000)
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                    <p class="text-yellow-800 text-sm">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Saldo minimum untuk penarikan adalah Rp 10.000.
                    </p>
                </div>
            @else
                <form method="POST" action="{{ route('seller.wallet.withdraw.store') }}">
                    @csrf

                    <!-- Amount -->
                    <div class="mb-6">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Penarikan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="number"
                                   name="amount"
                                   id="amount"
                                   min="10000"
                                   max="{{ $availableBalance }}"
                                   value="{{ old('amount') }}"
                                   class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('amount') border-red-500 @enderror"
                                   placeholder="Masukkan jumlah">
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Minimum: Rp 10.000 | Maksimum: Rp {{ number_format($availableBalance, 0, ',', '.') }}</p>
                    </div>

                    <!-- Bank Name -->
                    <div class="mb-6">
                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Bank <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="bank_name"
                               id="bank_name"
                               value="{{ old('bank_name') }}"
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('bank_name') border-red-500 @enderror"
                               placeholder="Contoh: Bank BCA">
                        @error('bank_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="mb-6">
                        <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Rekening <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="account_number"
                               id="account_number"
                               value="{{ old('account_number') }}"
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('account_number') border-red-500 @enderror"
                               placeholder="Contoh: 1234567890">
                        @error('account_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Name -->
                    <div class="mb-6">
                        <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pemilik Rekening <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="account_name"
                               id="account_name"
                               value="{{ old('account_name') }}"
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('account_name') border-red-500 @enderror"
                               placeholder="Nama sesuai di rekening">
                        @error('account_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-medium mb-1">Informasi:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Penarikan akan diproses dalam 1x24 jam kerja</li>
                                    <li>Pastikan data rekening benar untuk menghindari kesalahan transfer</li>
                                    <li>Biaya admin mungkin berlaku sesuai kebijakan bank</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">
                        Ajukan Penarikan
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection