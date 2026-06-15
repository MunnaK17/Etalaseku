@extends('layouts.seller')

@section('title', 'Program Inklusif - EtalaseKu')
@section('breadcrumb', 'Program Inklusif')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Program Inklusif</h1>
                    <p class="text-gray-600">EtalaseKu untuk Penyandang Disabilitas</p>
                </div>
            </div>
        </div>

        <!-- Already Approved -->
        @if($store && $store->is_inclusive_seller)
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-green-800">Selamat! Anda Inclusive Seller</h2>
                        <p class="text-green-700 mt-1">Anda mendapatkan akses Plan Pro secara gratis selama <strong>6 bulan</strong> sebagai bagian dari Program Inklusif EtalaseKu.</p>
                        <div class="mt-3 flex items-center gap-2 text-sm text-green-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Sisa waktu: <strong>{{ $store->inclusive_expiry_days ?? 0 }} hari</strong> (hingga {{ $store->plan_expires_at->format('d M Y') }})</span>
                        </div>
                        <div class="mt-4 flex gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-200 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Produk Unlimited
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-200 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Tanpa Watermark
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-200 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Digital Product
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pending Application -->
        @if($application && $application->status === 'pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-yellow-800">Permohonan Sedang Diproses</h2>
                        <p class="text-yellow-700 mt-1">Permohonan Inclusive Program Anda sedang dalam tahap review. Tim kami akan memproses dalam 1-3 hari kerja.</p>
                        <p class="text-sm text-yellow-600 mt-2">Dikirim pada: {{ $application->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Program Benefits -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Keuntungan Program Inklusif</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Akses Plan Pro Gratis</h3>
                        <p class="text-sm text-gray-500 mt-1">Dapatkan semua fitur Pro tanpa biaya langganan</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Produk Unlimited</h3>
                        <p class="text-sm text-gray-500 mt-1">Tidak ada batas jumlah produk di etalase</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Produk Digital</h3>
                        <p class="text-sm text-gray-500 mt-1">Jual produk digital seperti e-book, template, dan lainnya</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Tanpa Watermark</h3>
                        <p class="text-sm text-gray-500 mt-1">Etalase bersih tanpa watermark EtalaseKu</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Custom Theme</h3>
                        <p class="text-sm text-gray-500 mt-1">Pilih tema etalase sesuai preferensi</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Checkout System</h3>
                        <p class="text-sm text-gray-500 mt-1">Sistem checkout untuk transaksi produk digital</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        @if(!$store || (!$store->is_inclusive_seller && (!$application || $application->status !== 'pending')))
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">Daftar Program</h2>
                <p class="text-gray-500 mb-6">Isi formulir di bawah untuk mengajukan menjadi Inclusive Seller</p>

                <form action="{{ route('inclusive-program.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="disability_type" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Jenis Disabilitas <span class="text-red-500">*</span>
                        </label>
                        <select id="disability_type" name="disability_type" required
                                class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('disability_type') border-red-500 @enderror">
                            <option value="">Pilih jenis disabilitas</option>
                            <option value="physical" {{ old('disability_type') === 'physical' ? 'selected' : '' }}>Disabilitas Fisik</option>
                            <option value="visual" {{ old('disability_type') === 'visual' ? 'selected' : '' }}>Disabilitas Netra/Tunanetra</option>
                            <option value="hearing" {{ old('disability_type') === 'hearing' ? 'selected' : '' }}>Disabilitas rungu/Wicara</option>
                            <option value="intellectual" {{ old('disability_type') === 'intellectual' ? 'selected' : '' }}>Disabilitas Intelektual</option>
                            <option value="mental" {{ old('disability_type') === 'mental' ? 'selected' : '' }}>Disabilitas Mental</option>
                            <option value="multiple" {{ old('disability_type') === 'multiple' ? 'selected' : '' }}>Disabilitas Ganda</option>
                        </select>
                        @error('disability_type')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="disability_certificate" class="block text-sm font-medium text-gray-700 mb-1.5">
                            No. Sertifikat Disabilitas <span class="text-gray-400">(opsional)</span>
                        </label>
                        <input type="text" id="disability_certificate" name="disability_certificate"
                               value="{{ old('disability_certificate') }}"
                               class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('disability_certificate') border-red-500 @enderror"
                               placeholder="Contoh: 12345678/2024">
                        <p class="mt-1 text-xs text-gray-500">Nomor sertifikat/disabilitas dari Kemendikbud atau instansi terkait</p>
                        @error('disability_certificate')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Alasan Mengikuti Program <span class="text-red-500">*</span>
                        </label>
                        <textarea id="reason" name="reason" rows="4" required minlength="50"
                                  class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('reason') border-red-500 @enderror"
                                  placeholder="Ceritakan bagaimana EtalaseKu dapat membantu kegiatan usaha atau pekerjaan Anda...">{{ old('reason') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Minimal 50 karakter</p>
                        @error('reason')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="expected_benefits" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Manfaat yang Diharapkan <span class="text-gray-400">(opsional)</span>
                        </label>
                        <textarea id="expected_benefits" name="expected_benefits" rows="3"
                                  class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Apa yang Anda harapkan dari program ini...">{{ old('expected_benefits') }}</textarea>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-blue-800 font-medium">Informasi Penting</p>
                                <ul class="text-xs text-blue-600 mt-1 space-y-1">
                                    <li>• Review dilakukan dalam 1-3 hari kerja</li>
                                    <li>• Kami mungkin akan menghubungi Anda untuk verifikasi</li>
                                    <li>• Keputusan reviewer bersifat final</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-xl transition-all">
                        Kirim Permohonan
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection