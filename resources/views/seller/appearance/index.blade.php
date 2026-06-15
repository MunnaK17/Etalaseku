@extends('layouts.seller')

@section('title', 'Appearance - EtalaseKu')
@section('breadcrumb', 'Appearance')

@push('head')
<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Raleway:wght@400;500;600;700&family=Roboto:wght@400;500;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Great+Vibes&family=East+Sea+Dokdo&family=Satisfy&family=Fredoka:wght@400;500;600;700&display=swap');

    /* Layout - Lynk.id Style 2 Columns - Dark Theme */
    .appearance-page {
        display: flex;
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 24px 0;
    }
    .appearance-form-col {
        flex: 1;
        max-width: 620px;
        min-width: 0;
    }
    .appearance-preview-col {
        width: 430px;
        flex-shrink: 0;
        position: fixed;
        right: 32px;
        top: 100px;
        z-index: 100;
    }

    /* Live Preview - Dashboard style, fixed right side */
    .appearance-preview-card {
        background: #18181b;
        border: 1px solid #3f3f46;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        padding: 16px;
    }
    .appearance-preview-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .appearance-preview-title {
        font-size: 18px;
        font-weight: 600;
        color: #fafafa;
    }
    .appearance-preview-refresh {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #a1a1aa;
        transition: all 0.2s;
    }
    .appearance-preview-refresh:hover {
        color: #fbbf24;
        background: #27272a;
    }
    .appearance-preview-refresh svg {
        width: 20px;
        height: 20px;
    }
    .appearance-preview-refresh.is-refreshing svg {
        animation: spin 1s linear infinite;
    }
    .appearance-preview-frame {
        height: calc(100vh - 190px);
        min-height: 520px;
        max-height: 720px;
        border: 2px solid #3f3f46;
        border-radius: 12px;
        overflow: hidden;
        background: #09090b;
    }
    .appearance-preview-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Header Bar - Dark */
    .page-header {
        background: #18181b;
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        border: 1px solid #3f3f46;
    }
    .page-url {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .page-url-label {
        font-size: 12px;
        color: #71717a;
        font-weight: 500;
    }
    .page-url-value {
        font-size: 14px;
        color: #fafafa;
        font-weight: 600;
    }
    .page-url-value span {
        color: #fbbf24;
    }
    .page-header-actions {
        display: flex;
        gap: 10px;
    }
    .btn-action {
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action svg {
        width: 16px;
        height: 16px;
    }
    .btn-share {
        background: #27272a;
        border: 1.5px solid #3f3f46;
        color: #a1a1aa;
    }
    .btn-share:hover {
        border-color: #fbbf24;
        color: #fbbf24;
        background: #27272a;
    }
    .btn-customize {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
    }
    .btn-customize:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    /* Section Card - Dark */
    .section-card {
        background: #18181b;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        border: 1px solid #3f3f46;
    }
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #fafafa;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title svg {
        width: 20px;
        height: 20px;
        color: #fbbf24;
    }
    .section-desc {
        font-size: 13px;
        color: #a1a1aa;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    /* Badge */
    .badge-pro {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-info {
        background: #27272a;
        color: #a1a1aa;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Toggle - Dark */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid #27272a;
    }
    .toggle-label {
        font-size: 14px;
        font-weight: 500;
        color: #d4d4d8;
    }
    .toggle-label-with-info {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .info-icon {
        width: 16px;
        height: 16px;
        color: #71717a;
        cursor: help;
    }
    .toggle-switch {
        width: 48px;
        height: 26px;
        background: #3f3f46;
        border-radius: 13px;
        position: relative;
        cursor: pointer;
        transition: all 0.25s;
    }
    .toggle-switch.active {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    .toggle-switch::after {
        content: '';
        position: absolute;
        width: 22px;
        height: 22px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: all 0.25s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .toggle-switch.active::after {
        left: 24px;
    }

    /* Visual Card Selector - Dark */
    .visual-grid {
        display: grid;
        gap: 12px;
    }
    .visual-card {
        position: relative;
        border: 2px solid #3f3f46;
        border-radius: 14px;
        padding: 16px;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
    }
    .visual-card:hover {
        border-color: #fbbf24;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.1);
    }
    .visual-card.selected {
        border-color: #fbbf24;
        background: linear-gradient(135deg, #27272a 0%, #1c1c1e 100%);
    }
    .visual-card.selected::before {
        content: '';
        position: absolute;
        top: 10px;
        right: 10px;
        width: 22px;
        height: 22px;
        background: #fbbf24;
        border-radius: 50%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 24 24'%3E%3Cpath d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z'/%3E%3C/svg%3E");
        background-size: 14px;
        background-position: center;
        background-repeat: no-repeat;
    }
    .visual-card input[type="radio"],
    .visual-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .visual-card.pro-locked {
        opacity: 0.6;
    }
    .pro-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.75);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        z-index: 5;
        gap: 8px;
    }
    .pro-overlay .pro-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }

    /* Layout Preview - Dark */
    .layout-preview {
        height: 70px;
        background: #18181b;
        border-radius: 10px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #3f3f46;
    }
    .layout-preview .banner {
        height: 28px;
        width: 100%;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
    }
    .layout-preview .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border: 3px solid #18181b;
        margin-top: -16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .layout-preview .name-bar {
        height: 8px;
        width: 60%;
        background: #52525b;
        border-radius: 4px;
        margin-top: 8px;
    }
    .layout-preview.clean-preview {
        justify-content: center;
    }
    .layout-preview.clean-preview .name-bar {
        width: 50%;
        margin-top: 0;
    }
    .layout-preview.modern-preview {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        align-items: stretch;
        justify-content: flex-start;
        padding: 10px 12px;
        gap: 10px;
    }
    .modern-preview .modern-profile-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modern-preview .avatar {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: #ffffff;
        border: 3px solid rgba(24, 24, 27, 0.22);
        margin-top: 0;
        box-shadow: none;
        flex-shrink: 0;
    }
    .modern-preview .name-bar {
        width: 52%;
        height: 8px;
        margin-top: 0;
        background: rgba(24, 24, 27, 0.45);
    }
    .modern-preview .cta-bar {
        height: 16px;
        width: 100%;
        border-radius: 999px;
        border: 2px solid rgba(24, 24, 27, 0.45);
        background: rgba(255, 255, 255, 0.45);
    }

    /* Upload Area - Dark */
    .upload-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 20px;
    }
    .upload-area {
        border: 2px dashed #52525b;
        border-radius: 14px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        background: #27272a;
    }
    .upload-area:hover {
        border-color: #fbbf24;
        background: #27272a;
    }
    .upload-area img {
        max-width: 100%;
        max-height: 140px;
        border-radius: 10px;
        object-fit: cover;
    }
    .upload-area .upload-icon {
        color: #71717a;
        margin-bottom: 8px;
    }
    .upload-area .upload-text {
        font-size: 12px;
        color: #a1a1aa;
        margin-top: 4px;
    }
    .upload-area.has-image {
        padding: 12px;
    }
    .upload-area.has-image .upload-icon,
    .upload-area.has-image .upload-text {
        display: none;
    }
    .upload-btn-float {
        position: absolute;
        bottom: -14px;
        right: -14px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.35);
        transition: all 0.2s;
    }
    .upload-area:hover .upload-btn-float {
        transform: scale(1.1);
    }
    .upload-btn-float svg {
        width: 18px;
        height: 18px;
    }

    /* Profile Upload Circle - Dark */
    .profile-upload-circle {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 3px dashed #52525b;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        margin: 0 auto;
        position: relative;
        background: #27272a;
    }
    .profile-upload-circle:hover {
        border-color: #fbbf24;
        background: #27272a;
    }
    .profile-upload-circle img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }
    .profile-upload-circle .upload-hint {
        font-size: 11px;
        color: #71717a;
        margin-top: 6px;
    }
    .profile-upload-circle.has-image .upload-hint,
    .profile-upload-circle.has-image svg {
        display: none;
    }
    .profile-upload-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        border: 3px solid #18181b;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
        box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
    }
    .profile-upload-btn svg {
        width: 16px;
        height: 16px;
    }
    .profile-upload-btn.profile-btn-remove {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }
    .profile-upload-btn.profile-btn-remove:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #dc2626, #b91c1c);
    }

    /* Remove button for upload area */
    .upload-btn-remove {
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
    }
    .upload-btn-remove:hover {
        transform: scale(1.1) !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
    }

    /* Textarea with Emoji Picker - Dark */
    .textarea-wrapper {
        position: relative;
    }
    .textarea-about {
        width: 100%;
        border: 1.5px solid #3f3f46;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 14px;
        resize: none;
        transition: all 0.2s;
        min-height: 100px;
        background: #27272a;
        color: #fafafa;
    }
    .textarea-about:focus {
        border-color: #fbbf24;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }
    .textarea-about::placeholder {
        color: #71717a;
    }
    .emoji-picker-btn {
        position: absolute;
        bottom: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        background: #3f3f46;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #a1a1aa;
        transition: all 0.2s;
    }
    .emoji-picker-btn:hover {
        background: #52525b;
        color: #fbbf24;
    }

    /* Color Input - Dark */
    .color-input-row {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .color-swatch {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        border: 2px solid #3f3f46;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.2s;
    }
    .color-swatch:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
    .color-swatch input[type="color"] {
        position: absolute;
        width: 80px;
        height: 80px;
        left: -16px;
        top: -16px;
        cursor: pointer;
        opacity: 0;
    }
    .color-hex-input {
        flex: 1;
        padding: 12px 16px;
        border: 1.5px solid #3f3f46;
        border-radius: 10px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 14px;
        font-weight: 500;
        background: #27272a;
        color: #fafafa;
    }
    .color-hex-input:focus {
        border-color: #fbbf24;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    /* Social Pills - Dark */
    .social-platforms {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 14px;
    }
    .social-pill {
        padding: 8px 14px;
        border: 1.5px solid #3f3f46;
        border-radius: 24px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
        color: #a1a1aa;
        display: flex;
        align-items: center;
        gap: 6px;
        position: relative;
    }
    .social-pill:hover {
        border-color: #fbbf24;
        background: #27272a;
        color: #fbbf24;
    }
    .social-pill.active {
        border-color: #fbbf24;
        background: rgba(251, 191, 36, 0.1);
        color: #fbbf24;
    }
    .social-pill svg {
        width: 14px;
        height: 14px;
    }
    .social-pill .social-remove {
        display: none;
        width: 18px;
        height: 18px;
        border-radius: 999px;
        align-items: center;
        justify-content: center;
        margin: -2px -6px -2px 2px;
        color: #71717a;
        background: rgba(255, 255, 255, 0.55);
        transition: all 0.2s;
    }
    .social-pill.active .social-remove {
        display: inline-flex;
    }
    .social-pill .social-remove:hover {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.14);
    }
    .social-pill .social-remove svg {
        width: 12px;
        height: 12px;
    }
    .btn-add-social {
        padding: 8px 16px;
        border: 1.5px dashed #52525b;
        border-radius: 24px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
        color: #71717a;
    }
    .btn-add-social:hover {
        border-color: #fbbf24;
        color: #fbbf24;
        background: rgba(251, 191, 36, 0.05);
    }

    /* Template Grid - Dark */
    .template-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    .template-card {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.2s;
    }
    .template-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }
    .template-card.selected {
        border-color: #fbbf24;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
    }
    .template-card input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .template-card .template-preview {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .template-card .template-header {
        height: 45%;
    }
    .template-card .template-content {
        flex: 1;
        background: #27272a;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px;
    }
    .template-card .template-item {
        width: 28%;
        height: 50%;
        background: #3f3f46;
        border-radius: 4px;
    }
    .template-card .template-name {
        position: absolute;
        bottom: 6px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 9px;
        font-weight: 600;
        color: white;
        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        white-space: nowrap;
    }
    .template-card .template-check {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 22px;
        height: 22px;
        background: #fbbf24;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
    }
    .template-actions {
        margin-top: 16px;
        display: flex;
        justify-content: flex-end;
    }
    .template-clear-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1.5px solid #52525b;
        background: #27272a;
        color: #d4d4d8;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.2s;
    }
    .template-clear-btn:hover {
        border-color: #ef4444;
        color: #fecaca;
        background: rgba(239, 68, 68, 0.12);
    }
    .template-clear-btn svg {
        width: 16px;
        height: 16px;
    }

    /* Glow effect for neon/cyberpunk templates */
    .template-glow.selected {
        box-shadow: 0 0 15px rgba(57, 255, 20, 0.5), 0 0 0 3px rgba(251, 191, 36, 0.3);
    }

    /* Responsive Template Grid */
    @media (max-width: 768px) {
        .template-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Background Type Cards - Dark */
    .bg-type-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }
    .bg-type-card {
        position: relative;
        border: 2px solid #3f3f46;
        border-radius: 12px;
        padding: 14px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
    }
    .bg-type-card:hover {
        border-color: #fbbf24;
        transform: translateY(-2px);
    }
    .bg-type-card.selected {
        border-color: #fbbf24;
        background: rgba(251, 191, 36, 0.1);
    }
    .bg-type-card input {
        position: absolute;
        opacity: 0;
    }
    .bg-type-preview {
        height: 44px;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1px solid #3f3f46;
    }
    .bg-type-name {
        font-size: 11px;
        color: #a1a1aa;
        font-weight: 600;
    }
    .bg-type-card.selected .bg-type-name {
        color: #fbbf24;
    }
    .bg-image-remove {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 24px;
        height: 24px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(239, 68, 68, 0.92);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        z-index: 3;
        transition: all 0.2s;
    }
    .bg-image-remove:hover {
        background: #dc2626;
        transform: scale(1.05);
    }
    .bg-image-remove svg {
        width: 14px;
        height: 14px;
    }

    /* Button Style Cards - Dark */
    .button-style-section {
        margin-bottom: 20px;
    }
    .button-style-title {
        font-size: 12px;
        font-weight: 600;
        color: #a1a1aa;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .style-grid {
        display: flex;
        gap: 10px;
    }
    .style-card {
        flex: 1;
        position: relative;
        border: 2px solid #3f3f46;
        border-radius: 12px;
        padding: 14px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
    }
    .style-card:hover {
        border-color: #fbbf24;
    }
    .style-card.selected {
        border-color: #fbbf24;
        background: rgba(251, 191, 36, 0.1);
    }
    .style-card input {
        position: absolute;
        opacity: 0;
    }
    .style-preview {
        margin-bottom: 8px;
    }
    .style-btn-sample {
        display: inline-block;
        padding: 8px 16px;
        font-size: 11px;
        font-weight: 700;
    }
    .style-name {
        font-size: 11px;
        color: #a1a1aa;
        font-weight: 500;
    }
    .style-card.selected .style-name {
        color: #fbbf24;
    }

    /* Font Grid - Dark */
    .font-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }
    .font-card {
        position: relative;
        border: 2px solid #3f3f46;
        border-radius: 12px;
        padding: 14px 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #27272a;
    }
    .font-card:hover {
        border-color: #fbbf24;
        transform: translateY(-2px);
    }
    .font-card.selected {
        border-color: #fbbf24;
        background: rgba(251, 191, 36, 0.1);
    }
    .font-card input {
        position: absolute;
        opacity: 0;
    }
    .font-preview {
        font-size: 32px;
        line-height: 1;
        margin-bottom: 8px;
        color: #fafafa;
    }
    .font-name {
        font-size: 10px;
        color: #71717a;
        font-weight: 500;
    }
    .font-card.selected .font-name {
        color: #fbbf24;
    }

    /* CTA Section - Dark */
    .cta-section {
        background: #27272a;
        border-radius: 14px;
        padding: 16px;
        margin-top: 16px;
    }
    .cta-colors-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 12px;
    }
    .cta-color-item label {
        display: block;
        font-size: 12px;
        color: #a1a1aa;
        margin-bottom: 6px;
        font-weight: 500;
    }
    .cta-color-input {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cta-color-swatch {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 2px solid #3f3f46;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .cta-color-swatch input[type="color"] {
        position: absolute;
        width: 60px;
        height: 60px;
        left: -12px;
        top: -12px;
        cursor: pointer;
        opacity: 0;
    }
    .cta-color-hex {
        flex: 1;
        padding: 8px 12px;
        border: 1.5px solid #3f3f46;
        border-radius: 8px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        background: #18181b;
        color: #fafafa;
    }

    /* Save Button - Dark */
    .save-btn-container {
        position: sticky;
        bottom: 24px;
        z-index: 10;
    }
    .save-btn {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: black;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s;
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.35);
        border: none;
        cursor: pointer;
    }
    .save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(251, 191, 36, 0.45);
    }
    .save-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .appearance-page {
            flex-direction: column;
        }
        .appearance-form-col {
            max-width: 100%;
        }
        .appearance-preview-col {
            position: fixed;
            right: 16px;
            bottom: 80px;
            top: auto;
            width: 320px;
            z-index: 100;
        }
        .appearance-preview-frame {
            height: 420px;
            min-height: 420px;
        }
        .save-btn-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px;
            background: #09090b;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.3);
        }
    }

    /* Divider */
    .section-divider {
        height: 1px;
        background: #27272a;
        margin: 16px 0;
    }

    /* Label */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #d4d4d8;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Social Modal - Dark */
    #social-modal {
        background: rgba(0,0,0,0.7);
    }
    #social-modal > div {
        background: #18181b;
        border: 1px solid #3f3f46;
    }
    #social-modal h3 {
        color: #fafafa;
    }
    #social-modal input {
        background: #27272a;
        border-color: #3f3f46;
        color: #fafafa;
    }
    #social-modal input:focus {
        border-color: #fbbf24;
        outline: none;
    }
    #social-modal label {
        color: #d4d4d8;
    }
    #social-modal .flex.gap-3 button:first-child {
        background: #27272a;
        border-color: #3f3f46;
        color: #a1a1aa;
    }
    #social-modal .flex.gap-3 button:first-child:hover {
        background: #3f3f46;
    }
    #social-modal .flex.gap-3 button:last-child {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: black;
    }
    #social-modal .flex.gap-3 button:last-child:hover {
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }

    /* Pro Locked Message - Dark */
    .text-center.py-6 {
        background: #27272a;
        border-radius: 12px;
    }
    .text-center.py-6 svg {
        color: #52525b;
    }
    .text-center.py-6 p {
        color: #a1a1aa;
    }
    .text-center.py-6 a {
        background: linear-gradient(135deg, #a855f7, #9333ea);
    }
    .text-center.py-6 a:hover {
        box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
    }

    /* Text color fixes for theme */
    .text-xs.text-center.text-gray-600,
    .text-xs.text-center.text-zinc-500 {
        color: var(--text-muted) !important;
    }
    .text-xs.text-center.text-gray-400,
    .text-xs.text-center.text-zinc-400 {
        color: var(--text-muted) !important;
    }
    .text-sm.text-gray-500 {
        color: var(--text-secondary) !important;
    }
    .text-sm.text-gray-400 {
        color: var(--text-muted) !important;
    }
    .text-sm.text-gray-700 {
        color: var(--text-secondary) !important;
    }
    .text-zinc-400,
    .text-zinc-500 {
        color: var(--text-muted) !important;
    }
    .text-zinc-600 {
        color: var(--text-secondary) !important;
    }
</style>
@endpush

@section('content')
<div class="appearance-page">

    {{-- Left Column: Form --}}
    <div class="appearance-form-col">

        {{-- Header Bar --}}
        <div class="page-header">
            <div class="page-url">
                <span class="page-url-label">My EtalaseKu:</span>
                <span class="page-url-value">
                    <span>{{ str_replace('http://', '', str_replace('https://', '', config('app.url'))) }}/</span>{{ $store->username }}
                </span>
            </div>
            <div class="page-header-actions">
                <button class="btn-action btn-share" onclick="copyLink()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    Share
                </button>
                <button class="btn-action btn-customize">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Customize URL
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('seller.appearance.update') }}" enctype="multipart/form-data" id="appearance-form">
            @csrf
            @method('PATCH')
            <input type="hidden" name="banner" id="banner-value" value="{{ $store->banner }}">
            <input type="hidden" name="profile_image" id="profile-value" value="{{ $store->profile_image }}">
            <input type="hidden" name="header_gradient_end" value="{{ $store->header_gradient_end ?? '#4338CA' }}">
            <input type="hidden" name="background_gradient_start" value="{{ $store->background_gradient_start ?? $store->header_gradient_start ?? '#4F46E5' }}">
            <input type="hidden" name="background_gradient_end" value="{{ $store->background_gradient_end ?? $store->background_color ?? '#FFFFFF' }}">
            <input type="hidden" name="background_image" id="background-image-value" value="{{ $store->background_image }}">
            <input type="hidden" name="background_remove" id="background-remove" value="0">
            <input type="hidden" name="template" id="template-empty-value" value="">

            {{-- Page Style Section --}}
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        Page Style
                    </h3>
                </div>

                <div class="form-label">
                    Layout
                    @unless($store->isPro())
                        <span class="badge-pro">PRO</span>
                    @endunless
                </div>
                <p class="section-desc">This change will affect your product detail page as well</p>

                <div class="visual-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <label class="visual-card {{ ($store->layout ?? 'modern') === 'classic' ? 'selected' : '' }}">
                        <input type="radio" name="layout" value="classic" {{ ($store->layout ?? 'modern') === 'classic' ? 'checked' : '' }}>
                        <div class="layout-preview">
                            <div class="banner"></div>
                            <div class="avatar"></div>
                        </div>
                        <p class="text-xs text-center text-zinc-400 font-medium">Classic</p>
                        <p class="text-xs text-center text-zinc-500 mt-1">Avatar below banner</p>
                    </label>
                    <label class="visual-card {{ ($store->layout ?? 'modern') === 'modern' ? 'selected' : '' }}">
                        <input type="radio" name="layout" value="modern" {{ ($store->layout ?? 'modern') === 'modern' ? 'checked' : '' }}>
                        <div class="layout-preview modern-preview">
                            <div class="modern-profile-row">
                                <div class="avatar"></div>
                                <div class="name-bar"></div>
                            </div>
                            <div class="cta-bar"></div>
                        </div>
                        <p class="text-xs text-center text-zinc-400 font-medium">Modern</p>
                        <p class="text-xs text-center text-zinc-500 mt-1">Without top bar</p>
                    </label>
                    <label class="visual-card {{ $store->layout === 'clean' ? 'selected' : '' }} {{ !$store->isPro() ? 'pro-locked' : '' }}">
                        @if(!$store->isPro())
                            <div class="pro-overlay">
                                <div class="pro-icon">P</div>
                                <span class="text-xs font-medium text-zinc-400">PRO</span>
                            </div>
                        @endif
                        <input type="radio" name="layout" value="clean" {{ $store->layout === 'clean' ? 'checked' : '' }}>
                        <div class="layout-preview clean-preview">
                            <div class="name-bar"></div>
                        </div>
                        <p class="text-xs text-center text-zinc-400 font-medium">Clean</p>
                        <p class="text-xs text-center text-zinc-500 mt-1">No profile picture</p>
                    </label>
                </div>
            </div>

            {{-- Banner & Profile Section --}}
            <div class="section-card">
                <h3 class="section-title" style="margin-bottom: 20px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Banner & Profile Image
                </h3>

                <div class="upload-grid">
                    {{-- Banner Upload --}}
                    <div>
                        <p class="form-label">Banner</p>
                        <div class="upload-area {{ $store->banner ? 'has-image' : '' }}" id="banner-upload-area">
                            @if($store->banner)
                                <img src="{{ $store->banner }}" alt="Banner" id="banner-preview">
                            @else
                                <svg class="w-12 h-12 mx-auto upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="upload-text">Optimize banner size 1200 x 628 px</p>
                            @endif
                            <input type="file" id="banner-input" name="banner_file" accept="image/*" class="hidden" onchange="handleBannerUpload(this)">
                            <input type="hidden" id="banner-remove" name="banner_remove" value="0">
                            @if($store->banner)
                                <button type="button" class="upload-btn-float upload-btn-remove" onclick="removeBanner(event)">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @else
                                <button type="button" class="upload-btn-float" onclick="event.stopPropagation(); document.getElementById('banner-input').click();">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Profile Upload --}}
                    <div class="flex flex-col items-center justify-center">
                        <p class="form-label" style="text-align: center; width: 100%;">Profile Image</p>
                        <div class="profile-upload-circle {{ $store->profile_image ? 'has-image' : '' }}" id="profile-upload-circle">
                            @if($store->profile_image)
                                <img src="{{ $store->profile_image }}" alt="Profile" id="profile-preview">
                                <button type="button" class="profile-upload-btn profile-btn-remove" onclick="removeProfile(event)">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @else
                                <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="upload-hint">Upload</span>
                            @endif
                            <input type="hidden" id="profile-remove" name="profile_remove" value="0">
                            <input type="file" id="profile-input" name="profile_file" accept="image/*" class="hidden" onchange="handleProfileUpload(this)">
                        </div>
                    </div>
                </div>
            </div>

            {{-- About Section --}}
            <div class="section-card">
                <h3 class="section-title" style="margin-bottom: 16px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    About
                </h3>
                <div class="textarea-wrapper">
                    <textarea name="about_text" rows="3" class="textarea-about" placeholder="I'm a Content Creator...">{{ $store->about_text }}</textarea>
                    <button type="button" class="emoji-picker-btn" title="Add emoji">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Color Section --}}
            <div class="section-card">
                <h3 class="section-title" style="margin-bottom: 16px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    Color
                </h3>
                <div class="color-input-row">
                    <div class="color-swatch" style="background-color: {{ $store->header_gradient_start ?? '#4F46E5' }}">
                        <input type="color" value="{{ $store->header_gradient_start ?? '#4F46E5' }}" onchange="updatePrimaryColor(this)">
                    </div>
                    <input type="text" name="header_gradient_start" value="{{ $store->header_gradient_start ?? '#4F46E5' }}" class="color-hex-input" onchange="syncColorSwatch(this)">
                </div>
            </div>

            {{-- Social Links Section --}}
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        Social Links
                    </h3>
                    @unless($store->isPro())
                        <span class="badge-pro">PRO</span>
                    @endunless
                </div>

                @if($store->isPro())
                    {{-- Hidden inputs for social links --}}
                    @php
                        $socialFields = ['telegram', 'website', 'email', 'discord', 'tiktok', 'instagram', 'youtube', 'twitch', 'linkedin', 'x', 'facebook', 'behance', 'dribbble', 'whatsapp', 'spotify', 'threads'];
                    @endphp
                    @foreach($socialFields as $field)
                        <input type="hidden" name="social_{{ $field }}" value="{{ $store->{'social_' . $field} ?? '' }}">
                    @endforeach

                    <div class="social-platforms">
                        @php
                            $socials = [
                                ['key' => 'telegram', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>'],
                                ['key' => 'website', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>'],
                                ['key' => 'email', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>'],
                                ['key' => 'discord', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>'],
                                ['key' => 'tiktok', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>'],
                                ['key' => 'instagram', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073 1.689.073 4.948 0 3.259-.014 3.667-.072 4.947-.196 4.354-2.617 6.78-6.979 6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>'],
                                ['key' => 'youtube', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>'],
                                ['key' => 'twitch', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.571 4.714h1.715v5.143H11.57zm4.715 0H18v5.143h-1.714zM6 0L1.714 4.286v15.428h5.143V24l4.286-4.286h3.428L22.286 12V0zm14.571 11.143l-3.428 3.428h-3.429l-3 3v-3H6.857V1.714h13.714z"/></svg>'],
                                ['key' => 'linkedin', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>'],
                                ['key' => 'x', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'],
                                ['key' => 'facebook', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'],
                                ['key' => 'behance', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-5.101 3-3.074 0-5.564-1.729-5.564-5.675 0-3.91 2.325-5.92 5.466-5.92 3.082 0 4.964 1.782 5.375 4.426.078.506.109 1.188.095 2.14H15.97c.13 3.211 3.483 3.312 4.588 2.029h3.168zm-7.686-4h4.965c-.105-1.547-1.136-2.219-2.477-2.219-1.466 0-2.277.768-2.488 2.219zm-9.574 6.988H0V5.021h6.953c5.476.081 5.58 5.444 2.72 6.906 3.461 1.26 3.577 8.061-3.207 8.061zM3 11h3.584c2.508 0 2.906-3-.312-3H3v3zm3.391 3H3v3.016h3.341c3.055 0 2.868-3.016.05-3.016z"/></svg>'],
                                ['key' => 'dribbble', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 24C5.385 24 0 18.615 0 12S5.385 0 12 0s12 5.385 12 12-5.385 12-12 12zm10.12-10.358c-.35-.11-3.17-.953-6.384-.438 1.34 3.684 1.887 6.684 1.992 7.308 2.3-1.555 3.936-4.02 4.395-6.87zm-6.115 7.808c-.153-.9-.75-4.032-2.19-7.77l-.066.02c-5.79 2.015-7.86 6.025-8.04 6.4 1.73 1.358 3.92 2.166 6.29 2.166 1.42 0 2.77-.29 4-.814zm-11.62-2.58c.232-.4 3.045-5.055 8.332-6.765.135-.045.27-.084.405-.12-.26-.585-.54-1.167-.832-1.74C7.17 11.775 2.206 11.71 1.756 11.7l-.004.312c0 2.633.998 5.037 2.634 6.855zm-2.42-8.955c.46.008 4.683.026 9.477-1.248-1.698-3.018-3.53-5.558-3.8-5.928-2.868 1.35-5.01 3.99-5.676 7.17zM9.6 2.052c.282.38 2.145 2.914 3.822 6 3.645-1.365 5.19-3.44 5.373-3.702-1.81-1.61-4.19-2.586-6.795-2.586-.477 0-.945.04-1.4.113zm10.335 3.483c-.218.29-1.935 2.493-5.724 4.04.24.49.47.985.68 1.486.08.18.15.36.22.53 3.41-.43 6.8.26 7.14.33-.02-2.42-.88-4.64-2.31-6.38z"/></svg>'],
                                ['key' => 'whatsapp', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>'],
                                ['key' => 'spotify', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>'],
                                ['key' => 'threads', 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.16 3.472 10.28l1.228.29c.088-1.275.398-2.35.93-3.193.863-1.373 2.372-2.058 4.498-2.05 2.09 0 3.69.676 4.76 2.005.985 1.22 1.319 2.91 1.023 4.904-.44 2.903-2.004 5.05-4.64 6.378-2.14 1.076-4.77.996-7.502-.218a8.451 8.451 0 0 1-3.11-2.389c.392-.457.892-.791 1.493-1.001.3-.106.65-.178 1.05-.217 1.32-1.01 2.96-1.366 4.6-.995 1.396.316 2.457 1.013 3.154 2.07.574.87.864 1.888.862 3.026l1.875-.528c.063-.48.096-.965.096-1.45 0-.52-.034-1.01-.098-1.469l1.298.31c0 .014-.001.028-.003.042 0 1.772.453 3.355 1.345 4.694.91 1.37 2.268 2.467 4.027 3.25a11.62 11.62 0 0 0 3.57.92l.038-.096c-3.32-.86-5.755-2.928-6.64-5.63-.423-1.29-.45-2.707-.074-4.12.44-1.657 1.36-3.038 2.74-4.097 1.41-1.083 3.25-1.677 5.45-1.758.4-.015.8-.002 1.19.038 2.08.21 3.83.96 5.19 2.22a9.92 9.92 0 0 1 2.86 4.9l1.82-.59c-.33-2.11-1.11-3.96-2.34-5.5-1.27-1.6-2.98-2.83-5.09-3.65-.72-.28-1.46-.5-2.23-.65-.42-.08-.85-.14-1.28-.18-.04-.005-.08-.01-.12-.014-.04-.003-.08-.006-.12-.01s-.08-.004-.12-.005-.08-.002-.12-.001-.08-.001-.12-.001z"/></svg>'],
                            ];
                        @endphp
                        @foreach($socials as $social)
                            <button type="button" class="social-pill {{ $store->{'social_' . $social['key']} ? 'active' : '' }}" data-platform="{{ $social['key'] }}" onclick="toggleSocialPill(this)">
                                {!! $social['icon'] !!}
                                {{ ucfirst($social['key']) }}
                                <span class="social-remove" onclick="removeSocialLink(event, '{{ $social['key'] }}')" title="Hapus {{ ucfirst($social['key']) }}" aria-label="Hapus {{ ucfirst($social['key']) }}">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <button type="button" class="btn-add-social" onclick="showAddSocialModal()">
                        + Add Social Link
                    </button>

                    <!-- Social Link Modal -->
                    <div id="social-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
                        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold" id="social-modal-title">Add Social Link</h3>
                                <button type="button" onclick="closeSocialModal()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2" id="social-modal-label">URL or Username</label>
                                <input type="text" id="social-modal-input" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://...">
                            </div>
                            <div class="flex gap-3">
                                <button type="button" onclick="closeSocialModal()" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                                <button type="button" onclick="saveSocialLink()" class="flex-1 px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="w-12 h-12 mx-auto text-zinc-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <p class="text-sm text-zinc-400">Upgrade to PRO to add social links</p>
                        <a href="{{ route('seller.upgrade') }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-sm font-semibold rounded-lg hover:from-purple-600 hover:to-pink-600 transition">
                            Upgrade Now
                        </a>
                    </div>
                @endif
            </div>

            {{-- Template Section --}}
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        Template
                    </h3>
                </div>
                <p class="section-desc">Pilih template untuk mengatur warna dan gaya halaman toko Anda secara otomatis.</p>

                {{-- Template Grid with Visual Preview --}}
                <div class="template-grid" id="template-grid">
                    @php
                    $currentTemplate = $store->template;
                    @endphp
                    @foreach($templatePresets as $key => $preset)
                        @php
                            $isSelected = $currentTemplate === $key;
                            $bgStyle = '';
                            $headerStyle = "background: linear-gradient(135deg, {$preset['header_gradient_start']}, {$preset['header_gradient_end']});";

                            if ($preset['bg_secondary'] && $preset['bg_gradient_direction']) {
                                $dir = match($preset['bg_gradient_direction']) {
                                    'to bottom' => '180deg',
                                    'to top' => '0deg',
                                    'to right' => '90deg',
                                    '135deg' => '135deg',
                                    default => '180deg',
                                };
                                $bgStyle = "background: linear-gradient({$dir}, {$preset['bg_color']}, {$preset['bg_secondary']});";
                            } else {
                                $bgStyle = "background-color: {$preset['bg_color']};";
                            }

                            // Special class for glow effects
                            $cardClass = '';
                            if ($preset['special_class'] === 'glow-neon' || $preset['special_class'] === 'glow-cyberpunk') {
                                $cardClass = 'template-glow';
                            }
                        @endphp
                        <label class="template-card {{ $isSelected ? 'selected' : '' }} {{ $cardClass }}"
                               data-template="{{ $key }}"
                               data-bg-color="{{ $preset['bg_color'] }}"
                               data-bg-secondary="{{ $preset['bg_secondary'] ?? '' }}"
                               data-bg-direction="{{ $preset['bg_gradient_direction'] ?? '' }}"
                               data-btn-color="{{ $preset['button_color'] }}"
                               data-text-color="{{ $preset['text_color'] }}"
                               data-header-start="{{ $preset['header_gradient_start'] }}"
                               data-header-end="{{ $preset['header_gradient_end'] }}"
                               data-special="{{ $preset['special_class'] ?? '' }}"
                               onclick="selectTemplate(this)">
                            <input type="radio" name="template" value="{{ $key }}" {{ $isSelected ? 'checked' : '' }}>
                            <div class="template-preview" style="{{ $bgStyle }}">
                                <div class="template-header" style="{{ $headerStyle }};"></div>
                                <div class="template-content" @if($preset['bg_color'] !== '#FFFFFF' && $preset['bg_color'] !== '#f9fafc') style="background: rgba(255,255,255,0.9);" @endif>
                                    <div class="template-item" @if(isset($preset['card_bg']) && $preset['card_bg'] !== '#FFFFFF') style="background: {{ $preset['card_bg'] }};" @endif></div>
                                    <div class="template-item" @if(isset($preset['card_bg']) && $preset['card_bg'] !== '#FFFFFF') style="background: {{ $preset['card_bg'] }};" @endif></div>
                                    <div class="template-item" @if(isset($preset['card_bg']) && $preset['card_bg'] !== '#FFFFFF') style="background: {{ $preset['card_bg'] }};" @endif></div>
                                </div>
                            </div>
                            <span class="template-name">{{ $preset['name'] }}</span>
                            @if($isSelected)
                                <div class="template-check">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            @endif
                        </label>
                    @endforeach
                </div>
                <div class="template-actions">
                    <button type="button" class="template-clear-btn" onclick="clearTemplateSelection()">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batalkan Template
                    </button>
                </div>
            </div>

            {{-- Custom Appearance Section --}}
            <div class="section-card">
                <h3 class="section-title" style="margin-bottom: 6px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Custom Appearance
                </h3>
                <p class="section-desc">Completely customize your profile with your own colors, fonts, and styles.</p>

                <div class="section-divider"></div>

                {{-- Background --}}
                <div class="mb-5">
                    <div class="form-label">Background</div>
                    <div class="bg-type-grid">
                        <label class="bg-type-card {{ ($store->background_type ?? 'flat') === 'flat' ? 'selected' : '' }}">
                            <input type="radio" name="background_type" value="flat" {{ ($store->background_type ?? 'flat') === 'flat' ? 'checked' : '' }}>
                            <div class="bg-type-preview" style="background-color: {{ $store->background_color ?? '#FFFFFF' }};"></div>
                            <p class="bg-type-name">Flat Color</p>
                        </label>
                        <label class="bg-type-card {{ $store->background_type === 'gradient_up' ? 'selected' : '' }} {{ !$store->isPro() ? 'pro-locked' : '' }}">
                            @if(!$store->isPro())
                                <span class="badge-pro" style="position: absolute; top: 6px; right: 6px; font-size: 8px; padding: 2px 5px;">PRO</span>
                            @endif
                            <input type="radio" name="background_type" value="gradient_up" {{ $store->background_type === 'gradient_up' ? 'checked' : '' }}>
                            <div class="bg-type-preview" style="background: linear-gradient(180deg, {{ $store->header_gradient_start ?? '#4F46E5' }}22, {{ $store->background_color ?? '#FFFFFF' }});"></div>
                            <p class="bg-type-name">Gradient Up</p>
                        </label>
                        <label class="bg-type-card {{ $store->background_type === 'gradient_down' ? 'selected' : '' }} {{ !$store->isPro() ? 'pro-locked' : '' }}">
                            @if(!$store->isPro())
                                <span class="badge-pro" style="position: absolute; top: 6px; right: 6px; font-size: 8px; padding: 2px 5px;">PRO</span>
                            @endif
                            <input type="radio" name="background_type" value="gradient_down" {{ $store->background_type === 'gradient_down' ? 'checked' : '' }}>
                            <div class="bg-type-preview" style="background: linear-gradient(0deg, {{ $store->header_gradient_start ?? '#4F46E5' }}22, {{ $store->background_color ?? '#FFFFFF' }});"></div>
                            <p class="bg-type-name">Gradient Down</p>
                        </label>
                        <label class="bg-type-card {{ $store->background_type === 'image' ? 'selected' : '' }} {{ !$store->isPro() ? 'pro-locked' : '' }}" onclick="openBackgroundImagePicker(event)">
                            @if(!$store->isPro())
                                <span class="badge-pro" style="position: absolute; top: 6px; right: 6px; font-size: 8px; padding: 2px 5px;">PRO</span>
                            @endif
                            @if($store->background_image)
                                <button type="button" class="bg-image-remove" onclick="removeBackgroundImage(event)" title="Hapus background image" aria-label="Hapus background image">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @endif
                            <input type="radio" name="background_type" value="image" {{ $store->background_type === 'image' ? 'checked' : '' }}>
                            <div id="background-image-preview" class="bg-type-preview bg-gray-100 flex items-center justify-center" @if($store->background_image) style="background-image: url('{{ $store->background_image }}'); background-size: cover; background-position: center;" @endif>
                                @unless($store->background_image)
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endunless
                            </div>
                            <p class="bg-type-name">Upload Image</p>
                        </label>
                    </div>
                    <input type="file" id="background-image-input" name="background_file" accept="image/*" class="hidden" onchange="handleBackgroundImageUpload(this)">
                    <div class="color-input-row" style="margin-top: 12px;">
                        <div class="color-swatch" style="background-color: {{ $store->background_color ?? '#FFFFFF' }};">
                            <input type="color" value="{{ $store->background_color ?? '#FFFFFF' }}" onchange="updateBgColor(this)">
                        </div>
                        <input type="text" name="background_color" value="{{ $store->background_color ?? '#FFFFFF' }}" class="color-hex-input" onchange="syncBgColorSwatch(this)">
                        <span class="text-sm text-zinc-400" style="white-space: nowrap;">Background Color</span>
                    </div>
                </div>

                <div class="section-divider"></div>

                {{-- Buttons --}}
                <div class="button-style-section">
                    <div class="form-label">Buttons</div>

                    @if($store->isPro())
                        {{-- Hard Shadow --}}
                        <div class="button-style-title">Hard Shadow</div>
                        <div class="style-grid">
                            <label class="style-card {{ $store->cta_button_shape === 'sharp-hard' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="sharp-hard" {{ $store->cta_button_shape === 'sharp-hard' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 0; box-shadow: 4px 4px 0 #1e293b; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</div>
                                </div>
                                <p class="style-name">Square</p>
                            </label>
                            <label class="style-card {{ ($store->cta_button_shape ?? 'rounded-hard') === 'rounded-hard' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="rounded-hard" {{ ($store->cta_button_shape ?? 'rounded-hard') === 'rounded-hard' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 10px; box-shadow: 4px 4px 0 #1e293b; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</div>
                                </div>
                                <p class="style-name">Rounded</p>
                            </label>
                            <label class="style-card {{ $store->cta_button_shape === 'pill-hard' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="pill-hard" {{ $store->cta_button_shape === 'pill-hard' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 50px; box-shadow: 4px 4px 0 #1e293b; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</div>
                                </div>
                                <p class="style-name">Pill</p>
                            </label>
                        </div>

                        {{-- Soft Shadow --}}
                        <div class="button-style-title" style="margin-top: 16px;">Soft Shadow</div>
                        <div class="style-grid">
                            <label class="style-card {{ $store->cta_button_shape === 'square-soft' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="square-soft" {{ $store->cta_button_shape === 'square-soft' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 0; box-shadow: 0 4px 14px rgba(0,0,0,0.2); background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</div>
                                </div>
                                <p class="style-name">Square</p>
                            </label>
                            <label class="style-card {{ $store->cta_button_shape === 'rounded-soft' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="rounded-soft" {{ $store->cta_button_shape === 'rounded-soft' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 10px; box-shadow: 0 4px 14px rgba(0,0,0,0.2); background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</div>
                                </div>
                                <p class="style-name">Rounded</p>
                            </label>
                            <label class="style-card {{ $store->cta_button_shape === 'rainbow' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="rainbow" {{ $store->cta_button_shape === 'rainbow' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 10px; background: linear-gradient(90deg, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #8b00ff); padding: 2px;">
                                        <span style="background: {{ $store->cta_button_color ?? '#4F46E5' }}; display: block; border-radius: 8px; color: {{ $store->cta_button_text_color ?? '#FFF' }};">CTA</span>
                                    </div>
                                </div>
                                <p class="style-name">Rainbow</p>
                            </label>
                        </div>

                        {{-- Special --}}
                        <div class="button-style-title" style="margin-top: 16px;">Special</div>
                        <div class="style-grid">
                            <label class="style-card {{ $store->cta_button_shape === 'bracket' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="bracket" {{ $store->cta_button_shape === 'bracket' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }};">
                                        <span style="opacity: 0.5;">&lt;</span>CTA<span style="opacity: 0.5;">&gt;</span>
                                    </div>
                                </div>
                                <p class="style-name">Bracket</p>
                            </label>
                            <label class="style-card {{ $store->cta_button_shape === 'scribble' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="scribble" {{ $store->cta_button_shape === 'scribble' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }}; position: relative;">
                                        CTA
                                        <span style="position: absolute; bottom: 3px; left: 10%; width: 80%; height: 2px; background: currentColor; opacity: 0.4; transform: rotate(-2deg);"></span>
                                    </div>
                                </div>
                                <p class="style-name">Scribble</p>
                            </label>
                        </div>

                        {{-- Color Inputs --}}
                        <div class="cta-colors-grid" style="margin-top: 16px;">
                            <div class="cta-color-item">
                                <label>Button Color</label>
                                <div class="cta-color-input">
                                    <div class="cta-color-swatch" style="background-color: {{ $store->cta_button_color ?? '#4F46E5' }};">
                                        <input type="color" value="{{ $store->cta_button_color ?? '#4F46E5' }}" oninput="updateCtaColor(this)" onchange="updateCtaColor(this)">
                                    </div>
                                    <input type="text" name="cta_button_color" value="{{ $store->cta_button_color ?? '#4F46E5' }}" class="cta-color-hex" oninput="syncCtaColorText(this)">
                                </div>
                            </div>
                            <div class="cta-color-item">
                                <label>Text Color</label>
                                <div class="cta-color-input">
                                    <div class="cta-color-swatch" style="background-color: {{ $store->cta_button_text_color ?? '#FFFFFF' }};">
                                        <input type="color" value="{{ $store->cta_button_text_color ?? '#FFFFFF' }}" oninput="updateCtaTextColor(this)" onchange="updateCtaTextColor(this)">
                                    </div>
                                    <input type="text" name="cta_button_text_color" value="{{ $store->cta_button_text_color ?? '#FFFFFF' }}" class="cta-color-hex" oninput="syncCtaTextColorText(this)">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg class="w-10 h-10 mx-auto text-zinc-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <p class="text-sm text-zinc-400">Upgrade to PRO to customize buttons</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Fonts Section --}}
            <div class="section-card">
                <h3 class="section-title" style="margin-bottom: 16px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
                    </svg>
                    Font
                </h3>
                <div class="font-grid">
                    @php
                        $fontList = [
                            ['key' => 'Helvetica', 'name' => 'Helvetica', 'family' => 'Helvetica, sans-serif'],
                            ['key' => 'Lato', 'name' => 'Lato', 'family' => "'Lato', sans-serif"],
                            ['key' => 'Letter Gothic Std', 'name' => 'Letter Gothic', 'family' => "'Courier New', monospace"],
                            ['key' => 'Raleway', 'name' => 'Raleway', 'family' => "'Raleway', sans-serif"],
                            ['key' => 'Montserrat', 'name' => 'Montserrat', 'family' => "'Montserrat', sans-serif"],
                            ['key' => 'Roboto', 'name' => 'Roboto', 'family' => "'Roboto', sans-serif"],
                            ['key' => 'Poppins', 'name' => 'Poppins', 'family' => "'Poppins', sans-serif"],
                            ['key' => 'Playfair Display', 'name' => 'Playfair', 'family' => "'Playfair Display', serif"],
                            ['key' => 'Bodoni MT', 'name' => 'Bodoni MT', 'family' => "'Bodoni MT', serif"],
                            ['key' => 'JetBrains Mono', 'name' => 'Digi', 'family' => "'JetBrains Mono', monospace"],
                            ['key' => 'Great Vibes', 'name' => 'Fancy Script', 'family' => "'Great Vibes', cursive"],
                            ['key' => 'East Sea Dokdo', 'name' => 'East', 'family' => "'East Sea Dokdo', cursive"],
                            ['key' => 'Satisfy', 'name' => 'Aesthetic', 'family' => "'Satisfy', cursive"],
                            ['key' => 'Fredoka', 'name' => 'Fredoka', 'family' => "'Fredoka', sans-serif"],
                            ['key' => 'Roboto Mono', 'name' => 'Sul', 'family' => "'Roboto Mono', monospace"],
                            ['key' => 'Inter', 'name' => 'Cartoon', 'family' => "'Inter', sans-serif"],
                        ];
                    @endphp
                    @foreach($fontList as $font)
                        <label class="font-card {{ ($store->font_family ?? 'Inter') === $font['key'] ? 'selected' : '' }}" style="font-family: {{ $font['family'] }};">
                            <input type="radio" name="font_family" value="{{ $font['key'] }}" {{ ($store->font_family ?? 'Inter') === $font['key'] ? 'checked' : '' }}>
                            <div class="font-preview">Aa</div>
                            <div class="font-name">{{ $font['name'] }}</div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- CTA & Purchase Button Section --}}
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                        </svg>
                        CTA & Purchase Button Style
                    </h3>
                    @unless($store->isPro())
                        <span class="badge-pro">PRO</span>
                    @endunless
                </div>
                <p class="section-desc">Customize the appearance of your Call-to-Action and purchase buttons.</p>

                @if($store->isPro())
                    <div class="mb-4">
                        <div class="form-label">Button Style</div>
                        <div class="style-grid" style="grid-template-columns: 1fr 1fr;">
                            <label class="style-card {{ ($store->cta_button_style ?? 'fill') === 'fill' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_style" value="fill" {{ ($store->cta_button_style ?? 'fill') === 'fill' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }}; border: none;">Fill Color</div>
                                </div>
                                <p class="style-name">Fill Color</p>
                            </label>
                            <label class="style-card {{ $store->cta_button_style === 'outline' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_style" value="outline" {{ $store->cta_button_style === 'outline' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="background: transparent; color: {{ $store->cta_button_color ?? '#4F46E5' }}; border: 2px solid {{ $store->cta_button_color ?? '#4F46E5' }};">Outline</div>
                                </div>
                                <p class="style-name">Outline Color</p>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-label">Button Shape</div>
                        <div class="style-grid">
                            <label class="style-card {{ ($store->cta_button_shape ?? 'rounded') === 'rounded' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="rounded" {{ ($store->cta_button_shape ?? 'rounded') === 'rounded' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 10px; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }}; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">CTA</div>
                                </div>
                                <p class="style-name">Rounded</p>
                            </label>
                            <label class="style-card {{ ($store->cta_button_shape ?? '') === 'sharp' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="sharp" {{ ($store->cta_button_shape ?? '') === 'sharp' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 4px; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }}; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">CTA</div>
                                </div>
                                <p class="style-name">Square</p>
                            </label>
                            <label class="style-card {{ ($store->cta_button_shape ?? '') === 'pill' ? 'selected' : '' }}">
                                <input type="radio" name="cta_button_shape" value="pill" {{ ($store->cta_button_shape ?? '') === 'pill' ? 'checked' : '' }}>
                                <div class="style-preview">
                                    <div class="style-btn-sample" style="border-radius: 50px; background: {{ $store->cta_button_color ?? '#4F46E5' }}; color: {{ $store->cta_button_text_color ?? '#FFF' }}; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">CTA</div>
                                </div>
                                <p class="style-name">Pill</p>
                            </label>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <div class="toggle-row" style="padding-top: 0;">
                        <span class="toggle-label">Apply soft shadow</span>
                        <div class="toggle-switch {{ $store->cta_button_shadow ? 'active' : '' }}" onclick="toggleSoftShadow(this)">
                            <input type="hidden" name="cta_button_shadow" value="{{ $store->cta_button_shadow ? 1 : 0 }}">
                        </div>
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="w-10 h-10 mx-auto text-zinc-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <p class="text-sm text-zinc-400">Upgrade to PRO for CTA customization</p>
                    </div>
                @endif
            </div>

            {{-- Save Button --}}
            <div class="save-btn-container">
                <button type="submit" class="save-btn" id="save-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    {{-- Right Column: Live Preview --}}
    <div class="appearance-preview-col">
        <div class="appearance-preview-card">
            <div class="appearance-preview-header">
                <h2 class="appearance-preview-title">Preview</h2>
                <button type="button" class="appearance-preview-refresh" id="refresh-preview-btn" onclick="refreshLivePreview()" title="Refresh Preview">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </button>
            </div>
            <div class="appearance-preview-frame">
                <iframe
                    id="live-preview-iframe"
                    src="{{ $store->public_url }}?preview=1&_={{ time() }}"
                    class="appearance-preview-iframe"
                ></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const csrfToken = '{{ csrf_token() }}';
    const previewUrl = '{{ route("seller.appearance.preview-save") }}';
    const storeUrl = '{{ $store->public_url }}';

    // Debounce helper
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function setPreviewRefreshing(isRefreshing) {
        const refreshBtn = document.getElementById('refresh-preview-btn');
        if (refreshBtn) {
            refreshBtn.classList.toggle('is-refreshing', isRefreshing);
        }
    }

    function refreshLivePreview() {
        const iframe = document.getElementById('live-preview-iframe');
        if (!iframe) return;

        setPreviewRefreshing(true);
        iframe.src = `${storeUrl}?preview=1&_=${Date.now()}`;
        setTimeout(() => setPreviewRefreshing(false), 1000);
    }

    const savePreview = debounce(function() {
        const form = document.getElementById('appearance-form');
        if (!form) return;

        const formData = new FormData(form);
        formData.delete('_method');

        fetch(previewUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Preview request failed');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                refreshLivePreview();
            }
        })
        .catch(err => console.error(err));
    }, 600);

    // Copy link function
    function copyLink() {
        navigator.clipboard.writeText('{{ $store->public_url }}').then(() => {
            // Create toast notification
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center gap-2';
            toast.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Link disalin!';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
        });
    }

    // Toggle soft shadow
    function toggleSoftShadow(el) {
        el.classList.toggle('active');
        const input = el.querySelector('input');
        input.value = el.classList.contains('active') ? 1 : 0;
        savePreview();
    }

    // Template selection handler
    function selectTemplate(card) {
        const templateKey = card.dataset.template;
        const bgColor = card.dataset.bgColor;
        const bgSecondary = card.dataset.bgSecondary;
        const bgDirection = card.dataset.bgDirection;
        const btnColor = card.dataset.btnColor;
        const textColor = card.dataset.textColor;
        const headerStart = card.dataset.headerStart;
        const headerEnd = card.dataset.headerEnd;
        const specialClass = card.dataset.special;

        // Update form input
        const input = card.querySelector('input[type="radio"]');
        input.checked = true;

        // Update visual selection
        document.querySelectorAll('.template-card').forEach(c => {
            c.classList.remove('selected');
            const check = c.querySelector('.template-check');
            if (check) check.remove();
        });
        card.classList.add('selected');

        // Add checkmark
        if (!card.querySelector('.template-check')) {
            const checkDiv = document.createElement('div');
            checkDiv.className = 'template-check';
            checkDiv.innerHTML = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
            card.appendChild(checkDiv);
        }

        // Update color inputs based on template
        updateFormColors({
            bgColor,
            bgSecondary,
            bgDirection,
            btnColor,
            textColor,
            headerStart,
            headerEnd
        });

        // Trigger live preview
        savePreview();
    }

    function clearTemplateSelection() {
        document.querySelectorAll('.template-card').forEach(card => {
            card.classList.remove('selected');
            const check = card.querySelector('.template-check');
            if (check) check.remove();
        });

        document.querySelectorAll('input[name="template"][type="radio"]').forEach(input => {
            input.checked = false;
        });

        const templateEmptyInput = document.getElementById('template-empty-value');
        if (templateEmptyInput) templateEmptyInput.value = '';

        savePreview();
    }

    // Update form color inputs when template is selected
    function updateFormColors(colors) {
        // Update background color
        const bgColorInput = document.querySelector('input[name="background_color"]');
        if (bgColorInput && colors.bgColor) {
            bgColorInput.value = colors.bgColor;
            const bgSwatch = bgColorInput.closest('.color-input-row')?.querySelector('.color-swatch');
            if (bgSwatch) bgSwatch.style.backgroundColor = colors.bgColor;
        }

        const bgGradientStartInput = document.querySelector('input[name="background_gradient_start"]');
        if (bgGradientStartInput && colors.headerStart) {
            bgGradientStartInput.value = colors.headerStart;
        }

        const bgGradientEndInput = document.querySelector('input[name="background_gradient_end"]');
        if (bgGradientEndInput && colors.bgSecondary) {
            bgGradientEndInput.value = colors.bgSecondary;
        }

        // Update primary color (header gradient start)
        const primaryColorInput = document.querySelector('input[name="header_gradient_start"]');
        if (primaryColorInput && colors.headerStart) {
            primaryColorInput.value = colors.headerStart;
            const primarySwatch = primaryColorInput.closest('.color-input-row')?.querySelector('.color-swatch');
            if (primarySwatch) primarySwatch.style.backgroundColor = colors.headerStart;
        }

        // Update header gradient end
        const headerEndInput = document.querySelector('input[name="header_gradient_end"]');
        if (headerEndInput && colors.headerEnd) {
            headerEndInput.value = colors.headerEnd;
        }

        // Update CTA button color
        const ctaColorInput = document.querySelector('input[name="cta_button_color"]');
        if (ctaColorInput && colors.btnColor) {
            ctaColorInput.value = colors.btnColor;
            const ctaSwatch = ctaColorInput.closest('.cta-color-input')?.querySelector('.cta-color-swatch');
            if (ctaSwatch) ctaSwatch.style.backgroundColor = colors.btnColor;
            const ctaPicker = ctaSwatch?.querySelector('input[type="color"]');
            if (ctaPicker) ctaPicker.value = colors.btnColor;
        }

        // Update CTA button text color
        const ctaTextColorInput = document.querySelector('input[name="cta_button_text_color"]');
        if (ctaTextColorInput && colors.textColor) {
            ctaTextColorInput.value = colors.textColor;
            const ctaTextSwatch = ctaTextColorInput.closest('.cta-color-input')?.querySelector('.cta-color-swatch');
            if (ctaTextSwatch) ctaTextSwatch.style.backgroundColor = colors.textColor;
            const ctaTextPicker = ctaTextSwatch?.querySelector('input[type="color"]');
            if (ctaTextPicker) ctaTextPicker.value = colors.textColor;
        }
        refreshCtaSamples();
    }

    // Remove banner
    function removeBanner(event) {
        event.stopPropagation();
        event.preventDefault();

        // Clear the stored file
        window._bannerFile = null;

        const container = document.getElementById('banner-upload-area');
        container.classList.remove('has-image');

        // Remove preview image
        const preview = document.getElementById('banner-preview');
        if (preview) preview.remove();

        const bannerValue = document.getElementById('banner-value');
        if (bannerValue) bannerValue.value = '';

        // Remove remove button
        const removeBtn = container.querySelector('.upload-btn-remove');
        if (removeBtn) removeBtn.remove();

        // Reset file input
        const fileInput = document.getElementById('banner-input');
        fileInput.value = '';

        // Update banner_remove to 1
        const removeInput = document.getElementById('banner-remove');
        removeInput.value = '1';

        savePreview();
    }

    // Remove profile
    function removeProfile(event) {
        event.stopPropagation();
        event.preventDefault();

        // Clear the stored file
        window._profileFile = null;

        const container = document.getElementById('profile-upload-circle');
        container.classList.remove('has-image');

        // Remove preview image
        const preview = document.getElementById('profile-preview');
        if (preview) preview.remove();

        const profileValue = document.getElementById('profile-value');
        if (profileValue) profileValue.value = '';

        // Remove remove button
        const removeBtn = container.querySelector('.profile-btn-remove');
        if (removeBtn) removeBtn.remove();

        // Reset file input
        const fileInput = document.getElementById('profile-input');
        fileInput.value = '';

        // Update profile_remove to 1
        const removeInput = document.getElementById('profile-remove');
        removeInput.value = '1';

        savePreview();
    }

    // Color updates
    function updatePrimaryColor(el) {
        el.closest('.color-swatch').style.backgroundColor = el.value;
        el.closest('.color-input-row').querySelector('input[type="text"]').value = el.value;
        savePreview();
    }
    function syncColorSwatch(el) {
        const swatch = el.closest('.color-input-row').querySelector('.color-swatch');
        swatch.style.backgroundColor = el.value;
        savePreview();
    }
    function updateBgColor(el) {
        el.closest('.color-swatch').style.backgroundColor = el.value;
        el.closest('.color-input-row').querySelector('input[type="text"]').value = el.value;
        const bgGradientEndInput = document.querySelector('input[name="background_gradient_end"]');
        if (bgGradientEndInput) bgGradientEndInput.value = el.value;
        savePreview();
    }
    function syncBgColorSwatch(el) {
        const swatch = el.closest('.color-input-row').querySelector('.color-swatch');
        swatch.style.backgroundColor = el.value;
        const bgGradientEndInput = document.querySelector('input[name="background_gradient_end"]');
        if (bgGradientEndInput) bgGradientEndInput.value = el.value;
        savePreview();
    }
    function updateCtaColor(el) {
        const wrapper = el.closest('.cta-color-input');
        const textInput = wrapper?.querySelector('input[name="cta_button_color"]');

        if (textInput) textInput.value = el.value;
        el.closest('.cta-color-swatch').style.backgroundColor = el.value;
        refreshCtaSamples();
        savePreview();
    }
    function updateCtaTextColor(el) {
        const wrapper = el.closest('.cta-color-input');
        const textInput = wrapper?.querySelector('input[name="cta_button_text_color"]');

        if (textInput) textInput.value = el.value;
        el.closest('.cta-color-swatch').style.backgroundColor = el.value;
        refreshCtaSamples();
        savePreview();
    }

    function syncCtaColorText(el) {
        if (!isValidHexColor(el.value)) return;

        const wrapper = el.closest('.cta-color-input');
        const swatch = wrapper?.querySelector('.cta-color-swatch');
        const picker = wrapper?.querySelector('input[type="color"]');

        if (swatch) swatch.style.backgroundColor = el.value;
        if (picker) picker.value = el.value;
        refreshCtaSamples();
        savePreview();
    }

    function syncCtaTextColorText(el) {
        if (!isValidHexColor(el.value)) return;

        const wrapper = el.closest('.cta-color-input');
        const swatch = wrapper?.querySelector('.cta-color-swatch');
        const picker = wrapper?.querySelector('input[type="color"]');

        if (swatch) swatch.style.backgroundColor = el.value;
        if (picker) picker.value = el.value;
        refreshCtaSamples();
        savePreview();
    }

    function isValidHexColor(value) {
        return /^#[0-9A-Fa-f]{6}$/.test(value);
    }

    function refreshCtaSamples() {
        const buttonColor = document.querySelector('input[name="cta_button_color"]')?.value || '#4F46E5';
        const textColor = document.querySelector('input[name="cta_button_text_color"]')?.value || '#FFFFFF';

        if (!isValidHexColor(buttonColor) || !isValidHexColor(textColor)) return;

        document.querySelectorAll('.style-btn-sample').forEach(sample => {
            sample.style.backgroundColor = buttonColor;
            sample.style.color = textColor;
        });
    }

    function openBackgroundImagePicker(event) {
        if (event.target.closest('.pro-locked')) return;
        setTimeout(() => document.getElementById('background-image-input')?.click(), 0);
    }

    function handleBackgroundImageUpload(input) {
        const file = input.files[0];
        if (!file) return;

        const removeInput = document.getElementById('background-remove');
        if (removeInput) removeInput.value = '0';

        const imageRadio = document.querySelector('input[name="background_type"][value="image"]');
        if (imageRadio) {
            imageRadio.checked = true;
            document.querySelectorAll('input[name="background_type"]').forEach(i => {
                i.closest('.bg-type-card')?.classList.remove('selected');
            });
            imageRadio.closest('.bg-type-card')?.classList.add('selected');
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const backgroundValue = document.getElementById('background-image-value');
            if (backgroundValue) backgroundValue.value = e.target.result;

            const preview = document.getElementById('background-image-preview');
            if (preview) {
                preview.innerHTML = '';
                preview.style.backgroundImage = `url('${e.target.result}')`;
                preview.style.backgroundSize = 'cover';
                preview.style.backgroundPosition = 'center';
            }

            const imageCard = imageRadio?.closest('.bg-type-card');
            if (imageCard && !imageCard.querySelector('.bg-image-remove')) {
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'bg-image-remove';
                removeBtn.title = 'Hapus background image';
                removeBtn.setAttribute('aria-label', 'Hapus background image');
                removeBtn.onclick = removeBackgroundImage;
                removeBtn.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>';
                imageCard.appendChild(removeBtn);
            }

            savePreview();
        };
        reader.readAsDataURL(file);
    }

    function removeBackgroundImage(event) {
        event.preventDefault();
        event.stopPropagation();

        window._backgroundFile = null;

        const backgroundValue = document.getElementById('background-image-value');
        if (backgroundValue) backgroundValue.value = '';

        const removeInput = document.getElementById('background-remove');
        if (removeInput) removeInput.value = '1';

        const fileInput = document.getElementById('background-image-input');
        if (fileInput) fileInput.value = '';

        const preview = document.getElementById('background-image-preview');
        if (preview) {
            preview.style.backgroundImage = '';
            preview.style.backgroundSize = '';
            preview.style.backgroundPosition = '';
            preview.innerHTML = '<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>';
        }

        const flatRadio = document.querySelector('input[name="background_type"][value="flat"]');
        if (flatRadio) {
            flatRadio.checked = true;
            document.querySelectorAll('input[name="background_type"]').forEach(i => {
                i.closest('.bg-type-card')?.classList.remove('selected');
            });
            flatRadio.closest('.bg-type-card')?.classList.add('selected');
        }

        const removeButton = event.currentTarget;
        if (removeButton) removeButton.remove();

        savePreview();
    }

    // Banner upload
    function handleBannerUpload(input) {
        const file = input.files[0];
        if (file) {
            // Store the file for form submission
            window._bannerFile = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                const container = document.getElementById('banner-upload-area');
                container.classList.add('has-image');

                // Only update preview image, keep the file input for form submission
                let preview = document.getElementById('banner-preview');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    // Create preview image if it doesn't exist
                    const img = document.createElement('img');
                    img.id = 'banner-preview';
                    img.src = e.target.result;
                    img.style = 'max-width: 100%; max-height: 140px; border-radius: 10px; object-fit: cover;';
                    container.insertBefore(img, container.firstChild);
                }

                // Add remove button if not exists
                if (!container.querySelector('.upload-btn-remove')) {
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'upload-btn-float upload-btn-remove';
                    removeBtn.onclick = removeBanner;
                    removeBtn.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    container.appendChild(removeBtn);
                }

                const bannerValue = document.getElementById('banner-value');
                if (bannerValue) bannerValue.value = e.target.result;

                const removeInput = document.getElementById('banner-remove');
                if (removeInput) removeInput.value = '0';

                savePreview();
            };
            reader.readAsDataURL(file);
        }
    }

    // Profile upload
    function handleProfileUpload(input) {
        const file = input.files[0];
        if (file) {
            // Store the file for form submission
            window._profileFile = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                const container = document.getElementById('profile-upload-circle');
                container.classList.add('has-image');

                // Only update preview image, keep the file input for form submission
                let preview = document.getElementById('profile-preview');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    // Create preview image if it doesn't exist
                    const img = document.createElement('img');
                    img.id = 'profile-preview';
                    img.src = e.target.result;
                    img.alt = 'Profile';
                    img.style = 'width: 100%; height: 100%; border-radius: 50%; object-fit: cover;';
                    container.insertBefore(img, container.firstChild);
                }

                // Add remove button if not exists
                if (!container.querySelector('.profile-btn-remove')) {
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'profile-upload-btn profile-btn-remove';
                    removeBtn.onclick = removeProfile;
                    removeBtn.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    container.appendChild(removeBtn);
                }

                const profileValue = document.getElementById('profile-value');
                if (profileValue) profileValue.value = e.target.result;

                const removeInput = document.getElementById('profile-remove');
                if (removeInput) removeInput.value = '0';

                savePreview();
            };
            reader.readAsDataURL(file);
        }
    }

    // Add click handler to banner upload area
    document.getElementById('banner-upload-area').addEventListener('click', function(e) {
        if (e.target.closest('.upload-btn-remove')) return;
        document.getElementById('banner-input').click();
    });

    // Add click handler to profile upload circle
    document.getElementById('profile-upload-circle').addEventListener('click', function(e) {
        if (e.target.closest('.profile-btn-remove')) return;
        document.getElementById('profile-input').click();
    });

    // Social pill toggle - opens modal to add/edit link
    let currentSocialPlatform = null;

    function toggleSocialPill(btn) {
        currentSocialPlatform = btn.dataset.platform;
        const modal = document.getElementById('social-modal');
        const input = document.getElementById('social-modal-input');
        const title = document.getElementById('social-modal-title');
        const label = document.getElementById('social-modal-label');

        // Get current value
        const hiddenInput = document.querySelector(`input[name="social_${currentSocialPlatform}"]`);
        input.value = hiddenInput ? hiddenInput.value : '';

        title.textContent = 'Edit ' + currentSocialPlatform.charAt(0).toUpperCase() + currentSocialPlatform.slice(1);
        label.textContent = currentSocialPlatform === 'email' ? 'Email Address' : 'URL or Username';

        modal.classList.remove('hidden');
        input.focus();
    }

    // Show add social modal
    function showAddSocialModal() {
        // For now, just show an info message
        // All social platforms are shown, user can click on any pill to add link
        alert('Klik pada social media pill untuk menambahkan atau mengedit link.');
    }

    // Close social modal
    function closeSocialModal() {
        document.getElementById('social-modal').classList.add('hidden');
        currentSocialPlatform = null;
    }

    // Save social link
    function saveSocialLink() {
        if (!currentSocialPlatform) return;

        const input = document.getElementById('social-modal-input');
        const value = input.value.trim();

        // Update hidden input
        const hiddenInput = document.querySelector(`input[name="social_${currentSocialPlatform}"]`);
        if (hiddenInput) {
            hiddenInput.value = value;
        }

        // Update pill visual state
        const pill = document.querySelector(`.social-pill[data-platform="${currentSocialPlatform}"]`);
        if (pill) {
            if (value) {
                pill.classList.add('active');
            } else {
                pill.classList.remove('active');
            }
        }

        closeSocialModal();
        savePreview();
    }

    function removeSocialLink(event, platform) {
        event.preventDefault();
        event.stopPropagation();

        const hiddenInput = document.querySelector(`input[name="social_${platform}"]`);
        if (hiddenInput) {
            hiddenInput.value = '';
            hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
        }

        const pill = document.querySelector(`.social-pill[data-platform="${platform}"]`);
        if (pill) {
            pill.classList.remove('active');
        }

        if (currentSocialPlatform === platform) {
            closeSocialModal();
        }

        savePreview();
    }

    // Listen to all form inputs for live preview
    document.querySelectorAll('#appearance-form input, #appearance-form textarea, #appearance-form select').forEach(input => {
        input.addEventListener('change', savePreview);
        input.addEventListener('input', function() {
            if (this.type === 'text' || this.tagName === 'TEXTAREA') {
                savePreview();
            }
        });
    });

    // Visual card selection styling
    document.querySelectorAll('.visual-card input, .style-card input, .font-card input, .template-card input, .bg-type-card input').forEach(input => {
        input.addEventListener('change', function() {
            // Update visual selection
            const name = this.name;
            document.querySelectorAll(`input[name="${name}"]`).forEach(i => {
                i.closest('.visual-card, .style-card, .font-card, .template-card, .bg-type-card')?.classList.remove('selected');
            });
            this.closest('.visual-card, .style-card, .font-card, .template-card, .bg-type-card')?.classList.add('selected');
            savePreview();
        });
    });

    // Form submit handler - ensure files are submitted
    document.getElementById('appearance-form').addEventListener('submit', function(e) {
        // If we have stored files, inject them into the form before submit
        const form = this;
        const backgroundInput = document.getElementById('background-image-input');
        const backgroundValue = document.getElementById('background-image-value');

        if (backgroundInput?.files?.length && backgroundValue) {
            backgroundValue.disabled = true;
        }

        if (window._bannerFile || window._profileFile) {
            e.preventDefault(); // Prevent default to handle manually

            const formData = new FormData(form);

            // Replace file inputs with stored files
            if (window._bannerFile) {
                formData.set('banner_file', window._bannerFile);
            }
            if (window._profileFile) {
                formData.set('profile_file', window._profileFile);
            }

            // Submit via fetch
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': 'PATCH'
                }
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Error: ' + response.status);
                }
            }).catch(err => {
                console.error(err);
                // Fallback: submit normally
                form.submit();
            });
        }
    });
</script>
@endpush
