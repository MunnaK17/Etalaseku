@extends('layouts.seller')

@section('title', 'Dashboard - EtalaseKU')

@push('styles')
<style>
    [x-cloak] { display: none !important; }

    .block-card {
        transition: all 0.2s ease;
    }
    .block-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .block-type-badge {
        font-size: 0.65rem;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .sortable-ghost {
        opacity: 0.4;
        background: var(--dashboard-bg-hover);
    }

    .preview-iframe {
        border: 2px solid var(--dashboard-card-border);
        border-radius: 0.75rem;
        background: var(--dashboard-card-bg);
    }

    /* Block type badges - use CSS variables */
    .type-link { background: var(--accent-light); color: var(--accent); }
    .type-text { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
    .type-image { background: rgba(52, 211, 153, 0.15); color: #34d399; }
    .type-video { background: rgba(244, 114, 182, 0.15); color: #f472b6; }
    .type-social_connect { background: rgba(165, 180, 252, 0.15); color: #a5b4fc; }
    .type-product { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
    .type-digital_product { background: rgba(192, 132, 252, 0.15); color: #c084fc; }

    /* Block cards - use CSS variables for theming */
    html.dark .block-card,
    .block-card {
        background: var(--dashboard-card-bg);
        border: 1px solid var(--dashboard-card-border);
    }

    html.dark .block-card:hover,
    .block-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    /* Header section - use CSS variables */
    .blocks-header {
        background: var(--dashboard-card-bg);
        border-color: var(--dashboard-card-border);
    }

    /* Card container */
    .blocks-container {
        background: var(--dashboard-card-bg);
        border-color: var(--dashboard-card-border);
    }

    /* Page pills */
    .page-pill {
        background: var(--dashboard-input-bg);
        border-color: var(--dashboard-card-border);
    }
    html.dark .page-pill,
    .page-pill {
        background: var(--dashboard-input-bg);
        color: var(--dashboard-text-muted);
    }

    /* Preview container */
    .preview-container {
        background: var(--dashboard-card-bg);
        border-color: var(--dashboard-card-border);
    }

    /* Modals */
    .modal-backdrop {
        background: rgba(0,0,0,0.7);
    }
    html.dark .modal-backdrop {
        background: rgba(0,0,0,0.7);
    }
    .block-selector-backdrop {
        background: rgba(15, 23, 42, 0.35) !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .modal-content {
        background: var(--dashboard-card-bg);
        border-color: var(--dashboard-card-border);
    }
    .block-selector-modal {
        background: #ffffff !important;
        border-color: #e2e8f0 !important;
        color: #0f172a;
    }
    .block-selector-modal h2 {
        color: #0f172a !important;
    }
    .block-selector-modal h3 {
        color: #475569 !important;
    }
    .block-selector-modal .block-type-btn {
        background: #ffffff;
        border-color: #dbe3ef !important;
        color: #0f172a;
    }
    .block-selector-modal .block-type-btn:hover {
        background: #f8fafc;
        border-color: var(--accent) !important;
    }
    .block-selector-modal .block-type-btn p:first-of-type {
        color: #0f172a !important;
    }
    .block-selector-modal .block-type-btn p:last-of-type {
        color: #64748b !important;
    }
    .modal-content h2,
    .modal-content h3 {
        color: var(--dashboard-text);
    }

    /* Form elements in modals */
    .modal-content input[type="text"],
    .modal-content input[type="url"],
    .modal-content input[type="number"],
    .modal-content textarea,
    .modal-content select {
        background: var(--dashboard-input-bg);
        border-color: var(--dashboard-card-border);
        color: var(--dashboard-text);
    }
    .modal-content input[type="text"]:focus,
    .modal-content input[type="url"]:focus,
    .modal-content input[type="number"]:focus,
    .modal-content textarea:focus,
    .modal-content select:focus {
        border-color: var(--accent);
        outline: none;
    }
    .modal-content label {
        color: var(--dashboard-text-secondary);
    }

    /* Text colors */
    .text-white { color: var(--dashboard-text) !important; }
    .text-gray-400 { color: var(--dashboard-text-muted) !important; }
    .text-gray-500 { color: var(--dashboard-text-secondary) !important; }
    .text-yellow-400 { color: var(--accent) !important; }

    /* Background colors */
    .bg-zinc-900,
    .bg-gray-900 {
        background-color: var(--dashboard-card-bg) !important;
    }
    .bg-zinc-800,
    .bg-gray-800 {
        background-color: var(--dashboard-input-bg) !important;
    }
    .bg-zinc-800\/50 {
        background-color: var(--dashboard-bg-hover) !important;
    }

    /* Border colors */
    .border-zinc-800,
    .border-zinc-700,
    .border-zinc-600,
    .border-gray-900\/50 {
        border-color: var(--dashboard-card-border) !important;
    }

    /* Button styles */
    .bg-yellow-500 {
        background-color: var(--accent) !important;
    }
    .hover\:bg-yellow-400:hover {
        background-color: var(--accent-hover) !important;
    }
    .text-black {
        color: #000 !important;
    }

    /* Empty state */
    .text-zinc-500 {
        color: var(--dashboard-text-muted) !important;
    }
    .text-zinc-600 {
        color: var(--dashboard-text-secondary) !important;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen pb-12" style="background-color: var(--bg-primary);" x-data="blockDashboard()" x-init="init()">

    {{-- Header Section --}}
    <div class="blocks-header border-b" style="border-color: var(--dashboard-card-border);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold" style="color: var(--dashboard-text);">Block Editor</h1>
                    <p class="mt-1 text-sm" style="color: var(--dashboard-text-muted);">
                        Halaman publik kamu:
                        <a href="{{ url('/' . $store->username) }}" target="_blank" class="font-medium" style="color: var(--accent);">
                            {{ url('/' . $store->username) }}
                        </a>
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="copyUrl()" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition" style="background-color: var(--accent); color: #000;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Left Column: Page & Block Management --}}
            <div class="space-y-6">

                {{-- Page Tabs --}}
                <div class="blocks-container rounded-xl border p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Pages</h2>
                        <button @click="showAddPageModal = true" class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg transition" style="background-color: var(--dashboard-input-bg); color: var(--dashboard-text-muted);">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Page
                        </button>
                    </div>

                    {{-- Page Pills --}}
                    <div class="flex flex-wrap gap-2" role="tablist">
                        @foreach($pages as $page)
                        <div
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-full transition cursor-pointer"
                            :class="currentPageId == {{ $page->id }} ? 'text-black' : ''"
                            style="background-color: var(--dashboard-input-bg); color: var(--dashboard-text-muted);"
                            @click="switchPage({{ $page->id }})"
                            role="tab"
                            :aria-selected="currentPageId == {{ $page->id }}"
                        >
                            {{ $page->title }}
                            @if($page->is_default)
                            <span class="ml-1.5 w-2 h-2 rounded-full" style="background-color: var(--success);"></span>
                            @endif
                            <div class="flex items-center gap-1 ml-2">
                                <button @click.stop="openEditPageModal({{ $page->id }}, '{{ $page->title }}', '{{ $page->slug }}')" class="p-1 rounded transition" title="Edit Page" :style="'hover:bg-' + (currentPageId == {{ $page->id }} ? 'yellow-400' : 'gray-700')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--dashboard-text-muted);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                @unless($page->is_default)
                                <button @click.stop="openDeleteModal({{ $page->id }}, '{{ $page->title }}')" class="p-1 rounded transition" title="Hapus Page" style="color: var(--danger);">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                                @endunless
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Blocks List --}}
                <div class="blocks-container rounded-xl border p-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Blocks</h2>
                            @if(!$store->isPro())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                  :class="blocks.length >= 5 ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'"
                                  x-text="blocks.length + '/5'"></span>
                            @endif
                        </div>
                        <button @click="handleAddBlock()" class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg transition"
                                :class="getAddBlockClass()">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add new block
                        </button>
                    </div>

                    @if(!$store->isPro())
                    <div x-show="blocks.length >= 5" class="mb-3 p-3 rounded-lg bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-500/30">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-purple-300">Batas maksimal 5 block tercapai.</p>
                            <a href="{{ route('seller.upgrade') }}" class="ml-auto px-3 py-1 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-semibold rounded-lg hover:from-purple-600 hover:to-pink-600">Upgrade PRO</a>
                        </div>
                    </div>
                    @endif

                    {{-- Blocks Container --}}
                    <div class="space-y-3" id="blocks-container">
                        <template x-if="blocks.length === 0">
                            <div class="text-center py-12" style="color: var(--dashboard-text-muted);">
                                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--dashboard-text-secondary);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <p class="font-medium">Belum ada block</p>
                                <p class="text-sm">Klik "Add new block" untuk menambahkan</p>
                            </div>
                        </template>

                        <template x-for="(block, index) in blocks" :key="block.id">
                            <div class="block-card bg-zinc-800 rounded-xl p-4 border border-zinc-700"
                                 :data-block-id="block.id"
                                 :class="{ 'opacity-50': !block.is_active }">
                                <div class="flex items-start gap-4">
                                    {{-- Sort Controls --}}
                                    <div class="flex flex-col gap-1">
                                        <button @click="moveBlock(index, -1)" :disabled="index === 0" class="p-1 text-zinc-500 hover:text-white disabled:opacity-30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                            </svg>
                                        </button>
                                        <button @click="moveBlock(index, 1)" :disabled="index === blocks.length - 1" class="p-1 text-zinc-500 hover:text-white disabled:opacity-30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Thumbnail/Icon --}}
                                    <div class="w-16 h-16 rounded-lg bg-zinc-700 border border-zinc-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <template x-if="block.thumbnail_url">
                                            <img :src="block.thumbnail_url" class="w-full h-full object-cover" alt="">
                                        </template>
                                        <template x-if="!block.thumbnail_url">
                                            <svg class="w-8 h-8 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getBlockIcon(block.type)"/>
                                            </svg>
                                        </template>
                                    </div>

                                    {{-- Block Info --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="font-medium text-white truncate" x-text="block.title || 'Untitled'"></h3>
                                            <span class="block-type-badge" :class="'type-' + block.type" x-text="block.type.replace('_', ' ')"></span>
                                        </div>
                                        <p class="text-sm text-zinc-500 truncate" x-text="getBlockPreview(block)"></p>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2">
                                        <button @click="editBlock(block)" class="p-2 text-zinc-500 hover:text-yellow-400 hover:bg-zinc-700 rounded-lg transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button @click="toggleBlock(block)" class="p-2 text-zinc-500 hover:text-emerald-400 hover:bg-zinc-700 rounded-lg transition" :title="block.is_active ? 'Nonaktifkan' : 'Aktifkan'">
                                            <template x-if="block.is_active">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </template>
                                            <template x-if="!block.is_active">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </template>
                                        </button>
                                        <button @click="deleteBlock(block)" class="p-2 text-zinc-500 hover:text-red-400 hover:bg-zinc-700 rounded-lg transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Right Column: Preview --}}
            <div class="space-y-6">
                <div class="preview-container rounded-xl border p-4 sticky top-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold" style="color: var(--dashboard-text);">Preview</h2>
                        <button @click="refreshPreview()" class="p-2 rounded-lg transition" title="Refresh Preview" style="color: var(--dashboard-text-muted);">
                            <svg class="w-5 h-5" :class="{ 'animate-spin': isRefreshing }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </div>
                    <div class="preview-iframe" style="height: 600px;">
                        <iframe
                            :src="previewUrl"
                            class="w-full h-full rounded-lg"
                            :key="previewKey"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Block Selector Modal --}}
    <div x-show="showBlockSelector" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="showBlockSelector = false">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 modal-backdrop block-selector-backdrop transition-opacity" style="background: rgba(15, 23, 42, 0.35); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);" @click="showBlockSelector = false"></div>
            <div class="relative modal-content block-selector-modal rounded-2xl shadow-xl max-w-2xl w-full p-6 border" style="background-color: #ffffff; border-color: #e2e8f0; color: #0f172a;" @click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold" style="color: var(--dashboard-text);">Add New Block</h2>
                    <button @click="showBlockSelector = false" class="p-2 rounded-lg hover:bg-gray-100 transition" style="color: var(--dashboard-text-muted);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- BASIC Category --}}
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-zinc-500 uppercase tracking-wider mb-3">Basic</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <button @click="selectBlockType('link')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-blue-500 hover:bg-blue-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Link</p>
                            <p class="text-xs text-zinc-500">Tambahkan link shortcut</p>
                        </button>

                        <button @click="selectBlockType('text')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-amber-500 hover:bg-amber-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Text</p>
                            <p class="text-xs text-zinc-500">Tambahkan teks atau headline</p>
                        </button>

                        <button @click="selectBlockType('image')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-emerald-500 hover:bg-emerald-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Image</p>
                            <p class="text-xs text-zinc-500">Tampilkan gambar</p>
                        </button>

                        <button @click="selectBlockType('video')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-pink-500 hover:bg-pink-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-pink-500/20 text-pink-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Video</p>
                            <p class="text-xs text-zinc-500">Embed video YouTube/platform lain</p>
                        </button>

                        <button @click="selectBlockType('social_connect')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-violet-500 hover:bg-violet-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-violet-500/20 text-violet-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1M7.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688zM16.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Social Connect</p>
                            <p class="text-xs text-zinc-500">Tampilkan ikon sosial media</p>
                        </button>
                    </div>
                </div>

                {{-- MONETIZATION Category --}}
                <div>
                    <h3 class="text-sm font-semibold text-zinc-500 uppercase tracking-wider mb-3">Monetization</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="selectBlockType('product')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-yellow-500 hover:bg-yellow-500/10 text-left transition">
                            <div class="w-10 h-10 rounded-lg bg-yellow-500/20 text-yellow-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Produk</p>
                            <p class="text-xs text-zinc-500">Produk dengan CTA WhatsApp</p>
                        </button>

                        <button @click="selectBlockType('digital_product')" class="block-type-btn p-4 rounded-xl border-2 border-zinc-700 hover:border-purple-500 hover:bg-purple-500/10 text-left transition relative" :class="{ 'opacity-50 cursor-not-allowed': !isPro }">
                            @unless($store->isPro())
                            <div class="absolute inset-0 bg-black/60 rounded-xl flex flex-col items-center justify-center z-10">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-purple-400">PRO</span>
                            </div>
                            @endunless
                            <div class="w-10 h-10 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-white">Digital Product</p>
                            <p class="text-xs text-zinc-500">Jual produk digital <span class="text-purple-400 font-medium">(Pro)</span></p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Block Form Modal --}}
    <div x-show="showBlockForm" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="showBlockForm = false">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 modal-backdrop transition-opacity" @click="showBlockForm = false"></div>
            <div class="relative modal-content rounded-2xl shadow-xl max-w-lg w-full p-6" @click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold" style="color: var(--dashboard-text);" x-text="editingBlock ? 'Edit Block' : 'Tambah Block: ' + blockTypeName"></h2>
                    <button @click="showBlockForm = false" class="p-2 rounded-lg hover:bg-gray-100 transition" style="color: var(--dashboard-text-muted);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitBlockForm()">
                    {{-- Hidden Fields --}}
                    <input type="hidden" x-model="formData.page_id">
                    <input type="hidden" x-model="formData.type">
                    <input type="hidden" x-model="formData.id" x-show="editingBlock">

                    {{-- Link Form --}}
                    <template x-if="formData.type === 'link'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" x-model="formData.title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                                <input type="url" x-model="formData.url" required placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" x-model="formData.open_in_new_tab" id="open_in_new_tab" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <label for="open_in_new_tab" class="ml-2 text-sm text-gray-700">Buka di tab baru</label>
                            </div>
                        </div>
                    </template>

                    {{-- Text Form --}}
                    <template x-if="formData.type === 'text'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title (Headline)</label>
                                <input type="text" x-model="formData.title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                <textarea x-model="formData.content_text" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                        </div>
                    </template>

                    {{-- Image Form --}}
                    <template x-if="formData.type === 'image'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                <div class="space-y-3">
                                    <!-- Preview Area - Full Width -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 hover:bg-gray-50 transition cursor-pointer"
                                         @click="$refs.imageFileInput.click()"
                                         @dragover.prevent="isDraggingImage = true"
                                         @dragleave.prevent="isDraggingImage = false"
                                         @drop.prevent="handleImageDrop($event)"
                                         :class="{ 'border-indigo-400 bg-indigo-50': isDraggingImage }">
                                        <template x-if="!formData.thumbnail_url && !imagePreview">
                                            <div>
                                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-sm text-gray-500 font-medium">Klik atau drag & drop untuk upload gambar</p>
                                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF, WebP (maks. 5MB)</p>
                                            </div>
                                        </template>
                                        <template x-if="formData.thumbnail_url">
                                            <div class="relative">
                                                <img :src="formData.thumbnail_url" class="max-h-48 mx-auto rounded-lg shadow-lg" alt="Preview">
                                                <button type="button" @click.stop="clearImageUpload()" class="absolute -top-3 -right-3 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="imagePreview && !formData.thumbnail_url">
                                            <div class="relative">
                                                <div class="max-h-48 mx-auto rounded-lg shadow-lg bg-gray-100 flex items-center justify-center">
                                                    <svg class="animate-spin w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <input type="file" x-ref="imageFileInput" @change="handleImageSelect($event)" accept="image/jpeg,image/png,image/gif,image/webp" class="hidden">
                                </div>
                                <div x-show="isUploading" class="mt-2">
                                    <div class="flex items-center gap-2 text-sm text-indigo-600">
                                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Mengupload...
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                                <input type="text" x-model="formData.alt_text" placeholder="Deskripsi gambar untuk aksesibilitas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Link (Opsional)</label>
                                <input type="url" x-model="formData.image_link" placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <p class="mt-1 text-xs text-gray-400">Jika diisi, gambar akan bisa diklik dan membuka link ini</p>
                            </div>
                        </div>
                    </template>

                    {{-- Video Form --}}
                    <template x-if="formData.type === 'video'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                                <input type="url" x-model="formData.video_url" required placeholder="YouTube atau Vimeo URL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">Supports YouTube & Vimeo</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title (Optional)</label>
                                <input type="text" x-model="formData.title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </template>

                    {{-- Social Connect Form --}}
                    <template x-if="formData.type === 'social_connect'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul (Opsional)</label>
                                <input type="text" x-model="formData.title" placeholder="Contoh: Follow Saya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Platform</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="platform in socialPlatforms" :key="platform.key">
                                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer" :class="{ 'bg-indigo-50 border-indigo-300': formData.socials[platform.key] }">
                                            <input type="checkbox" x-model="formData.socials[platform.key].enabled" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span class="ml-2 text-sm font-medium text-gray-700" x-text="platform.name"></span>
                                            <template x-if="formData.socials[platform.key].enabled">
                                                <div class="w-full ml-2">
                                                    <input type="text" x-model="formData.socials[platform.key].value" :placeholder="platform.placeholder" class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-indigo-500">
                                                    <input type="text" x-model="formData.socials[platform.key].label" placeholder="Nama link" class="w-full mt-1 px-2 py-1 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-indigo-500">
                                                </div>
                                            </template>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Product Form --}}
                    <template x-if="formData.type === 'product' || formData.type === 'digital_product'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                                <input type="text" x-model="formData.title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea x-model="formData.description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                                <input type="text"
                                       :value="formatPriceInput(formData.price)"
                                       inputmode="numeric"
                                       pattern="[0-9]*"
                                       placeholder="Rp.100.000"
                                       @input="formData.price = parsePriceInput($event.target.value); $event.target.value = formatPriceInput(formData.price)"
                                       @blur="$event.target.value = formatPriceInput(formData.price)"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">Ketik angka saja, sistem akan otomatis memformat. Contoh: 100000 menjadi Rp.100.000.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CTA Type</label>
                                <select x-model="formData.cta_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="whatsapp">WhatsApp</option>
                                    <template x-if="formData.type === 'digital_product'">
                                        <option value="checkout">Checkout</option>
                                    </template>
                                </select>
                                <p x-show="formData.type === 'product'" class="text-xs text-gray-500 mt-1">Produk biasa memakai CTA WhatsApp. Checkout tersedia untuk Digital Product.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk (Opsional)</label>
                                <div class="space-y-3">
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 hover:bg-gray-50 transition cursor-pointer"
                                         @click="$refs.productImageFileInput.click()"
                                         @dragover.prevent="isDraggingProductImage = true"
                                         @dragleave.prevent="isDraggingProductImage = false"
                                         @drop.prevent="handleProductImageDrop($event)"
                                         :class="{ 'border-indigo-400 bg-indigo-50': isDraggingProductImage }">
                                        <template x-if="!formData.thumbnail_url && !productImagePreview">
                                            <div>
                                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-sm text-gray-500 font-medium">Klik atau drag & drop untuk upload gambar</p>
                                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF, WebP (maks. 5MB)</p>
                                            </div>
                                        </template>
                                        <template x-if="formData.thumbnail_url">
                                            <div class="relative">
                                                <img :src="formData.thumbnail_url" class="max-h-48 mx-auto rounded-lg shadow-lg" alt="Preview produk">
                                                <button type="button" @click.stop="clearProductImageUpload()" class="absolute -top-3 -right-3 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="productImagePreview && !formData.thumbnail_url">
                                            <div class="relative">
                                                <div class="max-h-48 mx-auto rounded-lg shadow-lg bg-gray-100 flex items-center justify-center">
                                                    <svg class="animate-spin w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <input type="file" x-ref="productImageFileInput" @change="handleProductImageSelect($event)" accept="image/jpeg,image/png,image/gif,image/webp" class="hidden">
                                </div>
                                <div x-show="isUploadingProductImage" class="mt-2">
                                    <div class="flex items-center gap-2 text-sm text-indigo-600">
                                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Mengupload...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" @click="showBlockForm = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition" :disabled="isSubmitting">
                            <span x-show="!isSubmitting" x-text="editingBlock ? 'Simpan Perubahan' : 'Tambah Block'"></span>
                            <span x-show="isSubmitting">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add Page Modal --}}
    <div x-show="showAddPageModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="showAddPageModal = false">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 modal-backdrop transition-opacity" @click="showAddPageModal = false"></div>
            <div class="relative modal-content rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold" style="color: var(--dashboard-text);">Tambah Page Baru</h2>
                    <button @click="showAddPageModal = false" class="p-2 rounded-lg hover:bg-gray-100 transition" style="color: var(--dashboard-text-muted);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitAddPage()">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Page</label>
                            <input type="text" x-model="newPage.title" required placeholder="Contoh: Home, About, Contact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <input type="text" x-model="newPage.slug" required placeholder="contoh-home" pattern="[a-z0-9\-]+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan hyphen (-)</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" @click="showAddPageModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition" :disabled="isSubmitting">
                            <span x-show="!isSubmitting">Tambah Page</span>
                            <span x-show="isSubmitting">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Page Modal --}}
    <div x-show="showEditPageModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="showEditPageModal = false">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 modal-backdrop transition-opacity" @click="showEditPageModal = false"></div>
            <div class="relative modal-content rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold" style="color: var(--dashboard-text);">Edit Page</h2>
                    <button @click="showEditPageModal = false" class="p-2 rounded-lg hover:bg-gray-100 transition" style="color: var(--dashboard-text-muted);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitEditPage()">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Page</label>
                            <input type="text" x-model="editPageData.title" required placeholder="Contoh: Home, About, Contact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <input type="text" x-model="editPageData.slug" required placeholder="contoh-home" pattern="[a-z0-9\-]+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan hyphen (-)</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" @click="showEditPageModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition" :disabled="isSubmitting">
                            <span x-show="!isSubmitting">Simpan Perubahan</span>
                            <span x-show="isSubmitting">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Page Confirmation Modal --}}
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="showDeleteModal = false">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 modal-backdrop transition-opacity" @click="showDeleteModal = false"></div>
            <div class="relative modal-content rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4" style="background-color: rgba(239, 68, 68, 0.1);">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--danger);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--dashboard-text);">Hapus Page?</h3>
                    <p class="text-sm mb-1" style="color: var(--dashboard-text-secondary);">
                        Yakin ingin menghapus page <strong style="color: var(--dashboard-text);" x-text="deletePageData.title"></strong>?
                    </p>
                    <p class="text-sm" style="color: var(--danger);">
                        Block di dalam page ini juga akan dihapus.
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 mt-6">
                    <button @click="showDeleteModal = false" class="px-4 py-2 text-sm font-medium rounded-lg transition" style="background-color: var(--dashboard-input-bg); color: var(--dashboard-text-secondary);">
                        Batal
                    </button>
                    <button @click="confirmDeletePage()" class="px-4 py-2 text-sm font-medium text-white rounded-lg transition" style="background-color: var(--danger);" :disabled="isSubmitting">
                        <span x-show="!isSubmitting">Ya, Hapus</span>
                        <span x-show="isSubmitting">Menghapus...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div x-show="toast.show" x-cloak class="fixed bottom-4 right-4 z-50">
        <div class="flex items-center px-4 py-3 rounded-lg shadow-lg"
             :class="toast.type === 'error' ? 'bg-red-600' : 'bg-green-600'"
             style="color: white;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4">
            <span x-text="toast.message"></span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function blockDashboard() {
    return {
        currentPageId: {{ $defaultPage->id }},
        blocks: [],
        previewUrl: '{{ url('/' . $store->username) }}',
        previewKey: 0,
        isRefreshing: false,
        isSubmitting: false,
        isPro: {{ $store->isPro() ? 'true' : 'false' }},

        showBlockSelector: false,
        showBlockForm: false,
        showAddPageModal: false,
        showEditPageModal: false,
        showDeleteModal: false,
        editingBlock: null,
        blockTypeName: '',

        editPageData: {
            id: null,
            title: '',
            slug: '',
        },

        deletePageData: {
            id: null,
            title: '',
        },

        formData: {
            id: null,
            page_id: {{ $defaultPage->id }},
            type: '',
            title: '',
            url: '',
            open_in_new_tab: true,
            content_text: '',
            alt_text: '',
            video_url: '',
            thumbnail_url: '',
            image_link: '',
            socials: {},
            description: '',
            price: 0,
            cta_type: 'whatsapp',
        },

        isUploading: false,
        isDraggingImage: false,
        imagePreview: null,
        isUploadingProductImage: false,
        isDraggingProductImage: false,
        productImagePreview: null,

        newPage: {
            title: '',
            slug: '',
        },

        socialPlatforms: [
            { key: 'instagram', name: 'Instagram', placeholder: '@username' },
            { key: 'tiktok', name: 'TikTok', placeholder: '@username' },
            { key: 'youtube', name: 'YouTube', placeholder: 'Channel URL' },
            { key: 'twitter', name: 'Twitter/X', placeholder: '@username' },
            { key: 'facebook', name: 'Facebook', placeholder: 'Page URL' },
            { key: 'whatsapp', name: 'WhatsApp', placeholder: '08xxxxxxxxxx' },
            { key: 'telegram', name: 'Telegram', placeholder: '@username' },
            { key: 'linkedin', name: 'LinkedIn', placeholder: 'Profile URL' },
            { key: 'shopee', name: 'Shopee', placeholder: 'Shop URL' },
            { key: 'tokopedia', name: 'Tokopedia', placeholder: 'Shop URL' },
        ],

        toast: {
            show: false,
            message: '',
            type: 'success',
        },

        init() {
            this.loadBlocks();
            this.initSocials();
        },

        initSocials() {
            this.socialPlatforms.forEach(p => {
                this.formData.socials[p.key] = { enabled: false, value: '' };
            });
        },

        handleImageSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.uploadImage(file);
            }
        },

        handleProductImageSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.uploadProductImage(file);
            }
        },

        handleImageDrop(event) {
            this.isDraggingImage = false;
            const file = event.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                this.uploadImage(file);
            }
        },

        handleProductImageDrop(event) {
            this.isDraggingProductImage = false;
            const file = event.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                this.uploadProductImage(file);
            }
        },

        async uploadImage(file) {
            await this.uploadImageFile(file, 'block');
        },

        async uploadProductImage(file) {
            await this.uploadImageFile(file, 'product');
        },

        async uploadImageFile(file, context) {
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                this.showToast('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WebP.', 'error');
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                this.showToast('Ukuran file terlalu besar. Maksimal 5MB.', 'error');
                return;
            }

            if (context === 'product') {
                this.isUploadingProductImage = true;
            } else {
                this.isUploading = true;
            }

            // Show preview immediately using FileReader
            const reader = new FileReader();
            reader.onload = (e) => {
                if (context === 'product') {
                    this.productImagePreview = e.target.result;
                } else {
                    this.imagePreview = e.target.result;
                }
            };
            reader.readAsDataURL(file);

            // Use FormData for upload
            const formData = new FormData();
            formData.append('image', file);
            formData.append('context', context);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

                const response = await fetch('/seller/upload/image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                });

                const data = await response.json();
                console.log('Upload response:', data);

                if (data.success) {
                    this.formData.thumbnail_url = data.url;
                    if (context === 'product') {
                        this.productImagePreview = null;
                    } else {
                        this.imagePreview = null;
                    }
                    this.showToast('Gambar berhasil diupload!');
                } else {
                    this.showToast(data.error || 'Gagal upload gambar', 'error');
                    if (context === 'product') {
                        this.productImagePreview = null;
                    } else {
                        this.imagePreview = null;
                    }
                }
            } catch (error) {
                console.error('Upload error:', error);
                this.showToast('Gagal upload gambar: ' + error.message, 'error');
                if (context === 'product') {
                    this.productImagePreview = null;
                } else {
                    this.imagePreview = null;
                }
            } finally {
                if (context === 'product') {
                    this.isUploadingProductImage = false;
                } else {
                    this.isUploading = false;
                }
            }
        },

        clearImageUpload() {
            this.formData.thumbnail_url = '';
            this.imagePreview = null;
            // Reset file input
            const fileInput = this.$refs.imageFileInput;
            if (fileInput) {
                fileInput.value = '';
            }
        },

        clearProductImageUpload() {
            this.formData.thumbnail_url = '';
            this.productImagePreview = null;

            const fileInput = this.$refs.productImageFileInput;
            if (fileInput) {
                fileInput.value = '';
            }
        },

        loadBlocks() {
            fetch(`/seller/dashboard/blocks/${this.currentPageId}`)
                .then(r => r.json())
                .then(data => {
                    this.blocks = data.blocks;
                })
                .catch(err => this.showToast('Gagal memuat blocks', 'error'));
        },

        switchPage(pageId) {
            this.currentPageId = pageId;
            this.formData.page_id = pageId;
            this.loadBlocks();
            this.refreshPreview();
        },

        refreshPreview() {
            this.isRefreshing = true;
            this.previewKey++;
            this.previewUrl = '{{ url('/' . $store->username) }}' + '?preview=' + Date.now();
            setTimeout(() => { this.isRefreshing = false; }, 1000);
        },

        copyUrl() {
            navigator.clipboard.writeText('{{ url('/' . $store->username) }}').then(() => {
                this.showToast('URL berhasil disalin!');
            });
        },

        getBlockIcon(type) {
            const icons = {
                link: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
                text: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                image: 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                video: 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
                social_connect: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1M7.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688zM16.844 8.752a.844.844 0 100-1.688.844.844 0 000 1.688z',
                product: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                digital_product: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            };
            return icons[type] || icons.link;
        },

        getBlockPreview(block) {
            try {
                const content = block.content ? JSON.parse(block.content) : {};
                switch (block.type) {
                    case 'link': return content.url || 'No URL';
                    case 'text': return content.text || 'No content';
                    case 'image': return content.alt || 'No alt text';
                    case 'video': return content.embed_url || content.video_url || 'No video';
                    case 'social_connect': return 'Social links';
                    case 'product': return content.price ? 'Rp ' + Number(content.price).toLocaleString('id-ID') : 'No price';
                    case 'digital_product': return content.price ? 'Rp ' + Number(content.price).toLocaleString('id-ID') : 'No price';
                    default: return '';
                }
            } catch (e) {
                return block.content || '';
            }
        },

        selectBlockType(type) {
            // Check PRO restriction for digital_product
            if (type === 'digital_product' && !this.isPro) {
                this.showProUpgradeMessage();
                return;
            }

            this.formData.type = type;
            this.formData.id = null;
            this.editingBlock = null;
            this.blockTypeName = type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());

            // Reset form data
            this.formData.title = '';
            this.formData.url = '';
            this.formData.open_in_new_tab = true;
            this.formData.content_text = '';
            this.formData.alt_text = '';
            this.formData.video_url = '';
            this.formData.thumbnail_url = '';
            this.formData.image_link = '';
            this.formData.description = '';
            this.formData.price = 0;
            this.formData.cta_type = this.getDefaultCtaType(type);
            this.normalizeCtaTypeForBlockType();
            this.imagePreview = null;
            this.productImagePreview = null;
            this.initSocials();

            this.showBlockSelector = false;
            this.showBlockForm = true;
        },

        showProUpgradeMessage() {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 flex items-center gap-3';
            toast.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Upgrade ke PRO untuk membuat Digital Product!</span>
                <a href="{{ route('seller.upgrade') }}" class="ml-2 px-3 py-1 bg-white text-purple-600 rounded-md text-sm font-semibold hover:bg-gray-100">Upgrade</a>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        },

        showBlockLimitMessage() {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 flex items-center gap-3';
            toast.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Batas maksimal 5 block tercapai!</span>
                <a href="{{ route('seller.upgrade') }}" class="ml-2 px-3 py-1 bg-white text-purple-600 rounded-md text-sm font-semibold hover:bg-gray-100">Upgrade PRO</a>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        },

        handleAddBlock() {
            if (!this.isPro && this.blocks.length >= 5) {
                this.showBlockLimitMessage();
            } else {
                this.showBlockSelector = true;
            }
        },

        getAddBlockClass() {
            if (!this.isPro && this.blocks.length >= 5) {
                return 'opacity-50 cursor-not-allowed bg-gray-600 text-gray-400';
            }
            return 'bg-yellow-500 text-black hover:bg-yellow-400';
        },

        editBlock(block) {
            this.editingBlock = block;
            this.formData.id = block.id;
            this.formData.type = block.type;
            this.formData.title = block.title || '';
            this.formData.thumbnail_url = block.thumbnail_url || '';
            this.formData.image_link = '';
            this.blockTypeName = block.type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
            this.imagePreview = null;
            this.productImagePreview = null;

            // Parse content
            try {
                const content = block.content ? JSON.parse(block.content) : {};
                this.formData.url = content.url || '';
                this.formData.open_in_new_tab = content.open_in_new_tab !== undefined ? content.open_in_new_tab : true;
                this.formData.content_text = content.text || '';
                this.formData.alt_text = content.alt || '';
                this.formData.video_url = content.video_url || '';
                this.formData.image_link = content.link || '';
                this.formData.description = content.description || '';
                this.formData.price = content.price || 0;
                this.formData.cta_type = content.cta_type || this.getDefaultCtaType(block.type);
                this.normalizeCtaTypeForBlockType();

                // Socials
                if (content.socials) {
                    this.initSocials();
                    Object.keys(content.socials).forEach(key => {
                        if (this.formData.socials[key]) {
                            this.formData.socials[key] = content.socials[key];
                        }
                    });
                }
            } catch (e) {
                console.error('Error parsing block content', e);
            }

            this.showBlockForm = true;
        },

        submitBlockForm() {
            this.isSubmitting = true;

            // Build content JSON based on type
            let content = {};
            switch (this.formData.type) {
                case 'link':
                    content = { url: this.formData.url, open_in_new_tab: this.formData.open_in_new_tab };
                    break;
                case 'text':
                    content = { text: this.formData.content_text };
                    break;
                case 'image':
                    // Allow either URL or uploaded image, alt is required for accessibility
                    if (!this.formData.thumbnail_url && !this.imagePreview) {
                        this.showToast('Harap upload atau masukkan URL gambar', 'error');
                        this.isSubmitting = false;
                        return;
                    }
                    content = { alt: this.formData.alt_text, thumbnail_url: this.formData.thumbnail_url, link: this.formData.image_link };
                    break;
                case 'video':
                    content = { video_url: this.formData.video_url, embed_url: this.extractEmbedUrl(this.formData.video_url) };
                    break;
                case 'social_connect':
                    const socials = {};
                    this.socialPlatforms.forEach(platform => {
                        const social = this.formData.socials[platform.key] || {};
                        const value = (social.value || '').trim();
                        if (social.enabled && value) {
                            socials[platform.key] = {
                                enabled: true,
                                value,
                                label: (social.label || '').trim(),
                            };
                        }
                    });
                    if (Object.keys(socials).length === 0) {
                        this.showToast('Pilih minimal satu platform sosial dan isi link/username.', 'error');
                        this.isSubmitting = false;
                        return;
                    }
                    content = { socials };
                    break;
                case 'product':
                case 'digital_product':
                    this.normalizeCtaTypeForBlockType();
                    content = {
                        description: this.formData.description,
                        price: this.formData.price,
                        cta_type: this.formData.cta_type || this.getDefaultCtaType(this.formData.type),
                    };
                    break;
            }

            const payload = {
                page_id: this.formData.page_id,
                type: this.formData.type,
                title: this.formData.title,
                content: JSON.stringify(content),
                thumbnail_url: this.formData.thumbnail_url,
                is_active: true,
            };

            const url = this.editingBlock
                ? `/seller/dashboard/blocks/${this.editingBlock.id}`
                : '/seller/dashboard/blocks';
            const method = this.editingBlock ? 'PATCH' : 'POST';

            fetch(url, {
                method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(payload),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.showBlockForm = false;
                    this.loadBlocks();
                    this.refreshPreview();
                } else {
                    this.showToast(data.error || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(err => {
                this.showToast('Terjadi kesalahan', 'error');
            })
            .finally(() => { this.isSubmitting = false; });
        },

        getDefaultCtaType(type) {
            return type === 'digital_product' ? 'checkout' : 'whatsapp';
        },

        normalizeCtaTypeForBlockType() {
            if (this.formData.type === 'product') {
                this.formData.cta_type = 'whatsapp';
            }
            if (this.formData.type === 'digital_product' && !['whatsapp', 'checkout'].includes(this.formData.cta_type)) {
                this.formData.cta_type = 'checkout';
            }
        },

        parsePriceInput(value) {
            return String(value ?? '').replace(/\D/g, '');
        },

        formatPriceInput(value) {
            const digits = this.parsePriceInput(value);

            if (!digits || Number(digits) === 0) {
                return '';
            }

            return 'Rp.' + Number(digits).toLocaleString('id-ID');
        },

        extractEmbedUrl(url) {
            // YouTube
            let match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
            if (match) return 'https://www.youtube.com/embed/' + match[1];

            // Vimeo
            match = url.match(/vimeo\.com\/(\d+)/);
            if (match) return 'https://player.vimeo.com/video/' + match[1];

            return url;
        },

        toggleBlock(block) {
            fetch(`/seller/dashboard/blocks/${block.id}/toggle`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.loadBlocks();
                    this.refreshPreview();
                }
            });
        },

        deleteBlock(block) {
            if (!confirm('Yakin ingin menghapus block ini?')) return;

            fetch(`/seller/dashboard/blocks/${block.id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.loadBlocks();
                    this.refreshPreview();
                }
            });
        },

        moveBlock(index, direction) {
            const newIndex = index + direction;
            if (newIndex < 0 || newIndex >= this.blocks.length) return;

            const blockIds = this.blocks.map(b => b.id);
            const movedId = blockIds.splice(index, 1)[0];
            blockIds.splice(newIndex, 0, movedId);

            fetch('/seller/dashboard/blocks/reorder', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ block_ids: blockIds }),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.loadBlocks();
                    this.refreshPreview();
                }
            });
        },

        submitAddPage() {
            this.isSubmitting = true;

            fetch('/seller/dashboard/pages', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(this.newPage),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.showAddPageModal = false;
                    window.location.reload();
                } else {
                    this.showToast(data.error || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(err => {
                this.showToast('Terjadi kesalahan', 'error');
            })
            .finally(() => { this.isSubmitting = false; });
        },

        openEditPageModal(pageId, title, slug) {
            this.editPageData = {
                id: pageId,
                title: title,
                slug: slug,
            };
            this.showEditPageModal = true;
        },

        submitEditPage() {
            this.isSubmitting = true;

            fetch(`/seller/dashboard/pages/${this.editPageData.id}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({
                    title: this.editPageData.title,
                    slug: this.editPageData.slug,
                }),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.showEditPageModal = false;
                    window.location.reload();
                } else {
                    this.showToast(data.error || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(err => {
                this.showToast('Terjadi kesalahan', 'error');
            })
            .finally(() => { this.isSubmitting = false; });
        },

        openDeleteModal(pageId, title) {
            this.deletePageData = {
                id: pageId,
                title: title,
            };
            this.showDeleteModal = true;
        },

        confirmDeletePage() {
            this.isSubmitting = true;

            fetch(`/seller/dashboard/pages/${this.deletePageData.id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showToast(data.message);
                    this.showDeleteModal = false;
                    window.location.reload();
                } else {
                    this.showToast(data.error || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(err => {
                this.showToast('Terjadi kesalahan', 'error');
            })
            .finally(() => { this.isSubmitting = false; });
        },

        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => { this.toast.show = false; }, 3000);
        },
    };
}
</script>
@endpush
