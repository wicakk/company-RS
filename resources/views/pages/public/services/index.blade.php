{{-- resources/views/pages/public/services/index.blade.php --}}
@extends('layouts.app')
@section('title','Layanan Kami')
@section('content')

<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-white text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">Layanan Kami</div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Layanan <span class="text-primary-300">Kesehatan</span> Lengkap</h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto">Kami menyediakan berbagai layanan medis komprehensif dengan standar tertinggi untuk kesehatan optimal Anda.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($services->isEmpty())
        <div class="text-center py-20 text-slate-400">Belum ada layanan yang tersedia.</div>
    @else
        @php $grouped = $services->groupBy('category'); @endphp
        @foreach($grouped as $category => $items)
        <div class="mb-14">
            @if($category)
            <div class="flex items-center gap-4 mb-8">
                <div class="h-px flex-1 bg-slate-100 dark:bg-slate-800"></div>
                <span class="font-bold text-sm text-primary-600 dark:text-primary-400 uppercase tracking-widest bg-primary-50 dark:bg-primary-900/30 px-5 py-2 rounded-full">{{ $category }}</span>
                <div class="h-px flex-1 bg-slate-100 dark:bg-slate-800"></div>
            </div>
            @endif
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $service)
                <a href="{{ route('services.show', $service->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col">
                    @if($service->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @endif
                    <div class="p-6 flex flex-col flex-1">
                        <div class="w-12 h-12 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center mb-4 group-hover:bg-primary-100 transition-colors">
                            @if($service->icon)
                                <span class="text-2xl">{{ $service->icon }}</span>
                            @else
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $service->name }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed flex-1">{{ $service->short_description }}</p>
                        <div class="flex items-center gap-1 mt-5 text-primary-600 dark:text-primary-400 text-sm font-semibold">
                            Selengkapnya <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif
</section>
@endsection
