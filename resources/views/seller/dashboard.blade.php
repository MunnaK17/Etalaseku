@extends('layouts.seller')

@section('title', 'Home - EtalaseKu')
@section('breadcrumb', 'Home')

@section('content')
<div class="py-6">

    <!-- Main Grid: Account Left + Earnings Right -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <!-- Account Section (Left - 2 cols) -->
        <div class="lg:col-span-2">
            <div class="card p-5">
                <div class="card-header px-5 py-4 flex items-center justify-between border-b">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-semibold text-title">Account</h3>
                        @if($store->is_inclusive_seller && $store->isPro())
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 badge-inclusive rounded-full text-xs font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Inclusive Seller
                            </span>
                        @endif
                    </div>
                    @unless($store->isPro())
                        <a href="{{ route('seller.upgrade') }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 btn-upgrade rounded-lg text-xs font-semibold transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Upgrade to PRO
                        </a>
                    @endunless
                </div>
                <div class="p-5">
                    <div class="flex items-start gap-5">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if($store->logo)
                                <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="h-20 w-20 rounded-full object-cover border-2 border-theme">
                            @else
                                <div class="h-20 w-20 rounded-full bg-yellow-500/20 flex items-center justify-center border-2 border-yellow-500/30">
                                    <span class="text-xs text-accent font-medium">200 x 200</span>
                                </div>
                            @endif
                        </div>
                        <!-- Info -->
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-title">{{ auth()->user()->name ?? 'Seller' }}</h2>
                            <p class="text-sm text-accent mt-0.5">{{ $store->public_url }}</p>
                            <div class="mt-2 flex items-center gap-2 flex-wrap">
                                @if($store->is_inclusive_seller && $store->isPro())
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 badge-inclusive rounded-full text-xs font-semibold">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        Inclusive (Pro)
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs text-caption">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $store->inclusive_expiry_days }} hari tersisa
                                    </span>
                                @elseif($store->isPro())
                                    <span class="inline-flex items-center px-2 py-0.5 badge-pro rounded-full text-xs font-semibold">Pro</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 bg-tertiary text-caption rounded-full text-xs font-semibold">Free</span>
                                @endif
                            </div>
                            <button onclick="copyLink()" class="inline-flex items-center gap-1.5 px-3 py-1.5 btn-share rounded-lg text-xs font-semibold hover:border-accent hover:text-accent transition mt-3">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.3682.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start creating now! -->
            <div class="mt-6">
                <h3 class="text-base font-bold text-title mb-3">Start creating now!</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <a href="{{ route('seller.dashboard') }}#blocks" class="action-card flex flex-col items-center justify-center p-4 hover:border-accent transition group">
                        <div class="action-card-icon w-10 h-10 rounded-xl flex items-center justify-center mb-2 transition">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a44 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold action-card-text text-center">Add Link</span>
                    </a>

                    <a href="{{ route('seller.dashboard') }}#blocks" class="action-card flex flex-col items-center justify-center p-4 hover:border-accent transition group">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center mb-2 group-hover:bg-blue-500/20 transition">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M93v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold action-card-text text-center">Digital Product</span>
                    </a>

                    <a href="#" class="action-card flex flex-col items-center justify-center p-4 hover:border-accent transition group">
                        <div class="w-10 h-10 bg-purple-500/10 rounded-xl flex items-center justify-center mb-2 group-hover:bg-purple-500/20 transition">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1920H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold action-card-text text-center">Blog Content</span>
                    </a>

                    <a href="#" class="action-card flex flex-col items-center justify-center p-4 hover:border-accent transition group">
                        <div class="w-10 h-10 bg-orange-500/10 rounded-xl flex items-center justify-center mb-2 group-hover:bg-orange-500/20 transition">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1510l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold action-card-text text-center">Course Video</span>
                    </a>

                    <a href="#" class="action-card flex flex-col items-center justify-center p-4 hover:border-accent transition group">
                        <div class="w-10 h-10 bg-pink-500/10 rounded-xl flex items-center justify-center mb-2 group-hover:bg-pink-500/20 transition">
                            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold action-card-text text-center">Media Kit</span>
                    </a>
                </div>
            </div>

            <!-- Total Views & Clicks -->
            <div class="card mt-6 overflow-hidden">
                <div class="card-header px-5 py-4 flex items-center justify-between border-b">
                    <h3 class="text-sm font-semibold text-title">Total Views & Clicks</h3>
                    <!-- Date Selector -->
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <svg class="w-4 h-4 text-caption absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <input type="text" placeholder="Select Date.."
                                   class="input pl-9 pr-3 py-1.5 text-xs rounded-lg cursor-pointer w-36">
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <!-- Stats Row -->
                    <div class="flex items-center gap-6 mb-4">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full chart-bar-views"></div>
                            <span class="text-xs text-caption">Views</span>
                            <span class="text-sm font-bold text-title">{{ number_format($stats['total_views']) }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full chart-bar-clicks"></div>
                            <span class="text-xs text-caption">Clicks</span>
                            <span class="text-sm font-bold text-title">{{ number_format($stats['product_clicks']) }}</span>
                        </div>
                    </div>
                    <!-- Bar Chart -->
                    <div class="flex items-end gap-2 h-28">
                        @php
                            $chartData = $stats['chart_data'] ?? [];
                            $views = array_column($chartData, 'views');
                            $clicks = array_column($chartData, 'clicks');
                            $maxVal = max(max($views ?: [0]), max($clicks ?: [0]), 1);
                        @endphp
                        @forelse($chartData as $day)
                            <div class="flex-1 flex flex-col items-center gap-1 h-full justify-end">
                                <div class="w-full flex flex-col items-center gap-0.5">
                                    @if(($day['views'] ?? 0) > 0)
                                        <div class="w-full chart-bar-views rounded-sm" style="height: {{ max(4, intval($day['views']) / max(1, $maxVal) * 80) }}px; min-height: 4px;"></div>
                                    @endif
                                    @if(($day['clicks'] ?? 0) > 0)
                                        <div class="w-full chart-bar-clicks rounded-sm" style="height: {{ max(4, intval($day['clicks']) / max(1, $maxVal) * 80) }}px; min-height: 4px;"></div>
                                    @endif
                                </div>
                                <span class="text-[10px] text-caption">{{ \Carbon\Carbon::parse($day['date'])->format('d M') }}</span>
                            </div>
                        @empty
                            <div class="flex-1 flex items-center justify-center h-full">
                                <span class="text-xs text-caption">Tidak ada data</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Earnings + PayMe -->
        <div class="space-y-6">
            <!-- Earnings Card -->
            <div class="card overflow-hidden">
                <div class="card-accent-header px-5 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold">Earnings</h3>
                        <span class="text-xs opacity-60 font-medium">IDR</span>
                    </div>
                    <p class="text-3xl font-bold mt-1">--.--</p>
                </div>
                <div class="p-5">
                    <a href="{{ route('seller.store.edit') }}#payout" class="flex items-center justify-between text-sm text-subtitle hover:text-accent transition">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Payout Setting Page
                        </span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- PayMe Link Card -->
            <div class="card overflow-hidden">
                <div class="card-header px-5 py-4 border-b">
                    <h3 class="text-sm font-semibold text-title">PayMe link</h3>
                </div>
                <div class="p-5">
                    <p class="text-xs text-caption mb-3">Verify your account to activate</p>
                    <input type="text" placeholder="PayMe link"
                           class="input w-full px-3 py-2 text-sm rounded-lg cursor-not-allowed"
                           readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Lifetime Sales -->
        <div class="stat-card p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-caption" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <h3 class="text-xs font-medium stat-label">Lifetime Sales (IDR)</h3>
            </div>
            <p class="text-2xl font-bold stat-value">{{ number_format($stats['total_earnings'] ?? 0) }}</p>
        </div>

        <!-- My Blocks -->
        <div class="stat-card p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-caption" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-xs font-medium stat-label">My Blocks</h3>
            </div>
            <p class="text-2xl font-bold stat-value">{{ number_format($stats['total_blocks']) }}</p>
        </div>

        <!-- Affiliate Products -->
        <div class="stat-card p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-caption" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xs font-medium stat-label">Affiliate Products</h3>
            </div>
            <p class="text-2xl font-bold stat-value">0</p>
        </div>

        <!-- Lifetime Orders -->
        <div class="stat-card p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-caption" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-xs font-medium stat-label">Lifetime Orders</h3>
            </div>
            <p class="text-2xl font-bold stat-value">{{ number_format($stats['total_orders'] ?? 0) }}</p>
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
            btn.classList.remove('btn-share');
            btn.classList.add('btn-accent');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('btn-accent');
                btn.classList.add('btn-share');
            }, 2000);
        });
    }
</script>
@endpush
@endsection
