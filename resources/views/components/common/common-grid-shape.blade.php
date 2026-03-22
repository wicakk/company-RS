{{-- resources/views/components/common/common-grid-shape.blade.php --}}
<div {{ $attributes->merge(['class' => 'absolute inset-0 overflow-hidden pointer-events-none']) }}>
    <svg class="absolute top-0 right-0 opacity-5" width="400" height="400" viewBox="0 0 400 400" fill="none">
        <defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
        </pattern></defs>
        <rect width="400" height="400" fill="url(#grid)"/>
    </svg>
</div>
