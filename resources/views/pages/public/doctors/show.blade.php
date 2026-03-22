{{-- resources/views/pages/public/doctors/show.blade.php --}}
@extends('layouts.app')
@section('title', 'dr. ' . $doctor->name)
@section('content')
<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white relative">
        <nav class="flex items-center gap-2 text-xs text-white/60 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a><span>/</span>
            <a href="{{ route('doctors.index') }}" class="hover:text-white">Dokter</a><span>/</span>
            <span>dr. {{ $doctor->name }}</span>
        </nav>
        <div class="flex items-center gap-6">
            <img src="{{ $doctor->photo_url }}" class="w-24 h-24 rounded-full object-cover border-4 border-white/30 shadow-xl flex-shrink-0" alt="">
            <div>
                <div class="text-white/60 text-sm mb-1">{{ $doctor->service?->name ?? 'Dokter' }}</div>
                <h1 class="text-3xl sm:text-4xl font-bold">dr. {{ $doctor->name }}</h1>
                <p class="text-primary-300 font-semibold text-lg">{{ $doctor->specialization }}</p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-8">
            @if($doctor->bio)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Tentang Dokter</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $doctor->bio }}</p>
            </div>
            @endif

            @if($schedules->isNotEmpty())
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-5">Jadwal Praktik</h2>
                <div class="space-y-3">
                    @foreach($schedules as $sch)
                    <div class="flex items-center justify-between bg-slate-50 dark:bg-slate-800 rounded-xl px-5 py-3.5">
                        <div class="flex items-center gap-4">
                            <span class="text-xs px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full font-semibold w-20 text-center">{{ $sch->day }}</span>
                            <div>
                                <div class="font-semibold text-slate-900 dark:text-white text-sm">{{ $sch->time_range }}</div>
                                @if($sch->room)<div class="text-xs text-slate-500">Ruang {{ $sch->room }}</div>@endif
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-slate-500">Kuota: {{ $sch->quota }} pasien</div>
                            <span class="text-xs text-green-600 dark:text-green-400 font-medium">Tersedia</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-5">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
                <h3 class="font-bold text-slate-900 dark:text-white mb-5">Informasi Dokter</h3>
                <div class="space-y-4">
                    @if($doctor->education)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">🎓</div>
                        <div>
                            <div class="text-xs text-slate-400 mb-0.5">Pendidikan</div>
                            <div class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $doctor->education }}</div>
                        </div>
                    </div>
                    @endif
                    @if($doctor->service)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">🏥</div>
                        <div>
                            <div class="text-xs text-slate-400 mb-0.5">Poli / Layanan</div>
                            <a href="{{ route('services.show', $doctor->service->slug) }}" class="text-sm text-primary-600 dark:text-primary-400 font-medium hover:underline">{{ $doctor->service->name }}</a>
                        </div>
                    </div>
                    @endif
                    @if($doctor->str_number)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">📋</div>
                        <div>
                            <div class="text-xs text-slate-400 mb-0.5">No. STR</div>
                            <div class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $doctor->str_number }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-6 text-white">
                <h3 class="font-bold mb-2">Konsultasi Sekarang</h3>
                <p class="text-white/70 text-sm mb-4">Daftarkan diri Anda untuk konsultasi dengan dr. {{ $doctor->name }}.</p>
                <a href="{{ route('contact.index') }}" class="block text-center px-4 py-2.5 bg-white text-primary-700 font-bold rounded-xl text-sm hover:bg-primary-50 transition-colors">Buat Janji</a>
            </div>
        </div>
    </div>
</section>
@endsection
