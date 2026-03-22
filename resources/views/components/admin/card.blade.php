{{-- resources/views/components/admin/card.blade.php --}}
@props(['title' => null, 'action' => null])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden']) }}>
    @if($title || $action)
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
        @if($title)
        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $title }}</h3>
        @endif
        @if($action)
        <div>{!! $action !!}</div>
        @endif
    </div>
    @endif
    {{ $slot }}
</div>
