@extends('layouts.admin')

@section('title', 'Permohonan Inclusive - Admin')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Permohonan Inclusive</h1>
            <p class="mt-1 text-sm" style="color: var(--text-muted);">Kelola permohonan Program Inclusive dari penyandang disabilitas</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="mb-6 grid gap-4 sm:grid-cols-4">
        @php
            $pending = $applications->where('status', 'pending')->count();
            $approved = $applications->where('status', 'approved')->count();
            $rejected = $applications->where('status', 'rejected')->count();
        @endphp
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Menunggu Review</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--warning);">{{ $pending }}</p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Disetujui</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--success);">{{ $approved }}</p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Ditolak</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--error);">{{ $rejected }}</p>
        </div>
        <div class="rounded-xl border p-4" style="background: var(--card-bg); border-color: var(--border-color);">
            <p class="text-sm" style="color: var(--text-muted);">Total</p>
            <p class="mt-1 text-2xl font-bold" style="color: var(--text-primary);">{{ $applications->total() }}</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-4 flex gap-2">
        <a href="{{ request()->url() }}"
           class="rounded-lg px-4 py-2 text-sm font-medium transition {{ !request('status') ? '' : '' }}"
           style="{{ !request('status') ? 'background: var(--accent); color: #000;' : 'background: var(--bg-tertiary); color: var(--text-secondary);' }}">
            Semua
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="{{ request('status') === 'pending' ? 'background: var(--warning); color: #000;' : 'background: var(--bg-tertiary); color: var(--text-secondary);' }}">
            Menunggu
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'approved']) }}"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="{{ request('status') === 'approved' ? 'background: var(--success); color: #fff;' : 'background: var(--bg-tertiary); color: var(--text-secondary);' }}">
            Disetujui
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'rejected']) }}"
           class="rounded-lg px-4 py-2 text-sm font-medium transition"
           style="{{ request('status') === 'rejected' ? 'background: var(--error); color: #fff;' : 'background: var(--bg-tertiary); color: var(--text-secondary);' }}">
            Ditolak
        </a>
    </div>

    <!-- Applications List -->
    <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: var(--bg-secondary);">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Applicant</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Jenis Disabilitas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color: var(--text-muted);">Dokumen</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase" style="color: var(--text-muted);">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr class="border-t transition hover:opacity-80" style="border-color: var(--border-color);">
                            <td class="px-4 py-4">
                                <div>
                                    <p class="font-medium" style="color: var(--text-primary);">{{ $app->applicant_name }}</p>
                                    <p class="text-sm" style="color: var(--text-muted);">{{ $app->email }}</p>
                                    <p class="text-sm" style="color: var(--text-muted);">{{ $app->whatsapp }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" style="background: var(--accent-light); color: var(--accent);">
                                    {{ $app->disability_type_display }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm" style="color: var(--text-secondary);">
                                {{ $app->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $app->status_badge_class }}">
                                    {{ $app->status_display }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2">
                                    @if($app->ktp_file)
                                        <a href="{{ Storage::url($app->ktp_file) }}" target="_blank"
                                           class="rounded px-2 py-1 text-xs font-medium transition"
                                           style="background: var(--bg-tertiary); color: var(--text-secondary);">
                                            KTP
                                        </a>
                                    @endif
                                    @if($app->certificate_file)
                                        <a href="{{ Storage::url($app->certificate_file) }}" target="_blank"
                                           class="rounded px-2 py-1 text-xs font-medium transition"
                                           style="background: var(--bg-tertiary); color: var(--text-secondary);">
                                            Sertifikat
                                        </a>
                                    @endif
                                    @if(!$app->hasDocuments())
                                        <span class="text-xs" style="color: var(--text-muted);">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.inclusive-applications.show', $app) }}"
                                   class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-medium transition"
                                   style="background: var(--accent-light); color: var(--accent);">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center" style="color: var(--text-muted);">
                                <svg class="mx-auto mb-3 h-12 w-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>Belum ada permohonan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="border-t px-4 py-3" style="border-color: var(--border-color);">
                {{ $applications->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection