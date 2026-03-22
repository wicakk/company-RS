{{-- resources/views/pages/public/articles/show.blade.php --}}
@extends('layouts.app')
@section('title', $article->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-3 gap-10">
        {{-- Main Content --}}
        <article class="lg:col-span-2">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-primary-600 transition-colors">Berita</a>
                <span>/</span>
                <span class="text-slate-600 dark:text-slate-300 line-clamp-1">{{ $article->title }}</span>
            </nav>

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $article->type === 'news' ? 'Berita' : 'Pengumuman' }}
                    </span>
                    @if($article->category)
                    <span class="bg-slate-100 dark:bg-slate-800 text-slate-500 text-xs px-3 py-1 rounded-full">{{ $article->category->name }}</span>
                    @endif
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white leading-tight mb-5">{{ $article->title }}</h1>
                <div class="flex items-center gap-5 text-sm text-slate-500 dark:text-slate-400">
                    <div class="flex items-center gap-2">
                        <img src="{{ $article->user->avatar_url }}" class="w-8 h-8 rounded-full" alt="">
                        <span>{{ $article->user->name }}</span>
                    </div>
                    <span>{{ $article->published_at?->format('d F Y') }}</span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ number_format($article->views) }} dilihat
                    </span>
                </div>
            </div>

            {{-- Thumbnail --}}
            @if($article->thumbnail)
            <div class="rounded-2xl overflow-hidden mb-8 border border-slate-100 dark:border-slate-800">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full max-h-96 object-cover">
            </div>
            @endif

            {{-- Content --}}
            <div class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed prose-headings:font-bold prose-a:text-primary-600 dark:prose-a:text-primary-400">
                {!! $article->content !!}
            </div>

            {{-- Share --}}
            <div class="border-t border-slate-100 dark:border-slate-800 mt-10 pt-8">
                <div class="flex items-center gap-4 flex-wrap">
                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        Twitter
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link tersalin!')" class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-400 text-sm font-medium rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        Salin Link
                    </button>
                </div>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="space-y-6">
            @if($related->isNotEmpty())
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
                <h3 class="font-bold text-slate-900 dark:text-white mb-5">Artikel Terkait</h3>
                <div class="space-y-4">
                    @foreach($related as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="flex gap-4 group">
                        <div class="w-20 h-16 flex-shrink-0 rounded-xl overflow-hidden bg-primary-50 dark:bg-primary-900/20">
                            @if($rel->thumbnail)
                            <img src="{{ $rel->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="">
                            @else
                            <div class="w-full h-full flex items-center justify-center"><svg class="w-6 h-6 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">{{ $rel->title }}</h4>
                            <span class="text-xs text-slate-400 mt-1">{{ $rel->published_at?->format('d M Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-6 text-white">
                <h3 class="font-bold text-lg mb-2">Butuh Bantuan?</h3>
                <p class="text-white/70 text-sm mb-4">Tim medis kami siap membantu Anda kapan saja.</p>
                <a href="{{ route('contact.index') }}" class="block text-center px-4 py-2.5 bg-white text-primary-700 font-bold rounded-xl text-sm hover:bg-primary-50 transition-colors">Hubungi Kami</a>
            </div>
        </aside>
    </div>
</div>
@endsection
