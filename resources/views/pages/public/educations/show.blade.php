{{-- resources/views/pages/public/educations/show.blade.php --}}
@extends('layouts.app')
@section('title', $education->title)
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a><span>/</span>
        <a href="{{ route('educations.index') }}" class="hover:text-primary-600">Edukasi</a><span>/</span>
        <span class="text-slate-600 dark:text-slate-300 line-clamp-1">{{ $education->title }}</span>
    </nav>
    <div class="mb-8">
        <span class="inline-block bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">
            {{ $education->type === 'video' ? '🎥 Video' : ($education->type === 'infographic' ? '🖼️ Infografis' : '📄 Artikel') }}
        </span>
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white leading-tight mb-4">{{ $education->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
            <span>{{ $education->published_at?->format('d F Y') }}</span>
            <span>•</span>
            <span>{{ number_format($education->views) }} dilihat</span>
        </div>
    </div>

    {{-- Video --}}
    @if($education->video_url)
    <div class="rounded-2xl overflow-hidden mb-8 aspect-video bg-black">
        <iframe src="{{ $education->video_url }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    @elseif($education->thumbnail)
    <div class="rounded-2xl overflow-hidden mb-8"><img src="{{ $education->thumbnail_url }}" alt="{{ $education->title }}" class="w-full max-h-96 object-cover"></div>
    @endif

    @if($education->content)
    <div class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed mb-12">
        {!! $education->content !!}
    </div>
    @endif

    @if($related->isNotEmpty())
    <div class="border-t border-slate-100 dark:border-slate-800 pt-10">
        <h2 class="font-bold text-slate-900 dark:text-white text-xl mb-6">Konten Terkait</h2>
        <div class="grid sm:grid-cols-3 gap-5">
            @foreach($related as $rel)
            <a href="{{ route('educations.show', $rel->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
                <div class="h-36 bg-primary-50 dark:bg-primary-900/20 overflow-hidden">
                    @if($rel->thumbnail)<img src="{{ $rel->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="">
                    @else<div class="w-full h-full flex items-center justify-center text-3xl">{{ $rel->type === 'video' ? '🎥' : '📄' }}</div>@endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-slate-900 dark:text-white group-hover:text-primary-600 line-clamp-2">{{ $rel->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
