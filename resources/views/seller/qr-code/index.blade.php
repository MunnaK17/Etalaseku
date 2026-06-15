@extends('layouts.seller')

@section('title', 'QR Code - EtalaseKu')
@section('breadcrumb', 'QR Code')

@push('head')
<style>
    /* QR Code Page - Theme Aware */
    .qr-page-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Header */
    .qr-header {
        margin-bottom: 24px;
    }
    .qr-header h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .qr-header p {
        margin-top: 4px;
        font-size: 14px;
        color: var(--text-secondary);
    }

    /* Main Grid */
    .qr-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    @media (max-width: 768px) {
        .qr-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Card Base */
    .qr-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    .qr-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-tertiary);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qr-card-header h2 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qr-card-header svg {
        width: 20px;
        height: 20px;
        color: var(--accent);
    }
    .qr-card-body {
        padding: 24px;
    }

    /* Preview Section */
    .qr-preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .qr-preview-box {
        background: white;
        padding: 16px;
        border-radius: 12px;
        border: 2px dashed var(--border-color);
    }
    .qr-preview-box img {
        width: 256px;
        height: 256px;
        object-fit: contain;
    }
    .qr-preview-text {
        margin-top: 16px;
        font-size: 14px;
        color: var(--text-secondary);
        text-align: center;
        word-break: break-all;
        max-width: 100%;
    }
    .qr-preview-text span {
        font-family: 'JetBrains Mono', monospace;
        color: var(--accent);
    }

    /* URL Input */
    .qr-url-section {
        margin-top: 24px;
    }
    .qr-url-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }
    .qr-url-input-group {
        display: flex;
        gap: 8px;
    }
    .qr-url-input {
        flex: 1;
        padding: 12px 16px;
        border: 1.5px solid var(--input-border);
        border-radius: 10px;
        font-size: 14px;
        background: var(--input-bg);
        color: var(--text-primary);
        transition: all 0.2s;
    }
    .qr-url-input:focus {
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-light);
    }
    .qr-url-input::placeholder {
        color: var(--text-muted);
    }
    .qr-update-btn {
        padding: 12px 20px;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: black;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .qr-update-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }

    /* Size Options */
    .qr-size-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 12px;
    }
    .qr-size-options {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .qr-size-option {
        cursor: pointer;
    }
    .qr-size-option input {
        position: absolute;
        opacity: 0;
    }
    .qr-size-option span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 40px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        background: var(--bg-tertiary);
        transition: all 0.2s;
    }
    .qr-size-option input:checked + span {
        border-color: var(--accent);
        background: var(--accent-light);
        color: var(--accent);
    }
    .qr-size-option span:hover {
        border-color: var(--accent);
    }

    /* Color Inputs */
    .qr-colors-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .qr-color-item label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }
    .qr-color-input-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qr-color-picker {
        width: 48px;
        height: 40px;
        border-radius: 10px;
        cursor: pointer;
        border: 2px solid var(--border-color);
        padding: 0;
        background: none;
    }
    .qr-color-picker::-webkit-color-swatch-wrapper {
        padding: 2px;
    }
    .qr-color-picker::-webkit-color-swatch {
        border-radius: 6px;
        border: none;
    }
    .qr-color-text {
        flex: 1;
        padding: 10px 12px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        font-family: 'JetBrains Mono', monospace;
        background: var(--bg-tertiary);
        color: var(--text-primary);
    }
    .qr-color-text:focus {
        border-color: var(--accent);
        outline: none;
    }

    /* Preset Colors */
    .qr-preset-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 12px;
    }
    .qr-preset-colors {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .qr-preset-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 2px solid var(--border-color);
        cursor: pointer;
        transition: all 0.2s;
    }
    .qr-preset-btn:hover {
        transform: scale(1.1);
        border-color: var(--accent);
    }

    /* Download Buttons */
    .qr-download-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }
    .qr-download-btn svg {
        width: 20px;
        height: 20px;
    }
    .qr-download-btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: black;
    }
    .qr-download-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .qr-download-btn-secondary {
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        border: 1.5px solid var(--border-color);
    }
    .qr-download-btn-secondary:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Copy Link Section */
    .qr-copy-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border-color);
    }

    /* Tips Card */
    .qr-tips-card {
        background: var(--accent-light);
        border-radius: 16px;
        padding: 20px 24px;
        border: 1px solid var(--accent);
    }
    .qr-tips-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--accent);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .qr-tips-title svg {
        width: 20px;
        height: 20px;
    }
    .qr-tips-list {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
    }
    .qr-tips-list li {
        margin-bottom: 4px;
    }

    /* Toast notification */
    .qr-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--success);
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        z-index: 100;
        animation: slideIn 0.3s ease;
    }
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Additional text color overrides */
    .text-sm.font-medium.text-zinc-300 {
        color: var(--text-secondary) !important;
    }
</style>
@endpush

@section('content')
<div class="py-6">
    <div class="qr-page-container">
        <!-- Header -->
        <div class="qr-header">
            <h1>QR Code Generator</h1>
            <p>Generate dan download QR code untuk etalase {{ $store->name }}</p>
        </div>

        <div class="qr-grid">
            <!-- Preview Section -->
            <div class="qr-card">
                <div class="qr-card-header">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <h2>Preview</h2>
                </div>
                <div class="qr-card-body">
                    <!-- QR Preview -->
                    <div class="qr-preview-container">
                        <div class="qr-preview-box">
                            <img id="qr-image" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode($storeUrl) }}" alt="QR Code">
                        </div>
                        <p class="qr-preview-text">
                            Scan untuk membuka:<br>
                            <span>{{ $storeUrl }}</span>
                        </p>
                    </div>

                    <!-- Store URL Input -->
                    <div class="qr-url-section">
                        <label class="qr-url-label">URL</label>
                        <div class="qr-url-input-group">
                            <input type="url" id="qr-url" value="{{ $storeUrl }}"
                                   class="qr-url-input" placeholder="Masukkan URL...">
                            <button onclick="updatePreview()" class="qr-update-btn">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="space-y-6">
                <!-- Customization Options -->
                <div class="qr-card">
                    <div class="qr-card-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        <h2>Kustomisasi</h2>
                    </div>
                    <div class="qr-card-body space-y-5">
                        <!-- Size -->
                        <div>
                            <label class="qr-size-label">Ukuran</label>
                            <div class="qr-size-options">
                                @foreach([200, 300, 400, 500, 600] as $size)
                                    <label class="qr-size-option">
                                        <input type="radio" name="size" value="{{ $size }}" class="sr-only"
                                               {{ $size == 300 ? 'checked' : '' }}
                                               onchange="updatePreview()">
                                        <span>{{ $size }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Colors -->
                        <div class="qr-colors-grid">
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Warna QR</label>
                                <div class="qr-color-input-group">
                                    <input type="color" id="qr-color" value="#000000"
                                           class="qr-color-picker"
                                           onchange="syncColorInputs(); updatePreview()">
                                    <input type="text" id="qr-color-text" value="#000000"
                                           class="qr-color-text"
                                           onchange="syncColorInputs(); updatePreview()">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Warna Background</label>
                                <div class="qr-color-input-group">
                                    <input type="color" id="qr-bgcolor" value="#ffffff"
                                           class="qr-color-picker"
                                           onchange="syncBgcolorInputs(); updatePreview()">
                                    <input type="text" id="qr-bgcolor-text" value="#ffffff"
                                           class="qr-color-text"
                                           onchange="syncBgcolorInputs(); updatePreview()">
                                </div>
                            </div>
                        </div>

                        <!-- Preset Colors -->
                        <div>
                            <label class="qr-preset-label">Preset Warna</label>
                            <div class="qr-preset-colors">
                                <button onclick="setColorPreset('#000000', '#ffffff')" class="qr-preset-btn" style="background: white;" title="Hitam Putih"></button>
                                <button onclick="setColorPreset('#1a1a2e', '#ffffff')" class="qr-preset-btn" style="background: #1a1a2e;" title="Dark Blue"></button>
                                <button onclick="setColorPreset('#ffffff', '#4f46e5')" class="qr-preset-btn" style="background: #4f46e5;" title="Indigo"></button>
                                <button onclick="setColorPreset('#ffffff', '#059669')" class="qr-preset-btn" style="background: #059669;" title="Emerald"></button>
                                <button onclick="setColorPreset('#ffffff', '#dc2626')" class="qr-preset-btn" style="background: #dc2626;" title="Red"></button>
                                <button onclick="setColorPreset('#ffffff', '#ea580c')" class="qr-preset-btn" style="background: #ea580c;" title="Orange"></button>
                                <button onclick="setColorPreset('#ffffff', '#7c3aed')" class="qr-preset-btn" style="background: #7c3aed;" title="Purple"></button>
                                <button onclick="setColorPreset('#ffffff', '#db2777')" class="qr-preset-btn" style="background: #db2777;" title="Pink"></button>
                                <button onclick="setColorPreset('#000000', '#ffeb3b')" class="qr-preset-btn" style="background: #ffeb3b;" title="Yellow"></button>
                                <button onclick="setColorPreset('#000000', '#fbbf24')" class="qr-preset-btn" style="background: #fbbf24;" title="Gold"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Options -->
                <div class="qr-card">
                    <div class="qr-card-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <h2>Download</h2>
                    </div>
                    <div class="qr-card-body">
                        <!-- Download Buttons -->
                        <div class="space-y-3">
                            <button onclick="downloadQr('png')" class="qr-download-btn qr-download-btn-primary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Download PNG (High Quality)
                            </button>
                            <button onclick="downloadQr('svg')" class="qr-download-btn qr-download-btn-secondary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Download SVG (Vector)
                            </button>
                        </div>

                        <!-- Copy Link -->
                        <div class="qr-copy-section">
                            <button onclick="copyLink()" class="qr-download-btn qr-download-btn-secondary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                Copy QR Link
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="qr-tips-card">
                    <h3 class="qr-tips-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tips
                    </h3>
                    <ul class="qr-tips-list">
                        <li>• Gunakan warna kontras tinggi untuk QR code yang mudah discan</li>
                        <li>• PNG recomended untuk print/poster</li>
                        <li>• SVG recomended untuk desain graphic</li>
                        <li>• Test scan QR code sebelum print</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // QR Server API base
    const QR_API_BASE = 'https://api.qrserver.com/v1/create-qr-code/';

    // Get current settings
    function getSettings() {
        const size = document.querySelector('input[name="size"]:checked')?.value || 300;
        const color = document.getElementById('qr-color-text').value.replace('#', '');
        const bgcolor = document.getElementById('qr-bgcolor-text').value.replace('#', '');
        const url = document.getElementById('qr-url').value;

        return { size, color, bgcolor, url };
    }

    // Generate QR URL
    function generateQrUrl(url, size, color, bgcolor) {
        return `${QR_API_BASE}?size=${size}x${size}&color=${color}&bgcolor=${bgcolor}&data=${encodeURIComponent(url)}`;
    }

    // Update preview
    function updatePreview() {
        const { size, color, bgcolor, url } = getSettings();

        if (!url) {
            showToast('Masukkan URL terlebih dahulu', 'error');
            return;
        }

        const qrUrl = generateQrUrl(url, size, color, bgcolor);
        document.getElementById('qr-image').src = qrUrl;
    }

    // Sync color inputs
    function syncColorInputs() {
        const picker = document.getElementById('qr-color');
        const text = document.getElementById('qr-color-text');
        picker.value = text.value;
    }

    function syncBgcolorInputs() {
        const picker = document.getElementById('qr-bgcolor');
        const text = document.getElementById('qr-bgcolor-text');
        picker.value = text.value;
    }

    // Set color preset
    function setColorPreset(color, bgcolor) {
        color = color.replace('#', '');
        bgcolor = bgcolor.replace('#', '');

        document.getElementById('qr-color').value = '#' + color;
        document.getElementById('qr-color-text').value = '#' + color;
        document.getElementById('qr-bgcolor').value = '#' + bgcolor;
        document.getElementById('qr-bgcolor-text').value = '#' + bgcolor;

        updatePreview();
    }

    // Download QR code
    function downloadQr(format) {
        const { size, color, bgcolor, url } = getSettings();

        if (!url) {
            showToast('Masukkan URL terlebih dahulu', 'error');
            return;
        }

        // Use higher resolution for download
        const downloadSize = 600;
        const qrUrl = `${QR_API_BASE}?size=${downloadSize}x${downloadSize}&format=${format}&color=${color}&bgcolor=${bgcolor}&data=${encodeURIComponent(url)}`;

        // Create download link
        const link = document.createElement('a');
        link.href = qrUrl;
        link.download = `qrcode-{{ $store->username }}-${new Date().toISOString().slice(0,10)}.${format}`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('QR Code berhasil didownload!');
    }

    // Copy link to clipboard
    function copyLink() {
        const { size, color, bgcolor, url } = getSettings();
        const qrUrl = generateQrUrl(url, size, color, bgcolor);

        navigator.clipboard.writeText(qrUrl).then(() => {
            showToast('Link berhasil disalin!');
        });
    }

    // Show toast notification
    function showToast(message, type = 'success') {
        // Remove existing toast
        const existingToast = document.querySelector('.qr-toast');
        if (existingToast) existingToast.remove();

        // Create toast
        const toast = document.createElement('div');
        toast.className = 'qr-toast';
        toast.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            ${message}
        `;
        document.body.appendChild(toast);

        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideIn 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Sync text inputs on input
        document.getElementById('qr-color').addEventListener('input', syncColorInputs);
        document.getElementById('qr-bgcolor').addEventListener('input', syncBgcolorInputs);
    });
</script>
@endpush
