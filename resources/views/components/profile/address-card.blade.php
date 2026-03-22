{{-- resources/views/components/profile/address-card.blade.php --}}
@props(['user' => null])
@php $user = $user ?? auth()->user(); @endphp
<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Alamat</h3>
        <a href="{{ route('dashboard.profile') }}" class="text-xs text-brand-500 hover:text-brand-600 font-medium transition-colors">Edit</a>
    </div>
    <div class="flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-gray-800 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <p class="text-xs text-gray-400 dark:text-gray-500">Alamat</p>
            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $user->address ?? 'Belum diisi' }}</p>
        </div>
    </div>
</div>
