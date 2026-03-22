{{-- resources/views/components/header/notification-dropdown.blade.php --}}
@php $unreadCount = \App\Models\Contact::where('status','unread')->count(); @endphp
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.away="open = false"
            class="relative flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 dark:border-gray-800 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400 transition-colors">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
        <span class="absolute -top-0.5 -right-0.5 flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
        @endif
    </button>
    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
         class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-xl z-50">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-800">
            <h3 class="font-semibold text-sm text-gray-900 dark:text-white">Notifikasi</h3>
            @if($unreadCount > 0)
            <span class="text-xs bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 px-2 py-0.5 rounded-full font-semibold">{{ $unreadCount }} baru</span>
            @endif
        </div>
        <div class="max-h-72 overflow-y-auto">
            @php $msgs = \App\Models\Contact::latest()->take(5)->get(); @endphp
            @forelse($msgs as $msg)
            <a href="{{ route('admin.contacts.show', $msg->id) }}"
               class="flex items-start gap-3 px-5 py-3.5 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border-b border-gray-50 dark:border-gray-800/50 last:border-0">
                <div class="w-9 h-9 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center flex-shrink-0 font-bold text-sm text-brand-600 dark:text-brand-400">
                    {{ strtoupper(substr($msg->name,0,1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-xs text-gray-900 dark:text-white truncate">{{ $msg->name }}</span>
                        @if($msg->status === 'unread')<span class="w-1.5 h-1.5 bg-brand-500 rounded-full flex-shrink-0"></span>@endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $msg->subject }}</p>
                    <p class="text-[11px] text-gray-400 mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
                </div>
            </a>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">Tidak ada notifikasi</div>
            @endforelse
        </div>
        <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800">
            <a href="{{ route('admin.contacts.index') }}" class="block text-center text-sm font-medium text-brand-500 hover:text-brand-600 transition-colors">Lihat Semua →</a>
        </div>
    </div>
</div>
