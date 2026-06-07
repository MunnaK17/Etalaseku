{{-- Redirect to landing page --}}
<script>
    window.location.href = '{{ route('home') }}';
</script>
{{-- Or use Laravel redirect --}}
{{-- return redirect()->route('home'); --}}