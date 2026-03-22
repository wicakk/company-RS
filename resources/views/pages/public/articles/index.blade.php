{{-- resources/views/pages/public/articles/index.blade.php --}}
@extends('layouts.app')
@section('title','Berita & Kegiatan')
@section('content')

<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-white text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">Berita & Kegiatan</div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Informasi <span class="text-primary-300">Terkini</span></h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto">Tetap terhubung dengan informasi dan kegiatan terbaru dari RS Company.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Filter --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-10">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
               class="flex-1 min-w-48 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
        <select name="type" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
            <option value="">Semua Tipe</option>
            <option value="news" {{ request('type') === 'news' ? 'selected' : '' }}>Berita</option>
            <option value="announcement" {{ request('type') === 'announcement' ? 'selected' : '' }}>Pengumuman</option>
        </select>
        @if($categories->isNotEmpty())
        <select name="category" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @endif
        <button type="submit" class="px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all text-sm">Cari</button>
        @if(request()->hasAny(['search','type','category']))
        <a href="{{ route('articles.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 text-slate-600 dark:text-slate-400 font-semibold rounded-xl transition-all text-sm">Reset</a>
        @endif
    </form>

    @if($articles->isEmpty())
        <div class="text-center py-20 text-slate-400">Tidak ada artikel ditemukan.</div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        @foreach($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col">
            <div class="relative h-52 bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/30 dark:to-blue-900/30 overflow-hidden">
                @if($article->thumbnail)
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary-200 dark:text-primary-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                @endif
                <div class="absolute top-3 left-3 flex gap-2">
                    <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $article->type === 'news' ? 'Berita' : 'Pengumuman' }}
                    </span>
                </div>
            </div>
            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                    <span>{{ $article->published_at?->format('d M Y') }}</span>
                    <span>•</span>
                    <span>{{ $article->views }} dilihat</span>
                    @if($article->category)
                    <span>•</span>
                    <span class="text-primary-600 dark:text-primary-400">{{ $article->category->name }}</span>
                    @endif
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors mb-2 line-clamp-2 flex-1">{{ $article->title }}</h3>
                @if($article->excerpt)
                <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 mb-4">{{ $article->excerpt }}</p>
                @endif
                <div class="flex items-center justify-between text-sm mt-auto">
                    <div class="flex items-center gap-2">
                        <img src="{{ $article->user->avatar_url }}" class="w-6 h-6 rounded-full" alt="">
                        <span class="text-slate-500 dark:text-slate-400 text-xs">{{ $article->user->name }}</span>
                    </div>
                    <span class="text-primary-600 dark:text-primary-400 font-semibold flex items-center gap-1">
                        Baca <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center">{{ $articles->withQueryString()->links() }}</div>
    @endif
</section>
@endsection
