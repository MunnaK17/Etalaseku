<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-transparent border-2 border-border-dark text-on-surface font-semibold rounded-full hover:bg-surface-container transition-all duration-200 active:scale-[0.98]']) }}>
    {{ $slot }}
</button>
