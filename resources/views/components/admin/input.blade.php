{{-- resources/views/components/admin/input.blade.php --}}
@props([
    'label'       => null,
    'name',
    'type'        => 'text',
    'value'       => null,
    'placeholder' => '',
    'required'    => false,
    'hint'        => null,
])

<div>
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 dark:focus:border-brand-500 outline-none transition-all placeholder:text-gray-400 dark:placeholder:text-gray-600']) }}
    >

    @error($name)
    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $message }}
    </p>
    @enderror

    @if($hint)
    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif
</div>
