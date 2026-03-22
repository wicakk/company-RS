{{-- resources/views/components/ui/button.blade.php --}}
@props(['variant' => 'primary', 'size' => 'md', 'icon' => null, 'href' => null])
@php
$variants = [
    'primary'   => 'bg-brand-600 hover:bg-brand-700 text-white shadow-sm hover:shadow-brand-300/30',
    'secondary' => 'bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300',
    'outline'   => 'border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300',
    'danger'    => 'bg-red-600 hover:bg-red-700 text-white',
    'ghost'     => 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-400',
];
$sizes = ['sm'=>'px-3 py-1.5 text-xs','md'=>'px-5 py-2.5 text-sm','lg'=>'px-7 py-3.5 text-base'];
$base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-xl transition-all duration-200 ';
@endphp
@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $base . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md'])]) }}>
    @if($icon){!! $icon !!}@endif {{ $slot }}
</a>
@else
<button {{ $attributes->merge(['class' => $base . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md'])]) }}>
    @if($icon){!! $icon !!}@endif {{ $slot }}
</button>
@endif
