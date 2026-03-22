{{-- resources/views/components/ui/badge.blade.php --}}
@props(['color' => 'gray', 'size' => 'sm', 'dot' => false])
@php
$colors = [
    'green'  => 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400',
    'red'    => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400',
    'blue'   => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400',
    'amber'  => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400',
    'violet' => 'bg-violet-50 dark:bg-violet-500/10 text-violet-600 dark:text-violet-400',
    'brand'  => 'bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400',
    'gray'   => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400',
    'orange' => 'bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400',
];
$dotColors = [
    'green'=>'bg-green-500','red'=>'bg-red-500','blue'=>'bg-blue-500',
    'amber'=>'bg-amber-500','violet'=>'bg-violet-500','brand'=>'bg-brand-500',
    'gray'=>'bg-gray-400','orange'=>'bg-orange-500',
];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium ' . ($colors[$color] ?? $colors['gray'])]) }}>
    @if($dot)<span class="w-1.5 h-1.5 rounded-full {{ $dotColors[$color] ?? $dotColors['gray'] }}"></span>@endif
    {{ $slot }}
</span>
