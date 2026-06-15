@extends('layouts.seller')

@section('title', 'Link Groups - EtalaseKU')
@section('breadcrumb', 'Link Groups')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Link Groups</h1>
            <p class="text-gray-600 mt-1">Kelola grup untuk mengorganisir link Anda</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Group
        </button>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
        <p class="text-green-800">{{ session('success') }}</p>
    </div>
    @endif

    @if($groups->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada Link Group</h3>
        <p class="text-gray-500 mb-4">Buat grup untuk mengorganisir link Anda berdasarkan kategori.</p>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700">
            Buat Group Pertama
        </button>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <ul id="sortable-groups" class="divide-y divide-gray-200">
            @foreach($groups as $group)
            <li class="group hover:bg-gray-50 transition-colors" data-id="{{ $group->id }}">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <!-- Drag Handle -->
                        <div class="cursor-move text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </div>

                        <!-- Icon & Name -->
                        <div class="flex items-center space-x-3">
                            @if($group->icon)
                            <span class="text-2xl">{{ $group->icon }}</span>
                            @else
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            @endif
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-gray-900">{{ $group->name }}</span>
                                    @if(!$group->is_active)
                                    <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Nonaktif</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500">{{ $group->links_count }} link</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" onclick="openEditModal({{ $group->id }}, '{{ $group->name }}', '{{ $group->icon }}')" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <form action="{{ route('seller.links.groups.toggle-active', $group) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg" title="{{ $group->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                @if($group->is_active)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                                @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                @endif
                            </button>
                        </form>
                        <form action="{{ route('seller.links.groups.destroy', $group) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus group ini? Link di dalamnya tidak akan dihapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Link Group</h3>
        </div>
        <form action="{{ route('seller.links.groups.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Group</label>
                    <input type="text" name="name" required maxlength="50" placeholder="e.g., Social Media" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Emoji)</label>
                    <input type="text" name="icon" maxlength="10" placeholder="e.g., 🎵" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Opsional. Tambahkan emoji untuk tampilan menarik.</p>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Edit Link Group</h3>
        </div>
        <form id="editForm" method="POST" class="p-6">
            @csrf
            @method('PATCH')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Group</label>
                    <input type="text" name="name" id="editName" required maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Emoji)</label>
                    <input type="text" name="icon" id="editIcon" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Opsional. Tambahkan emoji untuk tampilan menarik.</p>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Create Modal
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    // Edit Modal
    function openEditModal(id, name, icon) {
        document.getElementById('editForm').action = `/seller/links/groups/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editIcon').value = icon || '';
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Close modals on backdrop click
    document.getElementById('createModal').addEventListener('click', function(e) {
        if (e.target === this) closeCreateModal();
    });
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    // Sortable groups
    new Sortable(document.getElementById('sortable-groups'), {
        animation: 150,
        handle: '.cursor-move',
        onEnd: function() {
            const order = [];
            document.querySelectorAll('#sortable-groups li').forEach((el, index) => {
                order.push(el.dataset.id);
            });

            fetch('/seller/links/groups/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Order saved');
                }
            });
        }
    });
</script>
@endpush