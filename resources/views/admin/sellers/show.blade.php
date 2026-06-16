@extends('layouts.admin')

@section('title', $store->name . ' - Admin EtalaseKu')

@section('content')
<div class="py-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sellers.index') }}" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Seller</h1>
            </div>
            <p class="text-gray-600 mt-1 ml-9">{{ $store->name }} (@ {{ $store->username }})</p>
        </div>

        <!-- Status Badges -->
        <div class="flex items-center gap-2">
            @if($store->is_hidden)
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                    Hidden
                </span>
            @endif
            @if($store->is_suspended)
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    Suspended
                </span>
            @endif
            @if($store->is_inclusive_seller)
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-pink-100 text-pink-700">
                    Inclusive
                </span>
            @endif
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Store Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Store</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Store</p>
                        <p class="font-medium text-gray-900">{{ $store->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-medium text-gray-900">{{ $store->username }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Deskripsi</p>
                        <p class="text-gray-900">{{ $store->description ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">WhatsApp</p>
                        <p class="font-medium text-gray-900">{{ $store->whatsapp ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Bergabung</p>
                        <p class="font-medium text-gray-900">{{ $store->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status Aktif</p>
                        <p class="font-medium {{ $store->is_active ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $store->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Owner Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemilik</h2>
                @if($store->user)
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="font-medium text-gray-900">{{ $store->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">{{ $store->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Role</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($store->user->role) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Terakhir Login</p>
                            <p class="font-medium text-gray-900">
                                {{ $store->user->updated_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada informasi pemilik</p>
                @endif
            </div>

            <!-- Subscription Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Langganan</h2>
                    @if($store->plan !== 'free' || $store->plan_expires_at)
                        <form action="{{ route('admin.sellers.cancel-subscription', $store) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin membatalkan langganan seller ini? Plan akan direset ke Free.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                Batalkan Langganan
                            </button>
                        </form>
                    @endif
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Plan</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">{{ ucfirst($store->plan) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Berakhir</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">
                            @if($store->plan_expires_at)
                                {{ $store->plan_expires_at->format('d M Y') }}
                                @if($store->plan_expires_at->isPast())
                                    <span class="text-sm text-red-500 font-normal">(Expired)</span>
                                @else
                                    <span class="text-sm text-green-500 font-normal">({{ $store->subscription_info['days_remaining'] }} hari)</span>
                                @endif
                            @else
                                <span class="text-gray-400">Tidak terbatas</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="text-xl font-bold mt-1 {{ $store->isPro() ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $store->isPro() ? 'Aktif' : 'Free' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Suspension Info (if suspended) -->
            @if($store->is_suspended)
                <div class="bg-red-50 rounded-xl border border-red-200 p-6">
                    <h2 class="text-lg font-semibold text-red-900 mb-4">Informasi Penangguhan</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-red-600">Alasan</p>
                            <p class="font-medium text-red-900">{{ $store->suspended_reason }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-red-600">Ditangguhkan Pada</p>
                            <p class="font-medium text-red-900">{{ $store->suspended_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($store->suspendedByAdmin())
                            <div>
                                <p class="text-sm text-red-600">Admin</p>
                                <p class="font-medium text-red-900">{{ $store->suspendedByAdmin()->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Inclusive Status Info -->
            @if($store->is_inclusive_seller || $store->inclusive_granted_at || $store->inclusive_revoked_at)
                <div class="bg-pink-50 rounded-xl border border-pink-200 p-6">
                    <h2 class="text-lg font-semibold text-pink-900 mb-4">Informasi Inclusive</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @if($store->inclusive_granted_at)
                            <div>
                                <p class="text-sm text-pink-600">Diberikan Pada</p>
                                <p class="font-medium text-pink-900">{{ $store->inclusive_granted_at->format('d M Y H:i') }}</p>
                            </div>
                        @endif
                        @if($store->inclusive_revoked_at)
                            <div>
                                <p class="text-sm text-pink-600">Dicabut Pada</p>
                                <p class="font-medium text-pink-900">{{ $store->inclusive_revoked_at->format('d M Y H:i') }}</p>
                            </div>
                        @endif
                        @if($store->inclusiveReviewedByAdmin())
                            <div>
                                <p class="text-sm text-pink-600">Di-review Oleh</p>
                                <p class="font-medium text-pink-900">{{ $store->inclusiveReviewedByAdmin()->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Products Preview -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Produk ({{ $store->products->count() }})</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
                </div>
                @if($store->products->count() > 0)
                    <div class="space-y-3">
                        @foreach($store->products->take(5) as $product)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada produk</p>
                @endif
            </div>
        </div>

        <!-- Sidebar - Action Cards -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Produk</span>
                        <span class="font-semibold text-gray-900">{{ $stats['total_products'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Produk Aktif</span>
                        <span class="font-semibold text-gray-900">{{ $stats['active_products'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Pesanan</span>
                        <span class="font-semibold text-gray-900">{{ $stats['total_orders'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Pesanan Pending</span>
                        <span class="font-semibold text-amber-600">{{ $stats['pending_orders'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Views</span>
                        <span class="font-semibold text-gray-900">{{ number_format($stats['total_views']) }}</span>
                    </div>
                </div>
            </div>

            <!-- Visibility Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Visibilitas</h2>
                <div class="space-y-3">
                    @if($store->is_hidden)
                        <form action="{{ route('admin.sellers.unhide', $store) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Tampilkan Seller
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.sellers.hide', $store) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                                Sembunyikan Seller
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Suspension Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Penangguhan</h2>
                <div class="space-y-3">
                    @if($store->is_suspended)
                        <form action="{{ route('admin.sellers.unsuspend', $store) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Cabut Penangguhan
                            </button>
                        </form>
                    @else
                        <button type="button" onclick="openSuspendModal()" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                            Tangguhkan Seller
                        </button>
                    @endif
                </div>
            </div>

            <!-- Inclusive Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Hak Inclusive</h2>
                <div class="space-y-3">
                    @if($store->is_inclusive_seller)
                        <form action="{{ route('admin.sellers.revoke-inclusive', $store) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="reason" placeholder="Alasan pencabutan (opsional)" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm">
                            </div>
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700"
                                    onclick="return confirm('Yakin ingin mencabut hak Inclusive seller ini?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                                Cabut Hak Inclusive
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.sellers.grant-inclusive', $store) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Berikan Hak Inclusive
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6">
                <h2 class="text-lg font-semibold text-red-900 mb-4">Zona Berbahaya</h2>
                <button type="button" onclick="openDeleteModal()" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Seller
                </button>
                <p class="text-xs text-gray-500 mt-2 text-center">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
    </div>
</div>

<!-- Suspend Modal -->
<div id="suspendModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tangguhkan Seller</h3>
            <form action="{{ route('admin.sellers.suspend', $store) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penangguhan</label>
                    <textarea id="reason" name="reason" rows="4" required
                              class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Jelaskan alasan penangguhan seller ini..."></textarea>
                    <p class="text-sm text-gray-500 mt-1">Seller tidak akan bisa login saat ditangguhkan.</p>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeSuspendModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Tangguhkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Hapus Seller Permanen</h3>
            </div>
            <p class="text-gray-600 mb-4">
                Tindakan ini akan menghapus seller <strong>{{ $store->name }}</strong> dan semua datanya secara permanen.
            </p>
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-4">
                <p class="text-sm text-amber-800">
                    <strong>Data yang akan dihapus:</strong>
                </p>
                <ul class="text-sm text-amber-700 mt-1 space-y-1">
                    <li>• Akun user</li>
                    <li>• Semua produk</li>
                    <li>• Semua pesanan</li>
                    <li>• Data analytics</li>
                    <li>• Link groups</li>
                </ul>
            </div>
            <form action="{{ route('admin.sellers.destroy', $store) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label for="confirm" class="block text-sm font-medium text-gray-700 mb-2">
                        Ketik <strong>DELETE</strong> atau <strong>{{ $store->name }}</strong> untuk konfirmasi:
                    </label>
                    <input type="text" id="confirm" name="confirm" required
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Ketik DELETE atau nama seller">
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openSuspendModal() {
    document.getElementById('suspendModal').classList.remove('hidden');
}

function closeSuspendModal() {
    document.getElementById('suspendModal').classList.add('hidden');
}

function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modals on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSuspendModal();
        closeDeleteModal();
    }
});

// Close modals on backdrop click
document.getElementById('suspendModal').addEventListener('click', function(e) {
    if (e.target === this) closeSuspendModal();
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@endsection