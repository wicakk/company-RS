{{-- resources/views/components/ui/avatar.blade.php --}}
@props(['src' => null, 'name' => 'User', 'size' => 'md', 'status' => null])
@php
$sizes = ['xs'=>'w-6 h-6 text-xs','sm'=>'w-8 h-8 text-xs','md'=>'w-10 h-10 text-sm','lg'=>'w-12 h-12 text-base','xl'=>'w-16 h-16 text-lg','2xl'=>'w-20 h-20 text-xl'];
$sz = $sizes[$size] ?? $sizes['md'];
$statusColors = ['online'=>'bg-green-500','offline'=>'bg-gray-400','busy'=>'bg-red-500','away'=>'bg-amber-500'];
@endphp
<div class="relative inline-flex flex-shrink-0">
    @if($src)
    <img src="{{ $src }}" alt="{{ $name }}" {{ $attributes->merge(['class' => "$sz rounded-full object-cover border-2 border-white dark:border-gray-800"]) }}>
    @else
    <div {{ $attributes->merge(['class' => "$sz rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center font-bold text-brand-600 dark:text-brand-400 border-2 border-white dark:border-gray-800"]) }}>
        {{ strtoupper(substr($name, 0, 1)) }}
    </div>
    @endif
    @if($status)
    <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white dark:border-gray-900 {{ $statusColors[$status] ?? 'bg-gray-400' }}"></span>
    @endif
</div>
