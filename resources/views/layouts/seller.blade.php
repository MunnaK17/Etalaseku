<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Seller - EtalaseKu')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Figtree', 'sans-serif'] },
                    colors: {
                        'brand': {
                            50: '#FFFBEB',
                            100: '#FEF3C7',
                            200: '#FDE68A',
                            300: '#FCD34D',
                            400: '#FBBF24',
                            500: '#FFD700',
                            600: '#F59E0B',
                            700: '#D97706',
                            800: '#B45309',
                            900: '#92400E',
                        }
                    }
                },
            },
        }
    </script>
    <style>
        /* Theme CSS Variables - Light Theme (Default) - Refined */
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-hover: #e2e8f0;
            --border-color: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --accent: #f59e0b;
            --accent-hover: #d97706;
            --accent-light: rgba(245, 158, 11, 0.1);
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --card-bg: #ffffff;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.1);
            --sidebar-bg: #ffffff;
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --scrollbar-track: #f1f5f9;
            --scrollbar-thumb: #cbd5e1;
            --scrollbar-thumb-hover: #94a3b8;
            --nav-hover-bg: #f1f5f9;
            --nav-active-bg: rgba(245, 158, 11, 0.12);
            --nav-active-text: #f59e0b;
            --nav-text: #64748b;
            --nav-text-hover: #0f172a;
            --header-bg: #ffffff;
            --chart-views: #f59e0b;
            --chart-clicks: #10b981;
            /* Dashboard specific */
            --dashboard-card-bg: #ffffff;
            --dashboard-card-border: #e2e8f0;
            --dashboard-card-header-bg: #f8fafc;
            --dashboard-input-bg: #ffffff;
            --dashboard-input-border: #cbd5e1;
            --dashboard-text: #0f172a;
            --dashboard-text-secondary: #475569;
            --dashboard-text-muted: #94a3b8;
            --dashboard-bg-hover: #f1f5f9;
            --dashboard-border: #e2e8f0;
            --dashboard-table-header: #f8fafc;
        }

        /* Dark Theme - Refined */
        html.dark {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-hover: #334155;
            --border-color: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent: #fbbf24;
            --accent-hover: #f59e0b;
            --accent-light: rgba(251, 191, 36, 0.15);
            --success: #10b981;
            --danger: #ef4444;
            --warning: #fbbf24;
            --info: #3b82f6;
            --card-bg: #1e293b;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            --card-shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.4);
            --sidebar-bg: #1e293b;
            --input-bg: #334155;
            --input-border: #475569;
            --scrollbar-track: #1e293b;
            --scrollbar-thumb: #475569;
            --scrollbar-thumb-hover: #64748b;
            --nav-hover-bg: #334155;
            --nav-active-bg: rgba(251, 191, 36, 0.15);
            --nav-active-text: #fbbf24;
            --nav-text: #94a3b8;
            --nav-text-hover: #f8fafc;
            --header-bg: #1e293b;
            --chart-views: #fbbf24;
            --chart-clicks: #10b981;
            /* Dashboard specific - matching blocks/index.blade.php dark theme */
            --dashboard-card-bg: #18181b;
            --dashboard-card-border: #3f3f46;
            --dashboard-card-header-bg: #27272a;
            --dashboard-input-bg: #27272a;
            --dashboard-input-border: #3f3f46;
            --dashboard-text: #fafafa;
            --dashboard-text-secondary: #d4d4d8;
            --dashboard-text-muted: #71717a;
            --dashboard-bg-hover: #27272a;
            --dashboard-border: #3f3f46;
            --dashboard-table-header: #27272a;
        }

        /* Theme Transition */
        [x-cloak] {
            display: none !important;
        }

        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, fill 0.3s ease;
        }

        /* Disable transition on page load */
        .no-transition, .no-transition * {
            transition: none !important;
        }

        /* Apply theme colors to body */
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--sidebar-bg);
            border-color: var(--border-color);
        }
        .sidebar-text {
            color: var(--text-primary);
        }
        .sidebar-text-muted {
            color: var(--text-muted);
        }

        /* Nav Items */
        .nav-item {
            color: var(--nav-text);
        }
        .nav-item:hover {
            background-color: var(--nav-hover-bg);
            color: var(--nav-text-hover);
        }
        .nav-item.active {
            background-color: var(--nav-active-bg);
            color: var(--nav-active-text);
        }

        /* Main Content */
        .main-bg {
            background-color: var(--bg-primary);
        }
        .header-bg {
            background-color: var(--bg-secondary);
            border-color: var(--border-color);
        }

        /* Text Colors */
        .text-primary {
            color: var(--text-primary);
        }
        .text-secondary {
            color: var(--text-secondary);
        }
        .text-muted {
            color: var(--text-muted);
        }

        /* Backgrounds */
        .bg-primary {
            background-color: var(--bg-primary);
        }
        .bg-secondary {
            background-color: var(--bg-secondary);
        }
        .bg-tertiary {
            background-color: var(--bg-tertiary);
        }
        .bg-card {
            background-color: var(--card-bg);
        }

        /* Borders */
        .border-theme {
            border-color: var(--border-color);
        }

        /* Skip to Content - Accessibility */
        .skip-to-content {
            position: absolute;
            left: -9999px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
            z-index: 9999;
        }
        .skip-to-content:focus {
            position: fixed;
            top: 0;
            left: 0;
            width: auto;
            height: auto;
            padding: 1rem 1.5rem;
            background: var(--accent);
            color: #000;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0 0.5rem 0.5rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            outline: 3px solid var(--text-primary);
            outline-offset: 2px;
        }

        /* Focus Indicators - WCAG 2.2 AA */
        *:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 2px;
            border-radius: 4px;
        }
        *:focus:not(:focus-visible) {
            outline: none;
        }
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible,
        [tabindex]:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 2px;
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            *:focus-visible {
                outline-width: 4px;
                outline-style: solid;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 10px;
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
        }
        .theme-toggle:hover {
            background: var(--bg-hover);
            border-color: var(--accent);
            color: var(--accent);
        }
        .theme-toggle svg {
            width: 18px;
            height: 18px;
            transition: transform 0.3s ease;
        }
        .theme-toggle .sun-icon {
            display: block;
        }
        .theme-toggle .moon-icon {
            display: none;
        }
        html.dark .theme-toggle .sun-icon {
            display: none;
        }
        html.dark .theme-toggle .moon-icon {
            display: block;
        }

        /* Badge */
        .badge {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent);
        }

        /* Notification dropdown */
        .notification-dropdown {
            background: var(--bg-secondary);
            border-color: var(--border-color);
        }

        /* Notification item hover */
        .notification-item:hover {
            background: var(--bg-hover);
        }

        /* Common Card Style */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
        }
        .card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        /* Card Header */
        .card-header {
            background: var(--bg-secondary);
            border-color: var(--border-color);
        }

        /* Card Text */
        .card-title {
            color: var(--text-primary);
        }
        .card-subtitle {
            color: var(--text-muted);
        }

        /* Gradient Accent Header */
        .card-accent-header {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
        }
        .card-accent-header .card-title {
            color: #000;
        }
        .card-accent-header .card-subtitle {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Stat Card */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: var(--accent);
            box-shadow: var(--card-shadow-hover);
        }
        .stat-label {
            color: var(--text-muted);
        }
        .stat-value {
            color: var(--text-primary);
        }

        /* Action Card (create cards) */
        .action-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .action-card:hover {
            border-color: var(--accent);
            box-shadow: var(--card-shadow-hover);
        }
        .action-card-icon {
            background: var(--accent-light);
            transition: background-color 0.3s ease;
        }
        .action-card:hover .action-card-icon {
            background: var(--accent-light);
        }
        .action-card-text {
            color: var(--text-secondary);
        }

        /* Chart Card */
        .chart-bar-views {
            background: var(--chart-views);
        }
        .chart-bar-clicks {
            background: var(--chart-clicks);
        }

        /* Input Fields */
        .input {
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            color: var(--text-primary);
        }
        .input::placeholder {
            color: var(--text-muted);
        }
        .input:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px var(--accent-light);
        }
        .input:disabled, .input[readonly] {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Button Styles */
        .btn-accent {
            background: var(--accent);
            color: #000;
            transition: all 0.2s ease;
        }
        .btn-accent:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }
        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }
        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-light);
        }

        /* Badge Variants */
        .badge {
            background: var(--accent-light);
            color: var(--accent);
        }
        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        .badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }

        /* Pro Badge */
        .badge-pro {
            background: var(--accent-light);
            color: var(--accent);
        }

        /* Inclusive Badge */
        .badge-inclusive {
            background: var(--accent-light);
            color: var(--accent);
        }

        /* Upgrade Button */
        .btn-upgrade {
            background: var(--accent);
            color: #000;
            transition: all 0.2s ease;
        }
        .btn-upgrade:hover {
            filter: brightness(1.1);
        }

        /* Link Share Button */
        .btn-share {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }
        .btn-share:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }

        /* Divider */
        .divider {
            border-color: var(--border-color);
        }

        /* Text Colors for Dashboard */
        .text-title {
            color: var(--text-primary);
        }
        .text-subtitle {
            color: var(--text-secondary);
        }
        .text-caption {
            color: var(--text-muted);
        }
        .text-accent {
            color: var(--accent);
        }

        /* Table Styles */
        .table-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }
        .table-header {
            background: var(--bg-secondary);
            border-color: var(--border-color);
        }
        .table-row {
            border-color: var(--border-color);
            transition: background-color 0.2s ease;
        }
        .table-row:hover {
            background: var(--bg-hover);
        }
        .table-cell {
            color: var(--text-primary);
        }
        .table-cell-muted {
            color: var(--text-muted);
        }

        /* Form Labels */
        .form-label {
            color: var(--text-secondary);
        }
        .form-helper {
            color: var(--text-muted);
        }

        /* Modal/Dropdown */
        .dropdown-menu {
            background: var(--bg-secondary);
            border-color: var(--border-color);
            box-shadow: var(--card-shadow-hover);
        }

        /* Tooltip */
        .tooltip {
            background: var(--bg-tertiary);
            color: var(--text-primary);
        }

        /* Alert Styles */
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success);
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--danger);
        }
        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--warning);
        }
        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: var(--info);
        }

        /* ============================================
           COMPREHENSIVE DARK MODE OVERRIDES
           These override hardcoded colors in child pages
           ============================================ */

        /* Appearance Page Overrides */
        .appearance-page {
            background-color: var(--bg-primary) !important;
        }
        .appearance-preview-card,
        .page-header,
        .section-card {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
            box-shadow: var(--card-shadow) !important;
        }
        .appearance-preview-title,
        .page-url-value,
        .section-title,
        .section-title svg {
            color: var(--text-primary) !important;
        }
        .appearance-preview-refresh,
        .page-url-label,
        .section-desc,
        .info-icon {
            color: var(--text-muted) !important;
        }
        .page-url-value span {
            color: var(--accent) !important;
        }
        .appearance-preview-frame {
            background: var(--bg-primary) !important;
            border-color: var(--border-color) !important;
        }
        .btn-share {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
        }
        .toggle-row {
            border-bottom-color: var(--border-color) !important;
        }
        .toggle-label,
        .toggle-label-with-info {
            color: var(--text-secondary) !important;
        }
        .toggle-switch {
            background: var(--bg-tertiary) !important;
        }
        .toggle-switch::after {
            background: var(--text-muted) !important;
        }
        .visual-card,
        .upload-area,
        .profile-upload-circle,
        .bg-type-card,
        .style-card,
        .font-card,
        .cta-section {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
        }
        .visual-card .layout-preview,
        .layout-preview {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        .visual-card .name-bar {
            background: var(--text-muted) !important;
        }
        .upload-icon,
        .upload-text,
        .upload-hint {
            color: var(--text-muted) !important;
        }
        .profile-upload-circle svg {
            color: var(--text-muted) !important;
        }
        .textarea-about,
        .color-hex-input,
        .cta-color-hex {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        .textarea-about::placeholder {
            color: var(--text-muted) !important;
        }
        .emoji-picker-btn {
            background: var(--bg-tertiary) !important;
            color: var(--text-secondary) !important;
        }
        .social-pill {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
        }
        .btn-add-social {
            border-color: var(--border-color) !important;
            color: var(--text-muted) !important;
        }
        .font-preview {
            color: var(--text-primary) !important;
        }
        .font-name {
            color: var(--text-muted) !important;
        }
        .template-card .template-content {
            background: var(--bg-tertiary) !important;
        }
        .template-card .template-item {
            background: var(--border-color) !important;
        }
        .text-center.py-6 {
            background: var(--bg-tertiary) !important;
        }
        .text-center.py-6 svg {
            color: var(--text-muted) !important;
        }
        .text-center.py-6 p {
            color: var(--text-secondary) !important;
        }
        /* Form inputs */
        input[type="text"],
        input[type="url"],
        input[type="number"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="search"],
        select,
        textarea {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
        }
        input::placeholder,
        textarea::placeholder {
            color: var(--text-muted) !important;
        }
        /* Modal styles */
        #social-modal > div {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        #social-modal h3,
        #social-modal input,
        #social-modal label {
            color: var(--text-primary) !important;
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
        }
        #social-modal .flex.gap-3 button:first-child {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
        }

        /* Wallet Page Overrides */
        .wallet-container,
        .wallet-header h1 {
            color: var(--text-primary) !important;
        }
        .wallet-header p,
        .balance-card-label,
        .balance-card-status,
        .transaction-table td,
        .transaction-table th,
        .empty-state p {
            color: var(--text-secondary) !important;
        }
        .balance-card,
        .transaction-card {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        .balance-card-pending .balance-card-amount {
            color: var(--accent) !important;
        }
        .transaction-header {
            border-bottom-color: var(--border-color) !important;
        }
        .transaction-header h2 {
            color: var(--text-primary) !important;
        }
        .pagination-wrapper {
            border-top-color: var(--border-color) !important;
        }

        /* QR Code Page Overrides */
        .qr-page-container {
            background: var(--bg-primary) !important;
        }
        .qr-header h1 {
            color: var(--text-primary) !important;
        }
        .qr-header p {
            color: var(--text-secondary) !important;
        }
        .qr-card {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        .qr-card-header {
            background: var(--bg-tertiary) !important;
            border-bottom-color: var(--border-color) !important;
        }
        .qr-card-header h2 {
            color: var(--text-primary) !important;
        }
        .qr-card-header svg {
            color: var(--accent) !important;
        }
        .qr-preview-box {
            background: var(--bg-primary) !important;
        }
        .qr-preview-text {
            color: var(--text-secondary) !important;
        }
        .qr-preview-text span {
            color: var(--accent) !important;
        }
        .qr-url-input {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
        }
        .qr-url-input::placeholder {
            color: var(--text-muted) !important;
        }
        .qr-size-option span {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
        }
        .qr-color-text {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        .qr-copy-section {
            border-top-color: var(--border-color) !important;
        }
        .qr-download-btn-secondary {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
        }
        .qr-tips-card {
            background: var(--accent-light) !important;
            border-color: var(--accent) !important;
        }
        .qr-tips-title {
            color: var(--accent) !important;
        }
        .qr-tips-list {
            color: var(--text-secondary) !important;
        }
        .text-sm.font-medium.text-zinc-300 {
            color: var(--text-secondary) !important;
        }

        /* Blocks Page Additional Overrides */
        .blocks-container,
        .blocks-header {
            background: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        .thumbnail-placeholder,
        .block-thumbnail {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
        }

        /* General Tailwind Dark Mode Classes Override */
        /* These target common Tailwind dark: classes that use hardcoded values */
        .bg-white,
        .bg-gray-50,
        .bg-gray-100,
        .bg-gray-200,
        .bg-zinc-50,
        .bg-zinc-100,
        .bg-zinc-200 {
            background-color: var(--bg-primary) !important;
        }
        .bg-gray-300,
        .bg-gray-400,
        .bg-gray-500,
        .bg-gray-600,
        .bg-gray-700,
        .bg-gray-800,
        .bg-gray-900,
        .bg-zinc-700,
        .bg-zinc-800,
        .bg-zinc-900 {
            background-color: var(--bg-tertiary) !important;
        }
        .text-gray-900,
        .text-gray-800,
        .text-gray-700,
        .text-gray-600,
        .text-gray-500,
        .text-gray-400,
        .text-zinc-400,
        .text-zinc-500,
        .text-zinc-600 {
            color: var(--text-secondary) !important;
        }
        .border-gray-200,
        .border-gray-300,
        .border-gray-400,
        .border-zinc-700,
        .border-zinc-800 {
            border-color: var(--border-color) !important;
        }
        .divide-gray-100 > * {
            border-color: var(--border-color) !important;
        }
        .hover\:bg-gray-50:hover,
        .hover\:bg-gray-100:hover {
            background-color: var(--bg-hover) !important;
        }

        /* Mobile layout guardrails for seller pages */
        img,
        video,
        iframe,
        canvas,
        svg {
            max-width: 100%;
        }
        .card,
        .stat-card,
        .action-card,
        .section-card,
        .blocks-container,
        .qr-card,
        .wallet-card,
        .transaction-card {
            min-width: 0;
        }
        .table-container,
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
        table {
            max-width: 100%;
        }
        @media (max-width: 1023px) {
            .appearance-page {
                max-width: 100% !important;
                padding: 16px 0 !important;
            }
            .appearance-form-col {
                max-width: none !important;
                width: 100% !important;
            }
        }
        @media (max-width: 767px) {
            .card,
            .stat-card,
            .action-card,
            .section-card,
            .blocks-container,
            .qr-card,
            .wallet-card,
            .transaction-card {
                border-radius: 12px !important;
            }
            .card-header,
            .page-header,
            .section-header,
            .transaction-header {
                align-items: flex-start !important;
                flex-direction: column !important;
                gap: 12px !important;
            }
            .page-header-actions,
            .color-input-row,
            .upload-grid,
            .cta-color-row {
                display: grid !important;
                grid-template-columns: 1fr !important;
                width: 100% !important;
            }
            .btn-action,
            .btn-accent,
            .btn-outline,
            .btn-share,
            .btn-upgrade {
                justify-content: center;
                max-width: 100%;
                white-space: normal;
            }
            .template-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
            .visual-grid,
            .font-grid,
            .style-grid {
                grid-template-columns: 1fr !important;
            }
            .toggle-row {
                align-items: flex-start !important;
                gap: 12px !important;
            }
            .modal-content,
            .block-selector-modal {
                width: calc(100vw - 2rem) !important;
                max-width: calc(100vw - 2rem) !important;
                padding: 16px !important;
            }
            .block-card > .flex {
                align-items: flex-start !important;
                gap: 12px !important;
            }
            .transaction-table,
            .transaction-table thead,
            .transaction-table tbody,
            .transaction-table th,
            .transaction-table td,
            .transaction-table tr {
                white-space: nowrap;
            }
        }

        /* Links */
        a {
            color: var(--accent) !important;
        }
        a:hover {
            color: var(--accent-hover) !important;
        }
    </style>
    @stack('head')
    <script>
        // Theme Management
        (function() {
            // Get saved theme or default to system preference
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                document.documentElement.classList.toggle('dark', savedTheme === 'dark');
            } else {
                document.documentElement.classList.toggle('dark', prefersDark);
            }

            // Remove transition class after page load
            window.addEventListener('load', function() {
                document.body.classList.remove('no-transition');
            });

            // Add no-transition class initially to prevent flash
            document.body.classList.add('no-transition');
        })();

        // Theme Toggle Function
        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    </script>
    @stack('styles')
</head>
<body class="font-sans antialiased main-bg">
    <!-- Skip to Content - Accessibility -->
    <a href="#main-content" class="skip-to-content">Langsung ke konten utama</a>

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
        <div x-show="sidebarOpen"
             x-cloak
             x-transition.opacity
             class="fixed inset-0 z-20 bg-black/50 lg:hidden"
             @click="sidebarOpen = false"
             aria-hidden="true"></div>

        <!-- Sidebar -->
        <aside class="w-64 sidebar flex flex-col fixed inset-y-0 left-0 h-full z-30 border-r transform transition-transform duration-200 lg:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <!-- Logo -->
            <div class="px-6 py-5 border-b border-theme">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/image4-removebg-preview.png') }}" alt="Logo EtalaseKu" class="h-10">
                    <div>
                        <span class="font-bold text-lg sidebar-text">EtalaseKu</span>
                        <p class="text-xs sidebar-text-muted">Panel Seller</p>
                    </div>
                </a>
            </div>

            <!-- Store Badge -->
            @if(isset($store) && $store)
                <div class="px-4 py-3 border-b border-theme">
                    <div class="flex items-center gap-2">
                        @if($store->logo)
                            <img src="{{ $store->logo }}" alt="" class="w-8 h-8 rounded-lg object-cover">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-yellow-500/20 flex items-center justify-center">
                                <span class="font-bold text-yellow-400 text-sm">{{ substr($store->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold sidebar-text text-sm truncate">{{ $store->name }}</p>
                            <span class="inline-flex px-1.5 py-0.5 rounded text-xs font-medium badge">
                                {{ $store->plan_display_name }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="px-4 py-2 text-xs font-semibold text-muted uppercase tracking-wider">Menu</p>

                <a href="{{ route('seller.dashboard') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('seller.appearance.index') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.appearance.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    Appearance
                </a>

                <a href="{{ route('seller.qr-code.index') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.qr-code.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    QR Code
                </a>

                <a href="{{ route('seller.orders.index') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Pesanan
                    @php
                        $pendingOrders = 0;
                        if (isset($store)) {
                            $pendingOrders = \App\Models\Order::where('store_id', $store->id)->whereIn('order_status', ['pending', 'paid'])->count();
                        }
                    @endphp
                    @if($pendingOrders > 0)
                        <span class="ml-auto inline-flex items-center justify-center w-5 h-5 text-xs font-bold bg-yellow-500 text-black rounded-full">{{ $pendingOrders > 9 ? '9+' : $pendingOrders }}</span>
                    @endif
                </a>

                <a href="{{ route('seller.wallet.index') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.wallet.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Dompet
                </a>

                <a href="{{ route('seller.store.edit') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.store.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.312.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>

                <a href="{{ route('seller.verification.index') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('seller.verification.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Verifikasi Seller
                    @if(isset($store) && $store->verification?->isPending)
                        <span class="ml-auto px-2 py-0.5 text-xs font-semibold bg-yellow-500 text-black rounded-full">Baru</span>
                    @endif
                </a>

                @unless(isset($store) && $store->isPro())
                    <a href="{{ route('seller.upgrade') }}"
                       class="flex items-center gap-3 px-4 py-3 mt-4 rounded-lg transition bg-yellow-500 text-black font-semibold hover:bg-yellow-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        Upgrade Pro
                    </a>
                @endunless

                <!-- View Store Link -->
                <div class="pt-4 mt-4 border-t border-theme">
                    <a href="{{ isset($store) ? $store->public_url : '#' }}" target="_blank"
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Etalase
                    </a>
                </div>
            </nav>

            <!-- User Section -->
            <div class="px-4 py-4 border-t border-theme">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center">
                        <span class="font-semibold" style="color: var(--accent)">{{ substr(auth()->user()->name ?? 'S', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium sidebar-text text-sm truncate">{{ auth()->user()->name ?? 'Seller' }}</p>
                        <p class="text-xs sidebar-text-muted truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 rounded-lg transition text-red-400 hover:bg-red-500/10 hover:text-red-300 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="main-content" class="flex-1 w-full overflow-auto main-bg min-h-screen lg:ml-64">
            <!-- Top Bar -->
            <header class="header-bg border-b px-4 py-3 sm:px-6 lg:px-8 lg:py-4">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex min-w-0 items-center gap-3">
                        <button type="button"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-theme text-secondary lg:hidden"
                                @click="sidebarOpen = true"
                                aria-label="Buka menu navigasi">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div class="min-w-0 truncate text-sm text-muted">
                        <a href="{{ route('home') }}" class="hover:text-yellow-500 transition">Home</a>
                        <span class="mx-2">/</span>
                        <span class="text-primary">@yield('breadcrumb', 'Seller')</span>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-2 sm:gap-4">
                        <!-- Theme Toggle -->
                        <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme">
                            <!-- Sun Icon -->
                            <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <!-- Moon Icon -->
                            <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <span class="hidden sm:inline">Tema</span>
                        </button>

                        <!-- Notification Bell -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                    class="relative p-2 rounded-lg transition hover:bg-hover text-secondary"
                                    aria-haspopup="true"
                                    :aria-expanded="open"
                                    aria-label="Notifikasi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications()->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="absolute top-1 right-1 w-4 h-4 text-xs font-bold rounded-full flex items-center justify-center" style="background: var(--accent); color: #000;" aria-label="{{ $unreadCount }} notifikasi belum dibaca">{{ $unreadCount }}</span>
                                @endif
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 role="dialog"
                                 aria-label="Daftar notifikasi"
                                 class="notification-dropdown absolute right-0 mt-2 w-[calc(100vw-2rem)] max-w-80 rounded-xl shadow-xl border py-2 z-50">
                                <div class="px-4 py-2 border-b border-theme flex justify-between items-center">
                                    <span class="font-semibold text-primary">Notifikasi</span>
                                    @if($unreadCount > 0)
                                        <form method="POST" action="{{ route('seller.notifications.mark-all-read') }}">
                                            @csrf
                                            <button type="submit" class="text-xs" style="color: var(--accent)">Tandai semua baca</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="max-h-80 overflow-y-auto" aria-live="polite" aria-label="Notifikasi terbaru">
                                    @php
                                        $notifications = auth()->user()->unreadNotifications()->take(10)->get();
                                    @endphp
                                    @if($notifications->count() > 0)
                                        @foreach($notifications as $notification)
                                            <div class="notification-item px-4 py-3 border-b border-theme {{ $notification->read_at ? 'opacity-60' : '' }}" role="listitem">
                                                <p class="text-sm font-medium text-primary">{{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                                                <p class="text-xs text-muted mt-1">{{ $notification->data['message'] ?? '' }}</p>
                                                <p class="text-xs text-muted mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="px-4 py-8 text-center text-muted">
                                            <svg class="w-8 h-8 mx-auto mb-2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                            <p class="text-sm">Belum ada notifikasi</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="px-4 pb-6 sm:px-6 lg:px-8 lg:pb-8">
                @if(session('success'))
                    <div role="alert" aria-live="polite" class="mb-6 mt-6 alert-success px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div role="alert" aria-live="assertive" class="mb-6 mt-6 alert-error px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div role="alert" aria-live="polite" class="mb-6 mt-6 alert-warning px-4 py-3 rounded-lg flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('info') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
