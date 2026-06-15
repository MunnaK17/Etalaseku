@extends('layouts.admin')

@section('title', 'Verifikasi Seller - Admin EtalaseKu')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Verifikasi Seller</h1>
        <p class="mt-1 text-sm text-gray-500">Review dan approve dokumen verifikasi seller</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['verified'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <form action="{{ route('admin.verifications.index') }}" method="GET" class="flex gap-2">
                    <div class="relative flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nama, NIK, atau toko..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.verifications.index', ['status' => request('status')]) }}"
                           class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Status Filter Tabs -->
            <div class="flex gap-1 bg-gray-100 p-1 rounded-lg">
                <a href="{{ route('admin.verifications.index', request()->except('status')) }}"
                   class="px-4 py-2 rounded-md text-sm font-medium transition {{ !request('status') ? 'bg-white text-gray-900 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Semua
                </a>
                <a href="{{ route('admin.verifications.index', array_merge(request()->except('status'), ['status' => 'pending'])) }}"
                   class="px-4 py-2 rounded-md text-sm font-medium transition flex items-center gap-1 {{ request('status') === 'pending' ? 'bg-white text-amber-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Pending
                    @if($stats['pending'] > 0)
                        <span class="px-1.5 py-0.5 text-xs bg-amber-500 text-white rounded-full">{{ $stats['pending'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.verifications.index', array_merge(request()->except('status'), ['status' => 'verified'])) }}"
                   class="px-4 py-2 rounded-md text-sm font-medium transition {{ request('status') === 'verified' ? 'bg-white text-green-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Verified
                </a>
                <a href="{{ route('admin.verifications.index', array_merge(request()->except('status'), ['status' => 'rejected'])) }}"
                   class="px-4 py-2 rounded-md text-sm font-medium transition {{ request('status') === 'rejected' ? 'bg-white text-red-600 shadow' : 'text-gray-600 hover:text-gray-900' }}">
                    Rejected
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Seller
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Toko
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dokumen
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($verifications as $verification)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <span class="text-indigo-600 font-semibold">{{ substr($verification->full_name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $verification->full_name ?? '-' }}</div>
                                    <div class="text-sm text-gray-500">NIK: {{ $verification->nik ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $verification->store->name ?? '-' }}</div>
                            <div class="text-sm text-gray-500">{{ '@' . ($verification->store->username ?? '-') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2">
                                @if($verification->ktp_path)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">KTP</span>
                                @endif
                                @if($verification->npwp_path)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">NPWP</span>
                                @endif
                                @if($verification->siu_path)
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">SIU</span>
                                @endif
                                @if($verification->selfie_with_ktp_path)
                                    <span class="px-2 py-1 text-xs bg-purple-100 text-purple-700 rounded-full">Selfie</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $verification->status_badge_class }}">
                                {{ $verification->status_display }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($verification->submitted_at)
                                <div>{{ $verification->submitted_at->format('d M Y') }}</div>
                                <div class="text-xs">{{ $verification->submitted_at->format('H:i') }}</div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.verifications.show', $verification) }}"
                               class="text-indigo-600 hover:text-indigo-900">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500">Tidak ada data verifikasi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($verifications->hasPages())
        <div class="mt-4">
            {{ $verifications->links() }}
        </div>
    @endif
</div>
@endsection
