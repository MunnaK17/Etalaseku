@extends('layouts.admin')

@section('title', 'Detail Verifikasi Seller - Admin EtalaseKu')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.verifications.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Detail Verifikasi Seller</h1>
        </div>
        <div>
            <span class="px-3 py-1.5 text-sm font-medium rounded-full {{ $verification->status_badge_class }}">
                {{ $verification->status_display }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Personal
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="text-base font-medium text-gray-900">{{ $verification->full_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nomor KTP</p>
                        <p class="text-base font-medium text-gray-900">{{ $verification->nik ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Informasi Bisnis
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Bisnis</p>
                        <p class="text-base font-medium text-gray-900">{{ $verification->business_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jenis Bisnis</p>
                        <p class="text-base font-medium text-gray-900">{{ $verification->business_type_display ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nomor NIB</p>
                        <p class="text-base font-medium text-gray-900">{{ $verification->nib_number ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Dokumen
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <!-- KTP -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-medium text-gray-900">KTP</h3>
                            <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full">Wajib</span>
                        </div>
                        @if($verification->ktp_path)
                            <div class="relative group">
                                <img src="{{ $verification->ktp_path }}" alt="KTP" class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.verifications.download', ['verification' => $verification->id, 'document' => 'ktp']) }}"
                                       class="px-3 py-1.5 bg-white text-gray-900 rounded-lg text-sm hover:bg-gray-100">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <p class="text-gray-400 text-sm">Tidak ada dokumen</p>
                            </div>
                        @endif
                    </div>

                    <!-- NPWP -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-medium text-gray-900">NPWP</h3>
                            <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full">Wajib</span>
                        </div>
                        @if($verification->npwp_path)
                            <div class="relative group">
                                <img src="{{ $verification->npwp_path }}" alt="NPWP" class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.verifications.download', ['verification' => $verification->id, 'document' => 'npwp']) }}"
                                       class="px-3 py-1.5 bg-white text-gray-900 rounded-lg text-sm hover:bg-gray-100">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <p class="text-gray-400 text-sm">Tidak ada dokumen</p>
                            </div>
                        @endif
                    </div>

                    <!-- Surat Izin Usaha -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-medium text-gray-900">Surat Izin Usaha</h3>
                            <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full">Opsional</span>
                        </div>
                        @if($verification->siu_path)
                            <div class="relative group">
                                @if(str_contains($verification->siu_path, '.pdf'))
                                    <div class="h-48 bg-red-50 rounded-lg flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-red-600 text-sm">PDF Document</p>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ $verification->siu_path }}" alt="SIU" class="w-full h-48 object-cover rounded-lg">
                                @endif
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.verifications.download', ['verification' => $verification->id, 'document' => 'siu']) }}"
                                       class="px-3 py-1.5 bg-white text-gray-900 rounded-lg text-sm hover:bg-gray-100">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <p class="text-gray-400 text-sm">Tidak ada dokumen</p>
                            </div>
                        @endif
                    </div>

                    <!-- Selfie with KTP -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-medium text-gray-900">Selfie dengan KTP</h3>
                            <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full">Opsional</span>
                        </div>
                        @if($verification->selfie_with_ktp_path)
                            <div class="relative group">
                                <img src="{{ $verification->selfie_with_ktp_path }}" alt="Selfie" class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.verifications.download', ['verification' => $verification->id, 'document' => 'selfie']) }}"
                                       class="px-3 py-1.5 bg-white text-gray-900 rounded-lg text-sm hover:bg-gray-100">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <p class="text-gray-400 text-sm">Tidak ada dokumen</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Admin Notes (if rejected) -->
            @if($verification->admin_notes && $verification->status === 'rejected')
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-red-900 mb-2">Alasan Penolakan</h2>
                    <p class="text-red-700">{{ $verification->admin_notes }}</p>
                    @if($verification->reviewer)
                        <p class="text-xs text-red-500 mt-2">Ditolak oleh: {{ $verification->reviewer->name }}</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-6">
                <!-- Store Info -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Informasi Toko</h3>
                    <div class="flex items-center gap-3">
                        @if($verification->store->logo)
                            <img src="{{ $verification->store->logo }}" alt="{{ $verification->store->name }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <span class="text-indigo-600 font-bold">{{ substr($verification->store->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $verification->store->name }}</p>
                            <a href="{{ $verification->store->public_url }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-700">
                                {{ '@' . $verification->store->username }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Seller Info -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Informasi Seller</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-medium">{{ substr($verification->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $verification->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $verification->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Timeline</h3>
                    <div class="space-y-3">
                        <div class="flex gap-3">
                            <div class="w-2 h-2 mt-2 bg-gray-300 rounded-full"></div>
                            <div>
                                <p class="text-sm text-gray-900">Submitted</p>
                                <p class="text-xs text-gray-500">
                                    @if($verification->submitted_at)
                                        {{ $verification->submitted_at->format('d M Y, H:i') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($verification->reviewed_at)
                            <div class="flex gap-3">
                                <div class="w-2 h-2 mt-2 {{ $verification->isVerified ? 'bg-green-500' : 'bg-red-500' }} rounded-full"></div>
                                <div>
                                    <p class="text-sm text-gray-900">{{ $verification->isVerified ? 'Approved' : 'Rejected' }}</p>
                                    <p class="text-xs text-gray-500">{{ $verification->reviewed_at->format('d M Y, H:i') }}</p>
                                    @if($verification->reviewer)
                                        <p class="text-xs text-gray-400">by {{ $verification->reviewer->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions (only for pending) -->
                @if($verification->status === 'pending')
                    <div class="border-t border-gray-200 pt-6 space-y-4">
                        <!-- Approve -->
                        <form action="{{ route('admin.verifications.approve', $verification) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                                <textarea name="admin_notes" rows="2" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          placeholder="Catatan untuk seller...">{{ old('admin_notes') }}</textarea>
                            </div>
                            <button type="submit" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approve
                            </button>
                        </form>

                        <!-- Reject -->
                        <button type="button" onclick="showRejectModal()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center" onclick="closeRejectModal()">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4" onclick="event.stopPropagation()">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Verifikasi</h3>
        <form action="{{ route('admin.verifications.reject', $verification) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="admin_notes" rows="4" required
                          class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Jelaskan alasan penolakan...">{{ old('admin_notes') }}</textarea>
                @error('admin_notes')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Tolak</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectModal').classList.add('flex');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }
</script>
@endpush
