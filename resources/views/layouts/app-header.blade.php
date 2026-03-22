{{-- resources/views/layouts/app-header.blade.php --}}
<header class="sticky top-0 flex w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 z-[9999]"
        x-data="{ appMenuOpen: false }">
    <div class="flex items-center justify-between w-full px-4 py-3 lg:px-6 gap-4">

        {{-- Left: Toggle + Mobile Logo --}}
        <div class="flex items-center gap-3">
            {{-- Desktop Sidebar Toggle --}}
            <button class="hidden xl:flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 dark:border-gray-800 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    @click="$store.sidebar.toggleExpanded()">
                <svg width="16" height="12" viewBox="0 0 16 12" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583 1C0.583 0.586 0.919 0.25 1.333 0.25H14.667C15.081 0.25 15.417 0.586 15.417 1C15.417 1.414 15.081 1.75 14.667 1.75L1.333 1.75C0.919 1.75 0.583 1.414 0.583 1ZM0.583 11C0.583 10.586 0.919 10.25 1.333 10.25L14.667 10.25C15.081 10.25 15.417 10.586 15.417 11C15.417 11.414 15.081 11.75 14.667 11.75L1.333 11.75C0.919 11.75 0.583 11.414 0.583 11ZM1.333 5.25C0.919 5.25 0.583 5.586 0.583 6C0.583 6.414 0.919 6.75 1.333 6.75L8 6.75C8.414 6.75 8.75 6.414 8.75 6C8.75 5.586 8.414 5.25 8 5.25L1.333 5.25Z" fill="currentColor"/>
                </svg>
            </button>

            {{-- Mobile Sidebar Toggle --}}
            <button class="flex xl:hidden items-center justify-center w-10 h-10 text-gray-500 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    @click="$store.sidebar.toggleMobileOpen()">
                <svg x-show="!$store.sidebar.isMobileOpen" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="$store.sidebar.isMobileOpen" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Mobile Logo --}}
            <a href="{{ route('admin.dashboard') }}" class="xl:hidden flex items-center gap-2">
                <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#3b97f3,#1560d5);display:flex;align-items:center;justify-content:center;">
                    <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <span class="font-bold text-sm text-gray-900 dark:text-white">RS Medika</span>
            </a>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-2">
            {{-- Theme Toggle --}}
            <x-common.theme-toggle />

            {{-- Notifications --}}
            <x-header.notification-dropdown />

            {{-- User Dropdown --}}
            <x-header.user-dropdown />
        </div>
    </div>
</header>
