@props(['status'])

@if ($status)
    <div class="p-4 bg-surface-container-low border border-border-dark rounded-xl flex items-center gap-3">
        <span class="material-symbols-outlined text-surface-raised text-xl">info</span>
        <span class="text-sm text-on-surface">{{ $status }}</span>
    </div>
@endif