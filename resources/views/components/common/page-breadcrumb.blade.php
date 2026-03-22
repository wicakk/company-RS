{{-- resources/views/components/common/page-breadcrumb.blade.php --}}
@props(['pageTitle' => '', 'items' => []])
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $pageTitle }}</h1>
        @if(!empty($items))
        <nav class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500 mt-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-500 transition-colors">Dashboard</a>
            @foreach($items as $item)
            <span>/</span>
            @if(isset($item['url']))
            <a href="{{ $item['url'] }}" class="hover:text-brand-500 transition-colors">{{ $item['label'] }}</a>
            @else
            <span class="text-gray-600 dark:text-gray-300">{{ $item['label'] }}</span>
            @endif
            @endforeach
        </nav>
        @endif
    </div>
    @if(isset($action))
    <div>{{ $action }}</div>
    @endif
</div>
