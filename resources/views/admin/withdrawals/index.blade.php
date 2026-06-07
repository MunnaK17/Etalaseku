@extends('layouts.admin')

@section('title', 'Penarikan Saldo - Panel Admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Penarikan Saldo</h1>
                <p class="mt-1 text-gray-600">Kelola permintaan penarikan saldo seller</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.withdrawals.index') }}" class="ml-2 px-4 py-2 text-gray-600 hover:text-gray-900">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Withdrawals Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($withdrawals as $withdrawal)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $withdrawal->wallet->user->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500">{{ $withdrawal->wallet->user->email ?? '' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-lg font-bold text-gray-900">{{ $withdrawal->formatted_amount }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="text-gray-900">{{ $withdrawal->bank_name }}</p>
                                    <p class="text-gray-500">{{ $withdrawal->account_number }}</p>
                                    <p class="text-gray-400">{{ $withdrawal->account_name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $withdrawal->status_badge_class }}">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $withdrawal->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($withdrawal->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <form method="POST" action="{{ route('admin.withdrawals.approve', $withdrawal) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Setuju
                                            </button>
                                        </form>

                                        <button type="button"
                                                onclick="openTolakModal({{ $withdrawal->id }})"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak
                                        </button>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="mt-2 text-gray-500">Belum ada permintaan penarikan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $withdrawals->withQueryString()->links() }}
        </div>
    </div>
</div>

<!-- Tolak Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Penarikan</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                    Alasan Penolakan (opsional)
                </label>
                <textarea name="note"
                          id="note"
                          rows="3"
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Contoh: Rekening tidak valid"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeTolakModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

<!-- Tolak Modal -->
<div id="rejectModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
     role="dialog"
     aria-modal="true"
     aria-labelledby="rejectModalTitle"
     aria-describedby="rejectModalDesc">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4" role="document">
        <h3 id="rejectModalTitle" class="text-lg font-semibold text-gray-900 mb-4">Tolak Penarikan</h3>
        <p id="rejectModalDesc" class="sr-only">Form untuk menolak permintaan penarikan saldo dan menambahkan alasan penolakan</p>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                    Alasan Penolakan (opsional)
                </label>
                <textarea name="note"
                          id="note"
                          rows="3"
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Contoh: Rekening tidak valid"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeTolakModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const rejectModal = document.getElementById('rejectModal');
    const rejectForm = document.getElementById('rejectForm');
    const firstFocusable = rejectForm.querySelector('textarea');
    const closeButtons = rejectForm.querySelectorAll('button');

    function openTolakModal(withdrawalId) {
        rejectForm.action = '/admin/withdrawals/' + withdrawalId + '/reject';
        rejectModal.classList.remove('hidden');
        rejectModal.classList.add('flex');
        firstFocusable.focus();
        document.body.style.overflow = 'hidden';
    }

    function closeTolakModal() {
        rejectModal.classList.add('hidden');
        rejectModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    rejectModal.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeTolakModal();
            return;
        }
        if (e.key !== 'Tab') return;

        const focusable = rejectForm.querySelectorAll('button, textarea, input, select');
        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
    });

    rejectModal.addEventListener('click', function(e) {
        if (e.target === rejectModal) {
            closeTolakModal();
        }
    });
</script>