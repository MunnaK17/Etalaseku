@extends('layouts.seller')

@section('title', 'Pengaturan Etalase - EtalaseKu')
@section('breadcrumb', 'Pengaturan')

@push('head')
<style>
    /* Settings Page - Theme Compatible */
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header */
    .settings-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .settings-header p {
        margin-top: 4px;
        font-size: 14px;
        color: var(--text-muted);
    }

    /* Lynkid Bar */
    .lynkid-bar {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .lynkid-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .lynkid-label {
        font-size: 14px;
        color: var(--text-muted);
    }
    .lynkid-url {
        font-size: 14px;
        font-weight: 600;
        color: var(--accent);
        font-family: 'JetBrains Mono', monospace;
    }
    .lynkid-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .lynkid-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .lynkid-btn svg {
        width: 14px;
        height: 14px;
    }
    .lynkid-btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #000;
    }
    .lynkid-btn-primary:hover {
        box-shadow: 0 4px 12px var(--accent-light);
        transform: translateY(-1px);
    }
    .lynkid-btn-secondary {
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
    }
    .lynkid-btn-secondary:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Settings Cards Grid */
    .settings-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) {
        .settings-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 480px) {
        .settings-cards {
            grid-template-columns: 1fr;
        }
    }

    /* Settings Card */
    .settings-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        transition: all 0.2s;
        text-align: left;
        cursor: pointer;
    }
    button.settings-card {
        width: 100%;
        font: inherit;
    }
    .settings-card:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: var(--card-shadow-hover);
    }
    .settings-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }
    .settings-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .settings-card-icon svg {
        width: 24px;
        height: 24px;
    }
    .settings-card-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }
    .settings-card-desc {
        font-size: 12px;
        color: var(--text-muted);
    }
    .settings-card-meta {
        margin-top: 8px;
        font-size: 12px;
        font-weight: 600;
        color: var(--accent);
    }

    /* Status Summary */
    .status-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }
    @media (max-width: 900px) {
        .status-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 520px) {
        .status-summary {
            grid-template-columns: 1fr;
        }
    }
    .status-summary-item {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 16px;
    }
    .status-summary-label {
        display: block;
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .status-summary-value {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .status-dot {
        width: 9px;
        height: 9px;
        border-radius: 9999px;
        flex-shrink: 0;
    }
    .status-dot-green {
        background: #10b981;
    }
    .status-dot-gray {
        background: #94a3b8;
    }
    .status-dot-yellow {
        background: #f59e0b;
    }
    .status-summary-note {
        margin-top: 6px;
        font-size: 12px;
        color: var(--text-muted);
    }

    /* Icon Colors */
    .icon-blue { background: rgba(59, 130, 246, 0.15); }
    .icon-blue svg { color: #3b82f6; }
    .icon-emerald { background: rgba(16, 185, 129, 0.15); }
    .icon-emerald svg { color: #10b981; }
    .icon-purple { background: rgba(168, 85, 247, 0.15); }
    .icon-purple svg { color: #a855f7; }
    .icon-orange { background: rgba(251, 146, 60, 0.15); }
    .icon-orange svg { color: #fb923c; }
    .icon-teal { background: rgba(20, 184, 166, 0.15); }
    .icon-teal svg { color: #14b8a6; }
    .icon-pink { background: rgba(236, 72, 153, 0.15); }
    .icon-pink svg { color: #ec4899; }

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .form-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-secondary);
    }
    .form-card-header h2 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
    }
    .form-card-body {
        padding: 24px;
    }

    /* Success Alert */
    .success-alert {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #10b981;
        padding: 12px 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    .success-alert svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }
    .error-alert {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
        padding: 12px 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    .error-alert svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    .form-grid-full {
        grid-column: 1 / -1;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 0;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid var(--input-border);
        border-radius: 12px;
        font-size: 14px;
        background: var(--input-bg);
        color: var(--text-primary);
        transition: all 0.2s;
    }
    .form-input:focus {
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-light);
    }
    .form-input::placeholder {
        color: var(--text-muted);
    }
    .form-input.error {
        border-color: #ef4444;
    }
    .form-input-readonly {
        background: var(--bg-tertiary);
        color: var(--text-muted);
        cursor: not-allowed;
    }
    .form-textarea {
        resize: none;
        min-height: 100px;
    }
    .form-error {
        font-size: 13px;
        color: #ef4444;
        margin-top: 6px;
    }
    .form-hint {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
    }

    /* Username Input Group */
    .username-group {
        display: flex;
        border: 1.5px solid var(--input-border);
        border-radius: 12px;
        overflow: hidden;
    }
    .username-prefix {
        padding: 12px 14px;
        background: var(--bg-tertiary);
        border-right: 1px solid var(--input-border);
        color: var(--text-muted);
        font-size: 14px;
        white-space: nowrap;
    }
    .username-input {
        flex: 1;
        padding: 12px 16px;
        background: var(--bg-tertiary);
        color: var(--text-muted);
        font-size: 14px;
        border: none;
        cursor: not-allowed;
    }

    /* Submit Button */
    .submit-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #000;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px var(--accent-light);
    }
    .submit-btn svg {
        width: 16px;
        height: 16px;
    }
    .form-submit {
        display: flex;
        justify-content: flex-end;
        margin-top: 24px;
    }

    /* Modal */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        z-index: 50;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(8px);
    }
    .modal-backdrop.active {
        display: flex;
    }
    .settings-modal {
        width: min(100%, 520px);
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.22);
        overflow: hidden;
    }
    .settings-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-secondary);
    }
    .settings-modal-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .settings-modal-header p {
        margin-top: 4px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .modal-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        transition: all 0.2s;
    }
    .modal-close-btn:hover {
        background: var(--bg-tertiary);
        color: var(--text-primary);
    }
    .modal-close-btn svg {
        width: 18px;
        height: 18px;
    }
    .settings-modal-body {
        padding: 24px;
    }
    .modal-form-grid {
        display: grid;
        gap: 18px;
    }
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 24px;
    }
    .modal-cancel-btn {
        padding: 12px 18px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }
    .modal-cancel-btn:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Danger Zone */
    .status-card {
        background: var(--card-bg);
        border: 1px solid rgba(239, 68, 68, 0.28);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .status-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid rgba(239, 68, 68, 0.18);
        background: rgba(239, 68, 68, 0.06);
    }
    .status-card-header h2 {
        font-size: 16px;
        font-weight: 600;
        color: #ef4444;
    }
    .status-card-header p {
        margin-top: 4px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .status-card-body {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .status-info p {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }
    .status-info h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
    }
    .status-info p span {
        color: #10b981;
        font-weight: 600;
    }
    .status-info p span.inactive {
        color: #ef4444;
    }
    .status-info p:last-child {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* Toggle Button */
    .toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
        border: 1px solid;
    }
    .toggle-btn svg {
        width: 16px;
        height: 16px;
    }
    .toggle-btn-active {
        background: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
    .toggle-btn-active:hover {
        background: rgba(239, 68, 68, 0.2);
    }
    .toggle-btn-inactive {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.3);
        color: #10b981;
    }
    .toggle-btn-inactive:hover {
        background: rgba(16, 185, 129, 0.2);
    }

    /* Footer Links */
    .footer-links {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        padding: 16px 0;
    }
    .footer-links a {
        font-size: 12px;
        color: var(--text-muted);
        transition: color 0.2s;
    }
    .footer-links a:hover {
        color: var(--accent);
    }
    .footer-links span {
        color: var(--border-color);
    }
</style>
@endpush

@section('content')
<div class="py-6">
    <div class="settings-container">
        <!-- Header -->
        <div class="settings-header mb-6">
            <h1>Pengaturan</h1>
            <p>Kelola informasi dan pengaturan etalase {{ $store->name }}</p>
        </div>

        <!-- Lynkid Bar -->
        <div class="lynkid-bar">
            <div class="lynkid-info">
                <span class="lynkid-label">My Lynkid:</span>
                <span class="lynkid-url">{{ $store->public_url }}</span>
            </div>
            <div class="lynkid-actions">
                <a href="{{ $store->public_url }}" target="_blank" class="lynkid-btn lynkid-btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    Share
                </a>
                <button onclick="copyLink()" class="lynkid-btn lynkid-btn-secondary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                    </svg>
                    Copy Link
                </button>
            </div>
        </div>

        @php
            $hasPayoutSettings = filled($store->payout_bank_name)
                && filled($store->payout_account_number)
                && filled($store->payout_account_name);
            $payoutDigits = preg_replace('/\D/', '', (string) $store->payout_account_number);
            $maskedPayoutAccount = $payoutDigits
                ? '****' . substr($payoutDigits, -4)
                : null;
            $isPro = $store->isPro();
            $proExpiresAt = $isPro && $store->plan_expires_at
                ? $store->plan_expires_at->timezone(config('app.timezone'))->format('d M Y')
                : null;
        @endphp

        <!-- Mini Status Summary -->
        <div class="status-summary">
            <div class="status-summary-item">
                <span class="status-summary-label">Plan</span>
                <div class="status-summary-value">
                    <span class="status-dot {{ $isPro ? 'status-dot-green' : 'status-dot-gray' }}"></span>
                    {{ $store->plan_display_name }}
                </div>
                @if($proExpiresAt)
                    <p class="status-summary-note">Expired: {{ $proExpiresAt }}</p>
                @endif
            </div>

            <div class="status-summary-item">
                <span class="status-summary-label">Verified Seller</span>
                <div class="status-summary-value">
                    <span class="status-dot {{ $store->isVerifiedSeller() ? 'status-dot-green' : 'status-dot-gray' }}"></span>
                    {{ $store->isVerifiedSeller() ? 'Ya' : 'Tidak' }}
                </div>
                @if($store->verified_at)
                    <p class="status-summary-note">Sejak {{ $store->verified_at->timezone(config('app.timezone'))->format('d M Y') }}</p>
                @endif
            </div>

            <div class="status-summary-item">
                <span class="status-summary-label">Etalase Aktif</span>
                <div class="status-summary-value">
                    <span class="status-dot {{ $store->is_active ? 'status-dot-green' : 'status-dot-yellow' }}"></span>
                    {{ $store->is_active ? 'Ya' : 'Tidak' }}
                </div>
                <p class="status-summary-note">{{ $store->is_active ? 'Bisa dilihat publik' : 'Disembunyikan dari publik' }}</p>
            </div>

        </div>

        <!-- Settings Cards -->
        <div class="settings-cards">
            <!-- My Account -->
            <button type="button" class="settings-card" onclick="openAccountModal()">
                <div class="settings-card-inner">
                    <div class="settings-card-icon icon-blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="settings-card-title">My Account</h3>
                        <p class="settings-card-desc">Account detail, Shop information</p>
                        <p class="settings-card-meta">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </button>

            <!-- Payout Settings -->
            <button type="button" id="payout" class="settings-card" onclick="openPayoutModal()">
                <div class="settings-card-inner">
                    <div class="settings-card-icon icon-purple">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="settings-card-title">Payout Settings</h3>
                        <p class="settings-card-desc">Withdraw earnings, Bank account</p>
                        <p class="settings-card-meta">
                            @if($hasPayoutSettings)
                                {{ $store->payout_bank_name }} - {{ $maskedPayoutAccount }}
                            @else
                                Belum diatur
                            @endif
                        </p>
                    </div>
                </div>
            </button>

        </div>

        <!-- Store Info Form -->
        <div class="form-card">
            <div class="form-card-header">
                <h2>Informasi Etalase</h2>
            </div>
            <div class="form-card-body">
                @if(session('success'))
                    <div class="success-alert">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="error-alert">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.store.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-grid">
                        <!-- Store Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Etalase</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $store->name) }}"
                                   class="form-input @error('name') error @enderror" required>
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username (readonly) -->
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <div class="username-group">
                                <span class="username-prefix">etalaseku.test/</span>
                                <input type="text" id="username" name="username" value="{{ old('username', $store->username) }}"
                                       class="username-input" readonly>
                            </div>
                            <p class="form-hint">Username tidak dapat diubah</p>
                        </div>

                        <!-- WhatsApp -->
                        <div class="form-group">
                            <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $store->whatsapp) }}"
                                   class="form-input @error('whatsapp') error @enderror"
                                   placeholder="628123456789">
                            @error('whatsapp')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="form-hint">Gunakan format internasional Indonesia tanpa tanda +, contoh 628123456789. Jangan gunakan 082...</p>
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="form-submit">
                        <button type="submit" class="submit-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- My Account Modal -->
        <div id="accountModal" class="modal-backdrop" aria-hidden="true">
            <div class="settings-modal" role="dialog" aria-modal="true" aria-labelledby="accountModalTitle">
                <div class="settings-modal-header">
                    <div>
                        <h2 id="accountModalTitle">My Account</h2>
                        <p>Kelola password akun seller kamu.</p>
                    </div>
                    <button type="button" class="modal-close-btn" onclick="closeAccountModal()" aria-label="Tutup modal">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="settings-modal-body">
                        @if(session('status') === 'password-updated')
                            <div class="success-alert">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Password berhasil diubah.
                            </div>
                        @endif

                        <div class="modal-form-grid">
                            <div class="form-group">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password"
                                       id="current_password"
                                       name="current_password"
                                       class="form-input {{ $errors->updatePassword->has('current_password') ? 'error' : '' }}"
                                       autocomplete="current-password"
                                       required>
                                @if($errors->updatePassword->has('current_password'))
                                    <p class="form-error">{{ $errors->updatePassword->first('current_password') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-input {{ $errors->updatePassword->has('password') ? 'error' : '' }}"
                                       autocomplete="new-password"
                                       required>
                                @if($errors->updatePassword->has('password'))
                                    <p class="form-error">{{ $errors->updatePassword->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-input {{ $errors->updatePassword->has('password_confirmation') ? 'error' : '' }}"
                                       autocomplete="new-password"
                                       required>
                                @if($errors->updatePassword->has('password_confirmation'))
                                    <p class="form-error">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="modal-cancel-btn" onclick="closeAccountModal()">Batal</button>
                            <button type="submit" class="submit-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Payout Settings Modal -->
        <div id="payoutModal" class="modal-backdrop" aria-hidden="true">
            <div class="settings-modal" role="dialog" aria-modal="true" aria-labelledby="payoutModalTitle">
                <div class="settings-modal-header">
                    <div>
                        <h2 id="payoutModalTitle">Payout Settings</h2>
                        <p>Rekening ini akan otomatis dipakai saat kamu mengajukan withdraw.</p>
                    </div>
                    <button type="button" class="modal-close-btn" onclick="closePayoutModal()" aria-label="Tutup modal">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('seller.store.update') }}">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="name" value="{{ $store->name }}">
                    <input type="hidden" name="username" value="{{ $store->username }}">

                    <div class="settings-modal-body">
                        <div class="modal-form-grid">
                            <div class="form-group">
                                <label for="modal_payout_bank_name" class="form-label">Nama Bank</label>
                                <input type="text"
                                       id="modal_payout_bank_name"
                                       name="payout_bank_name"
                                       value="{{ old('payout_bank_name', $store->payout_bank_name) }}"
                                       class="form-input @error('payout_bank_name') error @enderror"
                                       placeholder="Contoh: Bank BCA"
                                       required>
                                @error('payout_bank_name')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="modal_payout_account_number" class="form-label">Nomor Rekening</label>
                                <input type="text"
                                       id="modal_payout_account_number"
                                       name="payout_account_number"
                                       value="{{ old('payout_account_number', $store->payout_account_number) }}"
                                       class="form-input @error('payout_account_number') error @enderror"
                                       placeholder="Contoh: 1234567890"
                                       required>
                                @error('payout_account_number')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="modal_payout_account_name" class="form-label">Nama Pemilik Rekening</label>
                                <input type="text"
                                       id="modal_payout_account_name"
                                       name="payout_account_name"
                                       value="{{ old('payout_account_name', $store->payout_account_name) }}"
                                       class="form-input @error('payout_account_name') error @enderror"
                                       placeholder="Nama sesuai rekening"
                                       required>
                                @error('payout_account_name')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="modal-cancel-btn" onclick="closePayoutModal()">Batal</button>
                            <button type="submit" class="submit-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Payout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="status-card">
            <div class="status-card-header">
                <h2>Danger Zone</h2>
                <p>Pengaturan operasional yang berdampak langsung ke akses publik etalase.</p>
            </div>
            <div class="status-card-body">
                <div class="status-info">
                    <h3>Publikasi Etalase</h3>
                    <p>Etalase saat ini <span class="{{ $store->is_active ? '' : 'inactive' }}">{{ $store->is_active ? 'sedang aktif' : 'sedang nonaktif' }}</span></p>
                    <p>
                        @if($store->is_active)
                            Jika dinonaktifkan, halaman publik etalase tidak bisa diakses customer. Data, produk, blok, dan pengaturan tetap tersimpan.
                        @else
                            Etalase sedang disembunyikan dari publik. Aktifkan kembali agar customer bisa membuka halaman etalase kamu.
                        @endif
                    </p>
                </div>
                <form action="{{ route('seller.store.toggle-active') }}" method="POST">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $store->is_active ? 'toggle-btn-active' : 'toggle-btn-inactive' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                        {{ $store->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            <a href="#">Terms & Conditions</a>
            <span>|</span>
            <a href="#">Privacy</a>
            <span>|</span>
            <a href="#">Contact Us</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyLink() {
        const url = '{{ $store->public_url }}';
        navigator.clipboard.writeText(url).then(() => {
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Link Tersalin!
            `;
            btn.classList.remove('lynkid-btn-secondary');
            btn.classList.add('lynkid-btn-primary');
            btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            btn.style.color = 'white';

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('lynkid-btn-primary');
                btn.classList.add('lynkid-btn-secondary');
                btn.style.background = '';
                btn.style.color = '';
            }, 2000);
        });
    }

    function openPayoutModal() {
        const modal = document.getElementById('payoutModal');
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            document.getElementById('modal_payout_bank_name')?.focus();
        }, 50);
    }

    function openAccountModal() {
        const modal = document.getElementById('accountModal');
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            document.getElementById('current_password')?.focus();
        }, 50);
    }

    function closeAccountModal() {
        const modal = document.getElementById('accountModal');
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function closePayoutModal() {
        const modal = document.getElementById('payoutModal');
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.getElementById('accountModal')?.addEventListener('click', (event) => {
        if (event.target.id === 'accountModal') {
            closeAccountModal();
        }
    });

    document.getElementById('payoutModal')?.addEventListener('click', (event) => {
        if (event.target.id === 'payoutModal') {
            closePayoutModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAccountModal();
            closePayoutModal();
        }
    });

    @if($errors->updatePassword->any() || session('status') === 'password-updated')
        openAccountModal();
    @endif

    @if(session('open_payout_modal') || $errors->has('payout_bank_name') || $errors->has('payout_account_number') || $errors->has('payout_account_name'))
        openPayoutModal();
    @endif
</script>
@endpush
@endsection
