{{-- resources/views/pages/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard')
@section('breadcrumb', 'Beranda')

@section('page-actions')
<a href="{{ route('admin.articles.create') }}"
   class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
    </svg>
    Artikel Baru
</a>
@endsection

@section('content')
<div class="space-y-6">

    {{-- ── Stat Cards ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">
        @php
        $statCards = [
            [
                'label' => 'Total User',
                'value' => $stats['users'],
                'color' => 'brand',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
            ],
            [
                'label' => 'Artikel',
                'value' => $stats['articles'],
                'color' => 'blue',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>',
            ],
            [
                'label' => 'Dokter',
                'value' => $stats['doctors'],
                'color' => 'emerald',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>',
            ],
            [
                'label' => 'Layanan',
                'value' => $stats['services'],
                'color' => 'violet',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>',
            ],
            [
                'label' => 'Edukasi',
                'value' => $stats['educations'],
                'color' => 'amber',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>',
            ],
            [
                'label' => 'Pesan Baru',
                'value' => $stats['contacts'],
                'color' => 'red',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>',
            ],
        ];
        $colorMap = [
            'brand'  => ['bg' => 'bg-brand-50 dark:bg-brand-500/10',   'icon' => 'text-brand-600 dark:text-brand-400'],
            'blue'   => ['bg' => 'bg-blue-50 dark:bg-blue-500/10',     'icon' => 'text-blue-600 dark:text-blue-400'],
            'emerald'=> ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10','icon' => 'text-emerald-600 dark:text-emerald-400'],
            'violet' => ['bg' => 'bg-violet-50 dark:bg-violet-500/10', 'icon' => 'text-violet-600 dark:text-violet-400'],
            'amber'  => ['bg' => 'bg-amber-50 dark:bg-amber-500/10',   'icon' => 'text-amber-600 dark:text-amber-400'],
            'red'    => ['bg' => 'bg-red-50 dark:bg-red-500/10',       'icon' => 'text-red-600 dark:text-red-400'],
        ];
        @endphp

        @foreach($statCards as $card)
        @php $c = $colorMap[$card['color']]; @endphp
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5 hover:shadow-theme-md transition-shadow">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 {{ $c['bg'] }}">
                <svg class="w-6 h-6 {{ $c['icon'] }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    {!! $card['icon'] !!}
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($card['value']) }}</div>
            <div class="text-gray-500 dark:text-gray-400 text-xs mt-1">{{ $card['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- ── Quick Actions ── --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
        <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-5">Aksi Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @php
            $quickActions = [
                [
                    'route' => 'admin.articles.create',
                    'label' => 'Artikel Baru',
                    'bg'    => 'bg-blue-50 dark:bg-blue-500/10 hover:bg-blue-100 dark:hover:bg-blue-500/20',
                    'icon_color' => 'text-blue-600 dark:text-blue-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>',
                ],
                [
                    'route' => 'admin.doctors.create',
                    'label' => 'Tambah Dokter',
                    'bg'    => 'bg-emerald-50 dark:bg-emerald-500/10 hover:bg-emerald-100 dark:hover:bg-emerald-500/20',
                    'icon_color' => 'text-emerald-600 dark:text-emerald-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>',
                ],
                [
                    'route' => 'admin.services.create',
                    'label' => 'Layanan Baru',
                    'bg'    => 'bg-violet-50 dark:bg-violet-500/10 hover:bg-violet-100 dark:hover:bg-violet-500/20',
                    'icon_color' => 'text-violet-600 dark:text-violet-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>',
                ],
                [
                    'route' => 'admin.schedules.create',
                    'label' => 'Jadwal Baru',
                    'bg'    => 'bg-amber-50 dark:bg-amber-500/10 hover:bg-amber-100 dark:hover:bg-amber-500/20',
                    'icon_color' => 'text-amber-600 dark:text-amber-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>',
                ],
                [
                    'route' => 'admin.educations.create',
                    'label' => 'Edukasi Baru',
                    'bg'    => 'bg-pink-50 dark:bg-pink-500/10 hover:bg-pink-100 dark:hover:bg-pink-500/20',
                    'icon_color' => 'text-pink-600 dark:text-pink-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>',
                ],
                [
                    'route' => 'admin.contacts.index',
                    'label' => 'Lihat Pesan',
                    'bg'    => 'bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20',
                    'icon_color' => 'text-red-600 dark:text-red-400',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>',
                ],
            ];
            @endphp

            @foreach($quickActions as $action)
            <a href="{{ route($action['route']) }}"
               class="group flex flex-col items-center gap-2.5 p-4 rounded-xl {{ $action['bg'] }} transition-all duration-200 hover:scale-105">
                <svg class="w-7 h-7 {{ $action['icon_color'] }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    {!! $action['icon'] !!}
                </svg>
                <span class="text-xs font-medium text-gray-600 dark:text-gray-400 text-center leading-tight">{{ $action['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ── Latest Contacts + Articles ── --}}
    <div class="grid lg:grid-cols-2 gap-6">

        {{-- Pesan Terbaru --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Pesan Terbaru</h3>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-1 text-xs text-brand-500 hover:text-brand-600 font-medium transition-colors">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-800">
                @forelse($latestContacts as $contact)
                <a href="{{ route('admin.contacts.show', $contact->id) }}"
                   class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors {{ $contact->status === 'unread' ? 'bg-brand-50/30 dark:bg-brand-500/5' : '' }}">
                    <div class="w-9 h-9 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center flex-shrink-0 font-bold text-sm text-brand-600 dark:text-brand-400">
                        {{ strtoupper(substr($contact->name,0,1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-{{ $contact->status === 'unread' ? 'semibold' : 'medium' }} text-gray-900 dark:text-white text-sm truncate">
                                {{ $contact->name }}
                            </span>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                @if($contact->status === 'unread')
                                <span class="w-2 h-2 bg-brand-500 rounded-full"></span>
                                @endif
                                <span class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $contact->subject }}</p>
                    </div>
                </a>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-10 h-10 mx-auto text-gray-200 dark:text-gray-700 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    <p class="text-sm text-gray-400">Belum ada pesan masuk</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                    </svg>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Artikel Terbaru</h3>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-1 text-xs text-brand-500 hover:text-brand-600 font-medium transition-colors">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-800">
                @forelse($latestArticles as $article)
                <div class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if($article->thumbnail)
                        <img src="{{ $article->thumbnail_url }}" class="w-full h-full object-cover" alt="">
                        @else
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 dark:text-white text-sm truncate">{{ $article->title }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            @if($article->status === 'published')
                            <span class="inline-flex items-center gap-1 text-xs text-green-600 dark:text-green-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Draft
                            </span>
                            @endif
                            <span class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.articles.edit', $article->id) }}"
                       class="flex-shrink-0 p-1.5 rounded-lg text-gray-400 hover:text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                        </svg>
                    </a>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-10 h-10 mx-auto text-gray-200 dark:text-gray-700 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <p class="text-sm text-gray-400">Belum ada artikel</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
