@extends('layouts.seller')

@section('title', 'Verifikasi Seller - EtalaseKu')
@section('breadcrumb', 'Verifikasi Seller')

@push('head')
<style>
    /* Verification Page - Dark Theme */
    .verification-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Header */
    .verification-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #fafafa;
    }
    .verification-header p {
        margin-top: 4px;
        font-size: 14px;
        color: #a1a1aa;
    }

    /* Status Card */
    .status-card {
        background: #18181b;
        border: 1px solid #3f3f46;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .status-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }
    .status-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .status-icon svg {
        width: 32px;
        height: 32px;
    }
    .status-icon-verified { background: rgba(16, 185, 129, 0.15); }
    .status-icon-verified svg { color: #10b981; }
    .status-icon-pending { background: rgba(251, 191, 36, 0.15); }
    .status-icon-pending svg { color: #fbbf24; }
    .status-icon-rejected { background: rgba(239, 68, 68, 0.15); }
    .status-icon-rejected svg { color: #ef4444; }
    .status-icon-unverified { background: #27272a; }
    .status-icon-unverified svg { color: #71717a; }

    .status-content {
        flex: 1;
    }
    .status-title {
        font-size: 18px;
        font-weight: 600;
        color: #fafafa;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .status-title span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background: #3b82f6;
        border-radius: 50%;
    }
    .status-title span svg {
        width: 14px;
        height: 14px;
        color: white;
    }
    .status-desc {
        font-size: 14px;
        color: #a1a1aa;
        margin-top: 4px;
    }
    .status-meta {
        font-size: 12px;
        color: #71717a;
        margin-top: 8px;
    }

    /* Cancel Button */
    .cancel-btn {
        padding: 8px 16px;
        color: #ef4444;
        background: transparent;
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .cancel-btn:hover {
        background: rgba(239, 68, 68, 0.1);
    }

    /* Rejection Notes */
    .rejection-box {
        margin-top: 12px;
        padding: 12px 16px;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
    }
    .rejection-box-title {
        font-size: 14px;
        font-weight: 600;
        color: #ef4444;
        margin-bottom: 4px;
    }
    .rejection-box-text {
        font-size: 14px;
        color: #fafafa;
    }

    /* Info Alert */
    .info-alert {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    .info-alert-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    .info-alert-header svg {
        width: 18px;
        height: 18px;
        color: #3b82f6;
    }
    .info-alert-header span {
        font-size: 14px;
        font-weight: 600;
        color: #3b82f6;
    }
    .info-alert-list {
        font-size: 13px;
        color: #a1a1aa;
        line-height: 1.6;
    }
    .info-alert-list li {
        margin-bottom: 4px;
    }
    .info-alert-list strong {
        color: #d4d4d8;
    }
    .info-alert-footer {
        margin-top: 12px;
        font-size: 12px;
        color: #71717a;
    }

    /* Section Card */
    .section-card {
        background: #18181b;
        border: 1px solid #3f3f46;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #fafafa;
        margin-bottom: 20px;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 768px) {
        .form-grid-3 {
            grid-template-columns: 1fr;
        }
    }

    /* Form Group */
    .form-group {
        margin-bottom: 0;
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
        padding: 12px 14px;
        border: 1.5px solid #3f3f46;
        border-radius: 10px;
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
    .form-input.error {
        border-color: #ef4444;
    }
    .form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid #3f3f46;
        border-radius: 10px;
        font-size: 14px;
        background: #27272a;
        color: #fafafa;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 18px;
    }
    .form-select:focus {
        border-color: #fbbf24;
        outline: none;
    }
    .form-error {
        font-size: 13px;
        color: #ef4444;
        margin-top: 6px;
    }

    /* Upload Grid */
    .upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 640px) {
        .upload-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed #52525b;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
    }
    .upload-area:hover {
        border-color: #fbbf24;
    }
    .upload-area.has-file {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.05);
    }
    .upload-area svg {
        width: 40px;
        height: 40px;
        color: #71717a;
        margin: 0 auto 8px;
    }
    .upload-area p {
        font-size: 14px;
        color: #a1a1aa;
    }
    .upload-area img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 8px;
        margin: 0 auto;
        display: block;
    }
    .upload-area .file-name {
        font-size: 12px;
        color: #10b981;
        margin-top: 8px;
    }

    /* Submit Button */
    .submit-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 24px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: black;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .submit-btn svg {
        width: 18px;
        height: 18px;
    }
    .form-submit {
        display: flex;
        justify-content: flex-end;
        margin-top: 24px;
    }
</style>
@endpush

@section('content')
<div class="py-6">
    <div class="verification-container">
        <!-- Header -->
        <div class="verification-header mb-6">
            <h1>Verifikasi Seller</h1>
            <p>Upload dokumen untuk mendapatkan badge verified</p>
        </div>

        <!-- Status Card -->
        <div class="status-card">
            <div class="status-card-inner">
                @if($store->is_verified_seller)
                    <!-- verified Status -->
                    <div class="status-icon status-icon-verified">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="status-content">
                        <h2 class="status-title">
                            Seller Terverifikasi
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </h2>
                        <p class="status-desc">Akun seller kamu sudah terverifikasi. Badge verified akan muncul di etalase publik.</p>
                        @if($store->verified_at)
                            <p class="status-meta">Diverifikasi pada: {{ $store->verified_at->format('d F Y, H:i') }}</p>
                        @endif
                    </div>
                @elseif($verification && $verification->isPending)
                    <!-- Pending Status -->
                    <div class="status-icon status-icon-pending">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="status-content">
                        <h2 class="status-title">Menunggu Review</h2>
                        <p class="status-desc">Dokumen kamu sedang dalam proses review oleh tim kami. Biasanya membutuhkan 1-3 hari kerja.</p>
                        <p class="status-meta">Submitted: {{ $verification->submitted_at->format('d F Y, H:i') }}</p>
                    </div>
                    <form action="{{ route('seller.verification.destroy', $verification) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan verifikasi?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cancel-btn">Batalkan</button>
                    </form>
                @elseif($verification && $verification->isRejected)
                    <!-- Rejected Status -->
                    <div class="status-icon status-icon-rejected">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="status-content">
                        <h2 class="status-title">Ditolak</h2>
                        <p class="status-desc">Dokumen kamu tidak memenuhi persyaratan. Silakan upload ulang.</p>
                        @if($verification->admin_notes)
                            <div class="rejection-box">
                                <p class="rejection-box-title">Alasan penolakan:</p>
                                <p class="rejection-box-text">{{ $verification->admin_notes }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Not Verified Status -->
                    <div class="status-icon status-icon-unverified">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="status-content">
                        <h2 class="status-title">Belum Terverifikasi</h2>
                        <p class="status-desc">Upload dokumen di bawah untuk mendapatkan badge verified di etalase kamu.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Show Verified or Rejected - No Form -->
        @if($store->is_verified_seller || ($verification && ($verification->isPending || $verification->isRejected && !$verification->isPending && !$store->is_verified_seller && $verification->status === 'rejected')))
            @if($verification && $verification->isRejected && !$verification->isPending && !$store->is_verified_seller)
                <!-- Show Form for Rejected - Can Resubmit -->
            @else
                @php
                    $showForm = false;
                @endphp
            @endif
        @endif

        <!-- Upload Form -->
        @if(!$store->is_verified_seller && (!$verification || $verification->isRejected))
            <form method="POST" action="{{ route('seller.verification.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Document Requirements -->
                <div class="info-alert">
                    <div class="info-alert-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Persyaratan Dokumen</span>
                    </div>
                    <ul class="info-alert-list">
                        <li>• <strong>KTP</strong> - Foto KTP asli yang masih berlaku (wajib)</li>
                        <li>• <strong>NPWP</strong> - Foto NPWP asli (wajib)</li>
                        <li>• <strong>Surat Izin Usaha</strong> - NIB atau Surat Izin Usaha lainnya (opsional)</li>
                        <li>• <strong>Selfie dengan KTP</strong> - Foto selfie memegang KTP (opsional)</li>
                    </ul>
                    <p class="info-alert-footer">Format: JPG, PNG, PDF. Maksimal ukuran: 5MB (KTP, NPWP, Selfie) atau 10MB (SIU)</p>
                </div>

                <div class="space-y-5">
                    <!-- Personal Information -->
                    <div class="section-card">
                        <h3 class="section-title">Informasi Personal</h3>
                        <div class="form-grid">
                            <div>
                                <label for="nik" class="form-label">Nomor KTP <span class="required">*</span></label>
                                <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                                       class="form-input @error('nik') error @enderror"
                                       placeholder="1234567890123456">
                                @error('nik')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="full_name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $store->user->name ?? '') }}"
                                       class="form-input @error('full_name') error @enderror"
                                       placeholder="John Doe">
                                @error('full_name')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Business Information -->
                    <div class="section-card">
                        <h3 class="section-title">Informasi Bisnis (Opsional)</h3>
                        <div class="form-grid-3">
                            <div>
                                <label for="business_name" class="form-label">Nama Bisnis</label>
                                <input type="text" id="business_name" name="business_name" value="{{ old('business_name', $store->name) }}"
                                       class="form-input"
                                       placeholder="Nama Bisnis Anda">
                            </div>
                            <div>
                                <label for="business_type" class="form-label">Jenis Bisnis</label>
                                <select id="business_type" name="business_type" class="form-select">
                                    <option value="">Pilih Jenis</option>
                                    <option value="personal" {{ old('business_type') === 'personal' ? 'selected' : '' }}>Personal / Perorangan</option>
                                    <option value="company" {{ old('business_type') === 'company' ? 'selected' : '' }}>Perusahaan</option>
                                    <option value="cooperative" {{ old('business_type') === 'cooperative' ? 'selected' : '' }}>Koperasi</option>
                                </select>
                            </div>
                            <div>
                                <label for="nib_number" class="form-label">Nomor NIB</label>
                                <input type="text" id="nib_number" name="nib_number" value="{{ old('nib_number') }}"
                                       class="form-input"
                                       placeholder="1234567890">
                            </div>
                        </div>
                    </div>

                    <!-- Document Uploads -->
                    <div class="section-card">
                        <h3 class="section-title">Upload Dokumen</h3>
                        <div class="upload-grid">
                            <!-- KTP -->
                            <div>
                                <label class="form-label">Foto KTP <span class="required">*</span></label>
                                <div class="upload-area {{ old('ktp_file') ? 'has-file' : '' }}" id="ktp-upload-area"
                                     onclick="document.getElementById('ktp_file').click()">
                                    @if(old('ktp_file'))
                                        <p class="file-name">File selected</p>
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p>Klik untuk upload</p>
                                    @endif
                                </div>
                                <input type="file" id="ktp_file" name="ktp_file" accept="image/jpeg,image/png" class="hidden" onchange="previewFile(this, 'ktp-upload-area')">
                                @error('ktp_file')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NPWP -->
                            <div>
                                <label class="form-label">Foto NPWP <span class="required">*</span></label>
                                <div class="upload-area {{ old('npwp_file') ? 'has-file' : '' }}" id="npwp-upload-area"
                                     onclick="document.getElementById('npwp_file').click()">
                                    @if(old('npwp_file'))
                                        <p class="file-name">File selected</p>
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p>Klik untuk upload</p>
                                    @endif
                                </div>
                                <input type="file" id="npwp_file" name="npwp_file" accept="image/jpeg,image/png" class="hidden" onchange="previewFile(this, 'npwp-upload-area')">
                                @error('npwp_file')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Surat Izin Usaha -->
                            <div>
                                <label class="form-label">Surat Izin Usaha (NIB/SIU)</label>
                                <div class="upload-area {{ old('siu_file') ? 'has-file' : '' }}" id="siu-upload-area"
                                     onclick="document.getElementById('siu_file').click()">
                                    @if(old('siu_file'))
                                        <p class="file-name">File selected</p>
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p>Klik untuk upload (PDF/JPG/PNG)</p>
                                    @endif
                                </div>
                                <input type="file" id="siu_file" name="siu_file" accept=".pdf,image/jpeg,image/png" class="hidden" onchange="previewFile(this, 'siu-upload-area')">
                                @error('siu_file')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Selfie with KTP -->
                            <div>
                                <label class="form-label">Selfie dengan KTP</label>
                                <div class="upload-area {{ old('selfie_file') ? 'has-file' : '' }}" id="selfie-upload-area"
                                     onclick="document.getElementById('selfie_file').click()">
                                    @if(old('selfie_file'))
                                        <p class="file-name">File selected</p>
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <p>Klik untuk upload</p>
                                    @endif
                                </div>
                                <input type="file" id="selfie_file" name="selfie_file" accept="image/jpeg,image/png" class="hidden" onchange="previewFile(this, 'selfie-upload-area')">
                                @error('selfie_file')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-submit">
                        <button type="submit" class="submit-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Submit Verification
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewFile(input, areaId) {
        const file = input.files[0];
        const uploadArea = document.getElementById(areaId);

        if (file) {
            // Validate file type
            if (!file.type.match('image.*') && !file.type.match('application/pdf')) {
                alert('Please select an image or PDF file');
                input.value = '';
                return;
            }

            // Validate file size (5MB for images, 10MB for PDF)
            const maxSize = file.type === 'application/pdf' ? 10 * 1024 * 1024 : 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('File size exceeds the maximum limit');
                input.value = '';
                return;
            }

            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadArea.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <p class="file-name">${file.name}</p>
                    `;
                    uploadArea.classList.add('has-file');
                };
                reader.readAsDataURL(file);
            } else {
                uploadArea.innerHTML = `
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p>${file.name}</p>
                `;
                uploadArea.classList.add('has-file');
            }
        }
    }
</script>
@endpush
