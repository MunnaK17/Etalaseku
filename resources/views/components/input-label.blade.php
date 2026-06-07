<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-on-surface']) }}>
    {{ $value ?? $slot }}
</label>