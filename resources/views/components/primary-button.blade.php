<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-3.5 bg-surface-raised text-primary-container font-bold rounded-xl hover:opacity-90 transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-2 shadow-lg shadow-surface-raised/20']) }}>
    {{ $slot }}
</button>