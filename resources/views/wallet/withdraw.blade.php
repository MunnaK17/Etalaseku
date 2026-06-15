@extends('layouts.seller')

@section('title', 'Penarikan - EtalaseKu')
@section('breadcrumb', 'Wallet')
@section('breadcrumb_url', route('seller.wallet.index'))

@push('head')
<style>
    /* Withdraw Page - Dark Theme */
    .withdraw-container {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Back Button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a1a1aa;
        margin-bottom: 24px;
        transition: color 0.2s;
    }
    .back-btn:hover {
        color: #fbbf24;
    }
    .back-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Header */
    .withdraw-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #fafafa;
        margin-bottom: 4px;
    }
    .withdraw-header p {
        font-size: 14px;
        color: #a1a1aa;
    }

    /* Balance Info Card */
    .balance-info-card {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.1));
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .balance-info-text {
        font-size: 14px;
        font-weight: 500;
        color: #10b981;
        margin-bottom: 4px;
    }
    .balance-info-amount {
        font-size: 32px;
        font-weight: 700;
        color: #10b981;
    }
    .balance-info-icon {
        width: 48px;
        height: 48px;
        color: #10b981;
        opacity: 0.6;
    }

    /* Form Card */
    .form-card {
        background: #18181b;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #3f3f46;
    }

    /* Warning Alert */
    .form-warning {
        background: rgba(251, 191, 36, 0.1);
        border: 1px solid rgba(251, 191, 36, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .form-warning svg {
        width: 20px;
        height: 20px;
        color: #fbbf24;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .form-warning p {
        font-size: 14px;
        color: #fbbf24;
    }
    .form-warning a {
        color: #fbbf24;
        font-weight: 700;
        text-decoration: underline;
    }
    .form-error-alert {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #ef4444;
        font-size: 14px;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #d4d4d8;
        margin-bottom: 8px;
    }
    .form-label .required {
        color: #ef4444;
    }
    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid #3f3f46;
        border-radius: 12px;
        font-size: 14px;
        background: #27272a;
        color: #fafafa;
        transition: all 0.2s;
    }
    .form-input:focus {
        border-color: #fbbf24;
        outline: none;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }
    .form-input::placeholder {
        color: #71717a;
    }
    .form-input[readonly] {
        background: #1f1f23;
        color: #d4d4d8;
        cursor: default;
    }
    .form-input.error {
        border-color: #ef4444;
    }
    .form-error {
        font-size: 13px;
        color: #ef4444;
        margin-top: 6px;
    }
    .form-hint {
        font-size: 13px;
        color: #71717a;
        margin-top: 6px;
    }

    /* Amount Input with Prefix */
    .amount-input-wrapper {
        position: relative;
    }
    .amount-prefix {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #71717a;
        font-size: 14px;
        pointer-events: none;
    }
    .amount-input {
        padding-left: 40px !important;
    }

    /* Info Box */
    .info-box {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    .info-box-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }
    .info-box-header svg {
        width: 18px;
        height: 18px;
        color: #3b82f6;
    }
    .info-box-header span {
        font-size: 14px;
        font-weight: 600;
        color: #3b82f6;
    }
    .info-box-list {
        font-size: 13px;
        color: #a1a1aa;
        line-height: 1.6;
        padding-left: 26px;
    }
    .info-box-list li {
        margin-bottom: 2px;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: black;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .submit-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
</style>
@endpush

@section('content')
<div class="py-6">
    <div class="withdraw-container">
        <!-- Back Button -->
        <a href="{{ route('seller.wallet.index') }}" class="back-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Wallet
        </a>

        <!-- Header -->
        <div class="withdraw-header mb-8">
            <h1>Ajukan Penarikan</h1>
            <p>Tarik saldo ke rekening bank kamu</p>
        </div>

        <!-- Balance Info -->
        <div class="balance-info-card">
            <div>
                <p class="balance-info-text">Saldo Available</p>
                <p class="balance-info-amount">Rp {{ number_format($availableBalance, 0, ',', '.') }}</p>
            </div>
            <svg class="balance-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
        </div>

        <!-- Withdrawal Form -->
        <div class="form-card">
            @if(session('error'))
                <div class="form-error-alert">
                    {{ session('error') }}
                </div>
            @endif

            @if($availableBalance < 10000)
                <div class="form-warning">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p>Saldo minimum untuk penarikan adalah Rp 10.000.</p>
                </div>
            @else
                @php
                    $hasPayoutSettings = filled($store->payout_bank_name)
                        && filled($store->payout_account_number)
                        && filled($store->payout_account_name);
                @endphp

                @unless($hasPayoutSettings)
                    <div class="form-warning">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <p>
                            Lengkapi rekening payout di
                            <a href="{{ route('seller.store.edit') }}">Pengaturan</a>
                            sebelum mengajukan penarikan.
                        </p>
                    </div>
                @endunless

                <form method="POST" action="{{ route('seller.wallet.withdraw.store') }}">
                    @csrf

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount" class="form-label">
                            Jumlah Penarikan <span class="required">*</span>
                        </label>
                        <div class="amount-input-wrapper">
                            <span class="amount-prefix">Rp</span>
                            <input type="number"
                                   name="amount"
                                   id="amount"
                                   min="10000"
                                   max="{{ $availableBalance }}"
                                   value="{{ old('amount') }}"
                                   class="form-input amount-input @error('amount') error @enderror"
                                   placeholder="Masukkan jumlah">
                        </div>
                        @error('amount')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Minimum: Rp 10.000 | Maksimum: Rp {{ number_format($availableBalance, 0, ',', '.') }}</p>
                    </div>

                    <!-- Bank Name -->
                    <div class="form-group">
                        <label for="bank_name" class="form-label">
                            Nama Bank
                        </label>
                        <input type="text"
                               id="bank_name"
                               value="{{ $store->payout_bank_name ?: '-' }}"
                               class="form-input"
                               readonly>
                        <p class="form-hint">Diambil dari Payout Settings.</p>
                    </div>

                    <!-- Account Number -->
                    <div class="form-group">
                        <label for="account_number" class="form-label">
                            Nomor Rekening
                        </label>
                        <input type="text"
                               id="account_number"
                               value="{{ $store->payout_account_number ?: '-' }}"
                               class="form-input"
                               readonly>
                    </div>

                    <!-- Account Name -->
                    <div class="form-group">
                        <label for="account_name" class="form-label">
                            Nama Pemilik Rekening
                        </label>
                        <input type="text"
                               id="account_name"
                               value="{{ $store->payout_account_name ?: '-' }}"
                               class="form-input"
                               readonly>
                    </div>

                    <!-- Info Box -->
                    <div class="info-box">
                        <div class="info-box-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Informasi:</span>
                        </div>
                        <ul class="info-box-list">
                            <li>Penarikan akan diproses dalam 1x24 jam kerja</li>
                            <li>Pastikan data rekening benar untuk menghindari kesalahan transfer</li>
                            <li>Biaya admin mungkin berlaku sesuai kebijakan bank</li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn" @disabled(!$hasPayoutSettings)>
                        Ajukan Penarikan
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
