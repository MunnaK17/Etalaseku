@extends('layouts.admin')

@section('title', 'Detail Permohonan Inclusive - Admin')

@section('content')
<div class="p-6">
    <!-- Back Button -->
    <a href="{{ route('admin.inclusive-applications.index') }}" class="inline-flex items-center gap-2 text-sm mb-6 transition" style="color: var(--text-secondary);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Applicant Info -->
            <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
                <div class="px-6 py-4 border-b" style="border-color: var(--border-color); background: var(--bg-secondary);">
                    <h2 class="text-lg font-semibold" style="color: var(--text-primary);">Informasi Pemohon</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm" style="color: var(--text-muted);">Nama Lengkap</p>
                            <p class="font-medium" style="color: var(--text-primary);">{{ $application->applicant_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm" style="color: var(--text-muted);">Email</p>
                            <p class="font-medium" style="color: var(--text-primary);">{{ $application->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm" style="color: var(--text-muted);">WhatsApp</p>
                            <p class="font-medium" style="color: var(--text-primary);">{{ $application->whatsapp }}</p>
                        </div>
                        <div>
                            <p class="text-sm" style="color: var(--text-muted);">Jenis Disabilitas</p>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" style="background: var(--accent-light); color: var(--accent);">
                                {{ $application->disability_type_display }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm" style="color: var(--text-muted);">Tanggal Pengajuan</p>
                            <p class="font-medium" style="color: var(--text-primary);">{{ $application->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if($application->user_id && $application->store)
<div>
    <p class="text-sm" style="color: var(--text-muted);">User Account</p>
    <a href="{{ route('admin.stores.show', $application->store->id) }}"
       class="inline-flex items-center gap-1 text-sm font-medium" style="color: var(--accent);">
        Lihat User ->
    </a>
</div>
@endif
                    </div>
                </div>
            </div>

            <!-- Documents -->
            @if($application->ktp_file || $application->certificate_file)
            <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
                <div class="px-6 py-4 border-b" style="border-color: var(--border-color); background: var(--bg-secondary);">
                    <h2 class="text-lg font-semibold" style="color: var(--text-primary);">Dokumen Bukti</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        @if($application->ktp_file)
                        <div class="rounded-lg border p-4" style="border-color: var(--border-color);">
                            <p class="text-sm font-medium mb-2" style="color: var(--text-primary);">KTP</p>
                            <a href="{{ Storage::url($application->ktp_file) }}" target="_blank"
                               class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition"
                               style="background: var(--accent); color: #000;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat KTP
                            </a>
                        </div>
                        @endif
                        @if($application->certificate_file)
                        <div class="rounded-lg border p-4" style="border-color: var(--border-color);">
                            <p class="text-sm font-medium mb-2" style="color: var(--text-primary);">Sertifikat</p>
                            <a href="{{ Storage::url($application->certificate_file) }}" target="_blank"
                               class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition"
                               style="background: var(--accent); color: #000;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Sertifikat
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Reason -->
            <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
                <div class="px-6 py-4 border-b" style="border-color: var(--border-color); background: var(--bg-secondary);">
                    <h2 class="text-lg font-semibold" style="color: var(--text-primary);">Ceritakan Kisah Anda</h2>
                </div>
                <div class="p-6">
                    <p class="whitespace-pre-wrap" style="color: var(--text-secondary);">{{ $application->reason }}</p>
                </div>
            </div>

            @if($application->expected_benefits)
            <div class="rounded-xl border overflow-hidden" style="background: var(--card-bg); border-color: var(--border-color);">
                <div class="px-6 py-4 border-b" style="border-color: var(--border-color); background: var(--bg-secondary);">
                    <h2 class="text-lg font-semibold" style="color: var(--text-primary);">Manfaat yang Diharapkan</h2>
                </div>
                <div class="p-6">
                    <p class="whitespace-pre-wrap" style="color: var(--text-secondary);">{{ $application->expected_benefits }}</p>
                </div>
            </div>
            @endif

            @if($application->rejection_reason)
            <div class="rounded-xl border overflow-hidden" style="background: rgba(239, 68, 68, 0.05); border-color: var(--error);">
                <div class="px-6 py-4 border-b" style="border-color: var(--border-color);">
                    <h2 class="text-lg font-semibold" style="color: var(--error);">Alasan Penolakan</h2>
                </div>
                <div class="p-6">
                    <p class="whitespace-pre-wrap" style="color: var(--text-secondary);">{{ $application->rejection_reason }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="rounded-xl border p-6" style="background: var(--card-bg); border-color: var(--border-color);">
                <h3 class="font-semibold mb-4" style="color: var(--text-primary);">Status</h3>
                <span class="inline-flex px-3 py-1.5 rounded-full text-sm font-semibold {{ $application->status_badge_class }}">
                    {{ $application->status_display }}
                </span>

                @if($application->reviewed_at)
                    <p class="text-sm mt-4" style="color: var(--text-muted);">
                        Direview: {{ $application->reviewed_at->format('d M Y, H:i') }}
                    </p>
                @endif
            </div>

            <!-- Actions -->
            @if($application->status === 'pending')
                <div class="rounded-xl border p-6" style="background: var(--card-bg); border-color: var(--border-color);">
                    <h3 class="font-semibold mb-4" style="color: var(--text-primary);">Aksi</h3>

                    <!-- Approve Form -->
                    <form action="{{ route('admin.inclusive-applications.approve', $application) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Catatan (opsional)</label>
                            <textarea name="admin_notes" rows="2"
                                      class="w-full rounded-lg text-sm"
                                      style="background: var(--bg-tertiary); border: 1px solid var(--border-color); color: var(--text-primary);"
                                      placeholder="Catatan untuk disetujui..."></textarea>
                        </div>
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-emerald-700">
                            Setujui & Buat Account
                        </button>
                    </form>

                    <!-- Reject Form -->
                    <form action="{{ route('admin.inclusive-applications.reject', $application) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Alasan Penolakan <span style="color: var(--error);">*</span></label>
                            <textarea name="rejection_reason" rows="2" required
                                      class="w-full rounded-lg text-sm"
                                      style="background: var(--bg-tertiary); border: 1px solid var(--border-color); color: var(--text-primary);"
                                      placeholder="Jelaskan alasan penolakan..."></textarea>
                        </div>
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-red-700 focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                            Tolak
                        </button>
                    </form>
                </div>

                <div class="rounded-lg border p-4" style="background: rgba(245, 158, 11, 0.1); border-color: var(--warning);">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" style="color: var(--warning);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs" style="color: var(--text-secondary);">
                            <strong>Catatan:</strong> Dengan menyetujui, sistem akan membuatkan user account dan store baru secara otomatis.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Info Card -->
            @if($application->user_id && $application->store)
            <div class="rounded-xl border p-6" style="background: var(--card-bg); border-color: var(--border-color);">
                <h3 class="font-semibold mb-4" style="color: var(--text-primary);">Account yang Dibuat</h3>
                <div class="flex items-center gap-3 mb-4">
                    @if($application->store->logo)
                        <img src="{{ $application->store->logo }}" alt="" class="w-12 h-12 rounded-lg object-cover">
                    @else
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: var(--accent-light);">
                            <span class="font-bold" style="color: var(--accent);">{{ substr($application->store->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="font-medium" style="color: var(--text-primary);">{{ $application->store->name }}</p>
                        <p class="text-xs" style="color: var(--text-muted);">{{ $application->store->username }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm" style="color: var(--text-secondary);">
                    <div class="flex justify-between">
                        <span>Plan</span>
                        <span class="font-medium" style="color: var(--accent);">Pro (Inclusive)</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Berlaku hingga</span>
                        <span class="font-medium">{{ $application->store->plan_expires_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
