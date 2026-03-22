{{-- resources/views/pages/public/educations/index.blade.php --}}
@extends('layouts.app')
@section('title','Edukasi Kesehatan')
@section('content')
<section class="hero-gradient py-20 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white text-center relative">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">Edukasi Kesehatan</div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Edukasi untuk <span class="text-primary-300">Hidup Sehat</span></h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto">Tingkatkan pengetahuan kesehatan Anda dengan artikel, video, dan infografis terpercaya dari tim medis kami.</p>
    </div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Filter --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-10">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari konten edukasi..."
               class="flex-1 min-w-48 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
        @foreach([''=>'Semua','article'=>'📄 Artikel','video'=>'🎥 Video','infographic'=>'🖼️ Infografis'] as $val => $label)
        <a href="{{ route('educations.index', $val ? ['type'=>$val] : []) }}"
           class="px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request('type') == $val ? 'bg-primary-600 text-white':'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700' }}">
            {{ $label }}
        </a>
        @endforeach
        <button type="submit" class="px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl text-sm">Cari</button>
    </form>

    @if($educations->isEmpty())
        <div class="text-center py-20 text-slate-400">Tidak ada konten ditemukan.</div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        @foreach($educations as $edu)
        <a href="{{ route('educations.show', $edu->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col">
            <div class="relative h-48 bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/30 dark:to-blue-900/30 overflow-hidden">
                @if($edu->thumbnail)
                    <img src="{{ $edu->thumbnail_url }}" alt="{{ $edu->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-5xl">
                        {{ $edu->type === 'video' ? '🎥' : ($edu->type === 'infographic' ? '🖼️' : '📄') }}
                    </div>
                @endif
                <span class="absolute top-3 left-3 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    {{ $edu->type === 'video' ? '🎥 Video' : ($edu->type === 'infographic' ? '🖼️ Infografis' : '📄 Artikel') }}
                </span>
            </div>
            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                    <span>{{ $edu->published_at?->format('d M Y') }}</span>
                    <span>•</span>
                    <span>{{ $edu->views }} dilihat</span>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors mb-2 line-clamp-2 flex-1">{{ $edu->title }}</h3>
                @if($edu->excerpt)<p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2">{{ $edu->excerpt }}</p>@endif
                <div class="flex items-center gap-1 mt-4 text-primary-600 dark:text-primary-400 text-sm font-semibold">
                    Baca Selengkapnya <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="flex justify-center">{{ $educations->withQueryString()->links() }}</div>
    @endif
</section>
@endsection
