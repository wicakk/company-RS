{{-- resources/views/components/ui/modal.blade.php --}}
@props(['isOpen' => false, 'showCloseButton' => true, 'isFullscreen' => false, 'modalId' => null])
@php $id = $modalId ?? 'modal-' . uniqid(); @endphp
<div id="{{ $id }}" x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
     x-show="open" x-cloak
     class="fixed inset-0 z-[99999] flex items-center justify-center p-4"
     @keydown.escape.window="open = false">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="open = false"></div>
    <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full {{ $isFullscreen ? 'max-w-full h-full rounded-none' : 'max-w-lg' }} overflow-hidden"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
        @if($showCloseButton)
        <button @click="open = false" class="absolute top-4 right-4 p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        @endif
        {{ $slot }}
    </div>
</div>
