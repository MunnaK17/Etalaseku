<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-error text-on-error font-semibold rounded-full hover:opacity-90 transition-all duration-200 active:scale-[0.98] shadow-lg shadow-error/20']) }}>
    {{ $slot }}
</button>
