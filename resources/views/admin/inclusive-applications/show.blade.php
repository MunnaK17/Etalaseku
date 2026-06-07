@extends('layouts.admin')

@section('title', 'Review Permohonan - Admin EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Back Button -->
    <a href="{{ route('admin.inclusive-applications.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Application Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Detail Permohonan</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
<div>
                            <p class="text-sm text-gray-500">Store</p>
                            <p class="font-medium text-gray-900">{{ $application->store->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pemilik</p>
                            <p class="font-medium text-gray-900">{{ $application->store->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">{{ $application->store->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jenis Disabilitas</p>
                            <p class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $application->disability_type)) }}</p>
                        </div>
                        @if($application->disability_certificate)
                            <div>
                                <p class="text-sm text-gray-500">No. Sertifikat</p>
                                <p class="font-medium text-gray-900">{{ $application->disability_certificate }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                            <p class="font-medium text-gray-900">{{ $application->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reason -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Alasan Mengikuti Program</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $application->reason }}</p>
                </div>
            </div>

            @if($application->expected_benefits)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Manfaat yang Diharapkan</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $application->expected_benefits }}</p>
                    </div>
                </div>
            @endif

            @if($application->admin_notes)
                <div class="bg-yellow-50 rounded-xl border border-yellow-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-yellow-100">
                        <h2 class="text-lg font-semibold text-yellow-800">Catatan Admin</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-yellow-700 whitespace-pre-wrap">{{ $application->admin_notes }}</p>
                    </div>
                </div>
            @endif
 </div>

        <!-- Sidebar -->
<div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Status</h3>
                <span class="inline-flex px-3 py-1.5 rounded-full text-sm font-semibold {{ $application->status_badge_class }}">
                    {{ $application->status_display }}
                </span>

                @if($application->reviewed_at)
                    <p class="text-sm text-gray-500 mt-4">Direview pada {{ $application->reviewed_at->format('d M Y, H:i') }}</p>
                @endif
            </div>

            <!-- Actions -->
            @if($application->status === 'pending')
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Aksi</h3>

                    <!-- Approve Form -->
                    <form action="{{ route('admin.inclusive-applications.approve', $application->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                            <textarea name="admin_notes" rows="2" class="w-full rounded-lg border-gray-300 text-sm"
                                      placeholder="Catatan untuk disetujui..."></textarea>
                        </div>
                        <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                            Setujui
                        </button>
                    </form>

                    <!-- Reject Form -->
                    <form action="{{ route('admin.inclusive-applications.reject', $application->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                            <textarea name="admin_notes" rows="2" class="w-full rounded-lg border-gray-300 text-sm" required
                                      placeholder="Jelaskan alasan penolakan..."></textarea>
                        </div>
                        <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                            Tolak
                        </button>
                    </form>
                </div>
            @endif

            <!-- Store Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Info Store</h3>
                <div class="flex items-center gap-3 mb-4">
                    @if($application->store->logo)
                        <img src="{{ $application->store->logo }}" alt="" class="w-12 h-12 rounded-lg object-cover">
                    @else
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                            <span class="font-bold text-gray-500">{{ substr($application->store->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-900">{{ $application->store->name }}</p>
                        <p class="text-xs text-gray-500">{{ $application->store->username }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Plan</span>
                        <span class="font-medium">{{ ucfirst($application->store->plan) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Inclusive</span>
                        <span class="font-medium">{{ $application->store->is_inclusive_seller ? 'Ya' : 'Tidak' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Produk</span>
                        <span class="font-medium">{{ $application->store->products()->count() }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.stores.show', $application->store->id) }}"
                   class="mt-4 block text-center py-2 px-4 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Lihat Store
                </a>
            </div>
        </div>
    </div>
</div>
@endsection