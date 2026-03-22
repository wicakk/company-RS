{{-- resources/views/components/profile/profile-card.blade.php --}}
@props(['user' => null])
@php $user = $user ?? auth()->user(); @endphp
<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
    {{-- Cover --}}
    <div class="h-32 bg-gradient-to-r from-brand-500 to-brand-700 relative">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%"><defs><pattern id="pc" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#pc)"/></svg>
        </div>
    </div>
    {{-- Avatar --}}
    <div class="px-6 pb-6">
        <div class="relative -mt-12 mb-4">
            <img src="{{ $user->avatar_url }}"
                 class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-900 shadow-lg"
                 alt="{{ $user->name }}">
            <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-900"></span>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
        <div class="flex flex-wrap gap-2 mt-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                {{ $user->isAdmin() ? 'Administrator' : 'Member' }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400">
                Aktif
            </span>
        </div>
    </div>
</div>
