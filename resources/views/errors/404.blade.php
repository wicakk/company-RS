{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')
@section('title', 'Halaman Tidak Ditemukan')
@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
    <div class="text-center">
        <div class="text-8xl font-bold gradient-text mb-4">404</div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Halaman Tidak Ditemukan</h1>
        <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Kembali ke Beranda
            </a>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 text-slate-600 dark:text-slate-300 font-semibold rounded-xl transition-all text-sm">Laporkan Masalah</a>
        </div>
    </div>
</div>
@endsection
