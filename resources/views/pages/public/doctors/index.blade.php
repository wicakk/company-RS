{{-- resources/views/pages/public/doctors/index.blade.php --}}
@extends('layouts.app')
@section('title','Tim Dokter')
@section('content')

<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-white text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">Tim Dokter</div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Dokter <span class="text-primary-300">Spesialis</span> Kami</h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto">Tim dokter berpengalaman dan tersertifikasi siap memberikan pelayanan terbaik untuk kesehatan Anda.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Filter --}}
    <form method="GET" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5 mb-10 flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dokter atau spesialisasi..."
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all">
        </div>
        <div class="sm:w-56">
            <select name="service" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all">
                <option value="">Semua Poli / Layanan</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}" {{ request('service') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari
        </button>
    </form>

    @if($doctors->isEmpty())
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Dokter tidak ditemukan
        </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
        @foreach($doctors as $doctor)
        <a href="{{ route('doctors.show', $doctor->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden text-center">
            <div class="bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/20 dark:to-blue-900/20 pt-8 pb-4 px-4">
                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-28 h-28 rounded-full mx-auto object-cover border-4 border-white dark:border-slate-800 shadow-md group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-5">
                <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary-600 transition-colors mb-1">dr. {{ $doctor->name }}</h3>
                <p class="text-primary-600 dark:text-primary-400 text-xs font-semibold mb-3">{{ $doctor->specialization }}</p>
                @if($doctor->service)
                <span class="inline-block bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs px-3 py-1 rounded-full mb-3">{{ $doctor->service->name }}</span>
                @endif
                @if($doctor->schedules->isNotEmpty())
                <div class="border-t border-slate-100 dark:border-slate-800 pt-3 mt-2">
                    <div class="text-xs text-slate-400 mb-1">Jadwal Praktik</div>
                    @foreach($doctor->schedules->take(2) as $sch)
                    <div class="text-xs text-slate-600 dark:text-slate-400">{{ $sch->day }}: {{ $sch->time_range }}</div>
                    @endforeach
                    @if($doctor->schedules->count() > 2)
                    <div class="text-xs text-primary-500 mt-1">+{{ $doctor->schedules->count() - 2 }} jadwal lain</div>
                    @endif
                </div>
                @endif
            </div>
        </a>
        @endforeach
    </div>
    {{ $doctors->withQueryString()->links() }}
    @endif
</section>
@endsection
