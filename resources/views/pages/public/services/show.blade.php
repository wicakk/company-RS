{{-- resources/views/pages/public/services/show.blade.php --}}
@extends('layouts.app')
@section('title', $service->name)
@section('content')
<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white relative">
        <nav class="flex items-center gap-2 text-xs text-white/60 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a><span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-white">Layanan</a><span>/</span>
            <span>{{ $service->name }}</span>
        </nav>
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                {{ $service->icon ?: '🏥' }}
            </div>
            <div>
                <div class="text-white/60 text-sm mb-1">{{ $service->category }}</div>
                <h1 class="text-3xl sm:text-4xl font-bold">{{ $service->name }}</h1>
            </div>
        </div>
        <p class="text-white/70 text-lg max-w-2xl">{{ $service->short_description }}</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-10">
            @if($service->description)
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-5">Tentang Layanan Ini</h2>
                <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-400">{!! $service->description !!}</div>
            </div>
            @endif

            {{-- Jadwal --}}
            @if($schedules->isNotEmpty())
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-5">Jadwal Praktik</h2>
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                @foreach(['Hari','Dokter','Jam','Ruangan','Kuota'] as $h)
                                <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">{{ $h }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @foreach($schedules as $day => $daySchedules)
                            @foreach($daySchedules as $sch)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-5 py-3"><span class="text-xs px-2.5 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 rounded-full font-medium">{{ $day }}</span></td>
                                <td class="px-5 py-3 text-sm font-medium text-slate-900 dark:text-white">dr. {{ $sch->doctor->name }}</td>
                                <td class="px-5 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $sch->time_range }}</td>
                                <td class="px-5 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $sch->room ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $sch->quota }} pasien</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            {{-- Doctors --}}
            @if($doctors->isNotEmpty())
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
                <h3 class="font-bold text-slate-900 dark:text-white mb-5">Dokter di Layanan Ini</h3>
                <div class="space-y-4">
                    @foreach($doctors as $doctor)
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="flex items-center gap-3 group hover:bg-slate-50 dark:hover:bg-slate-800 -mx-2 px-2 py-2 rounded-xl transition-colors">
                        <img src="{{ $doctor->photo_url }}" class="w-12 h-12 rounded-full object-cover flex-shrink-0" alt="">
                        <div>
                            <div class="font-semibold text-slate-900 dark:text-white text-sm group-hover:text-primary-600 transition-colors">dr. {{ $doctor->name }}</div>
                            <div class="text-xs text-primary-600 dark:text-primary-400">{{ $doctor->specialization }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-6 text-white">
                <h3 class="font-bold mb-2">Butuh Informasi Lebih?</h3>
                <p class="text-white/70 text-sm mb-4">Hubungi tim kami untuk informasi lebih lanjut tentang layanan ini.</p>
                <a href="{{ route('contact.index') }}" class="block text-center px-4 py-2.5 bg-white text-primary-700 font-bold rounded-xl text-sm hover:bg-primary-50 transition-colors">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>
@endsection
