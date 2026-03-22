{{-- resources/views/components/common/component-card.blade.php --}}
@props(['title' => null, 'desc' => null])
<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden']) }}>
    @if($title)
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $title }}</h3>
        @if($desc)<p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $desc }}</p>@endif
    </div>
    @endif
    <div class="p-6">{{ $slot }}</div>
</div>
