{{-- resources/views/pages/auth/dashboard.blade.php --}}
@extends('layouts.app')
@section('title','Dashboard Saya')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-3xl p-8 text-white mb-8">
        <div class="flex items-center gap-6">
            <img src="{{ auth()->user()->avatar_url }}" class="w-20 h-20 rounded-full border-4 border-white/30 object-cover" alt="">
            <div>
                <div class="text-white/70 text-sm mb-1">Selamat datang kembali,</div>
                <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                <div class="text-white/70 text-sm mt-1">{{ auth()->user()->email }}</div>
                <span class="inline-block mt-2 bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    {{ auth()->user()->role === 'admin' ? '👑 Administrator' : '👤 Member' }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        {{-- Sidebar Menu --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-4 h-fit">
            <nav class="space-y-1">
                @foreach([
                    ['route'=>'dashboard.index',  'label'=>'Dashboard',   'icon'=>'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z'],
                    ['route'=>'dashboard.profile','label'=>'Profil Saya', 'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ] as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs($item['route']) ? 'bg-brand-50 dark:bg-brand-500/10 text-brand-600' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                    {{ $item['label'] }}
                </a>
                @endforeach
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                    Panel Admin
                </a>
                @endif
                <hr class="border-slate-100 dark:border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </nav>
        </div>

        {{-- Content --}}
        <div class="lg:col-span-3 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Selamat Datang! 🎉</h2>
                <p class="text-slate-500 dark:text-slate-400">Ini adalah halaman dashboard Anda. Di sini Anda dapat mengelola informasi akun dan melihat riwayat aktivitas Anda di RS Company.</p>
            </div>

            {{-- Quick Links --}}
            <div class="grid sm:grid-cols-3 gap-4">
                @foreach([
                    ['route'=>'services.index','label'=>'Layanan RS',   'icon'=>'🏥', 'desc'=>'Lihat layanan tersedia'],
                    ['route'=>'doctors.index', 'label'=>'Tim Dokter',   'icon'=>'👨‍⚕️','desc'=>'Temukan dokter spesialis'],
                    ['route'=>'contact.index', 'label'=>'Hubungi Kami', 'icon'=>'📞', 'desc'=>'Kirim pertanyaan'],
                ] as $link)
                <a href="{{ route($link['route']) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5 text-center">
                    <div class="text-3xl mb-3">{{ $link['icon'] }}</div>
                    <div class="font-semibold text-slate-900 dark:text-white group-hover:text-brand-600 transition-colors text-sm">{{ $link['label'] }}</div>
                    <div class="text-slate-400 text-xs mt-1">{{ $link['desc'] }}</div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
