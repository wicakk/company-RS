@extends('layouts.app')
@section('title','Beranda')
@section('content')

{{-- ── HERO ── --}}
<section class="relative overflow-hidden">
    <div class="hero-gradient min-h-[90vh] flex items-center relative">
        <div class="absolute top-20 right-20 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- Left --}}
                <div class="text-white animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-8">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        Melayani 24/7 — IGD Siap Membantu
                    </div>
                    <h1 class="font-bold text-4xl sm:text-5xl lg:text-6xl leading-tight mb-6">
                        Kesehatan Anda<br>
                        <span class="text-primary-300">Prioritas</span> Kami
                    </h1>
                    <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-xl">
                        RS Company hadir dengan layanan kesehatan komprehensif, didukung dokter spesialis berpengalaman dan fasilitas medis modern berstandar internasional.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-primary-700 font-bold rounded-2xl hover:bg-primary-50 transition-all hover:shadow-xl text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                            Lihat Layanan
                        </a>
                        <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 border border-white/30 backdrop-blur-sm text-white font-semibold rounded-2xl hover:bg-white/20 transition-all text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            Hubungi Kami
                        </a>
                    </div>
                    {{-- Stats --}}
                    <div class="flex flex-wrap gap-8 mt-14 pt-10 border-t border-white/20">
                        @foreach([
                            [$stats['doctors'].'+'  , 'Dokter Spesialis'],
                            [$stats['services'].'+'  , 'Unit Layanan'],
                            ['50K+'                  , 'Pasien Dilayani'],
                            ['29+'                   , 'Tahun Pengalaman'],
                        ] as $s)
                        <div>
                            <div class="text-3xl font-bold text-white">{{ $s[0] }}</div>
                            <div class="text-white/60 text-sm mt-1">{{ $s[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Card --}}
                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-white">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-primary-400/30 flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            </div>
                            <div>
                                <div class="font-bold text-lg">Layanan Tersedia</div>
                                <div class="text-white/60 text-sm">Tersedia sekarang</div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            @foreach([
                                ['IGD 24 Jam',     'Penanganan darurat cepat', '#ef4444',
                                 'M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0'],
                                ['Poli Spesialis',  'Konsultasi dokter ahli',  '#3b82f6',
                                 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z'],
                                ['Rawat Inap',      'Kamar nyaman & bersih',   '#10b981',
                                 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
                                ['Laboratorium',    'Hasil akurat & cepat',    '#f59e0b',
                                 'M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .03 2.798-1.352 2.798H4.15c-1.382 0-2.352-1.798-1.352-2.798L4.15 15.3'],
                            ] as $srv)
                            <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 hover:bg-white/10 transition-colors">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:{{ $srv[2] }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $srv[3] }}"/>
                                </svg>
                                <div class="flex-1">
                                    <div class="text-sm font-semibold">{{ $srv[0] }}</div>
                                    <div class="text-xs text-white/50">{{ $srv[1] }}</div>
                                </div>
                                <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-green-500 text-white rounded-2xl px-5 py-3 shadow-xl">
                        <div class="text-xs font-semibold">Akreditasi</div>
                        <div class="font-bold">PARIPURNA ★★★★★</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 60L60 50C120 40 240 20 360 15C480 10 600 20 720 25C840 30 960 30 1080 25C1200 20 1320 10 1380 5L1440 0V60H0Z" class="fill-white dark:fill-slate-950"/>
        </svg>
    </div>
</section>

{{-- ── ANNOUNCEMENTS ── --}}
@if($announcements->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 mb-12">
    @foreach($announcements as $ann)
    <div class="flex items-start gap-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-100 dark:border-primary-800/50 rounded-2xl px-5 py-4 mb-3">
        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"/>
        </svg>
        <div class="flex-1">
            <span class="font-semibold text-primary-800 dark:text-primary-200 text-sm">{{ $ann->title }}:</span>
            <span class="text-primary-700 dark:text-primary-300 text-sm ml-1">{{ $ann->content }}</span>
        </div>
    </div>
    @endforeach
</section>
@endif

{{-- ── SERVICES ── --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-14">
        <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
            Layanan Kami
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Layanan <span class="gradient-text">Unggulan</span> Kami</h2>
        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-lg">Kami menyediakan berbagai layanan kesehatan komprehensif dengan standar tertinggi untuk memenuhi kebutuhan medis Anda dan keluarga.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
        <a href="{{ route('services.show', $service->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center mb-5 group-hover:bg-primary-100 transition-colors">
                @if($service->icon)
                <span class="text-2xl">{{ $service->icon }}</span>
                @else
                <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                @endif
            </div>
            <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2 group-hover:text-primary-600 transition-colors">{{ $service->name }}</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $service->short_description }}</p>
            <div class="flex items-center gap-1 mt-5 text-primary-600 dark:text-primary-400 text-sm font-semibold">
                Selengkapnya
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-12 text-slate-400">Belum ada layanan.</div>
        @endforelse
    </div>
    <div class="text-center mt-10">
        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-300/30 text-sm">
            Lihat Semua Layanan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </a>
    </div>
</section>

{{-- ── WHY US ── --}}
<section class="bg-slate-50 dark:bg-slate-900/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-6">Mengapa Pilih Kami</div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-6">Kepercayaan Pasien<br>adalah <span class="gradient-text">Segalanya</span></h2>
                <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed mb-8">Sejak 1995, kami telah melayani ribuan pasien dengan penuh dedikasi. Setiap keputusan yang kami buat selalu berfokus pada keselamatan dan kenyamanan pasien.</p>
                <div class="space-y-5">
                    @foreach([
                        ['Tenaga Medis Berpengalaman','Dokter dan perawat tersertifikasi dengan pengalaman bertahun-tahun.',
                         'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z'],
                        ['Fasilitas Modern','Peralatan medis mutakhir berstandar internasional untuk diagnosis dan penanganan optimal.',
                         'M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .03 2.798-1.352 2.798H4.15c-1.382 0-2.352-1.798-1.352-2.798L4.15 15.3'],
                        ['Pelayanan 24 Jam','IGD dan layanan darurat tersedia setiap saat, siap membantu kapanpun Anda membutuhkan.',
                         'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ] as $f)
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f[2] }}"/></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white mb-1">{{ $f[0] }}</h4>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $f[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                @foreach([
                    ['50.000+','Pasien Dilayani','text-primary-600'],
                    [$stats['doctors'].'+','Dokter Spesialis','text-emerald-600'],
                    ['99.2%','Tingkat Kepuasan','text-violet-600'],
                    ['24/7','Layanan Darurat','text-amber-600'],
                ] as $stat)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6 text-center card-hover">
                    <div class="text-3xl font-bold {{ $stat[2] }} mb-2">{{ $stat[0] }}</div>
                    <div class="text-slate-500 dark:text-slate-400 text-sm">{{ $stat[1] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── DOCTORS ── --}}
@if($doctors->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex items-end justify-between mb-12">
        <div>
            <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                Tim Dokter
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">Dokter <span class="gradient-text">Kami</span></h2>
        </div>
        <a href="{{ route('doctors.index') }}" class="hidden sm:inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold text-sm hover:gap-3 transition-all">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($doctors as $doctor)
        <a href="{{ route('doctors.show', $doctor->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden text-center">
            <div class="bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/20 dark:to-blue-900/20 pt-8 pb-4 px-4">
                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-28 h-28 rounded-full mx-auto object-cover border-4 border-white dark:border-slate-800 shadow-md group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-5">
                <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary-600 transition-colors mb-1">dr. {{ $doctor->name }}</h3>
                <p class="text-primary-600 dark:text-primary-400 text-xs font-semibold mb-2">{{ $doctor->specialization }}</p>
                @if($doctor->service)
                <span class="inline-block bg-slate-100 dark:bg-slate-800 text-slate-500 text-xs px-3 py-1 rounded-full">{{ $doctor->service->name }}</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ── LATEST NEWS ── --}}
@if($latestNews->isNotEmpty())
<section class="bg-slate-50 dark:bg-slate-900/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    Berita Terbaru
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">Informasi & <span class="gradient-text">Kegiatan</span></h2>
            </div>
            <a href="{{ route('articles.index') }}" class="hidden sm:inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold text-sm hover:gap-3 transition-all">
                Semua Berita
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestNews as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="group card-hover bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col">
                <div class="relative h-52 bg-gradient-to-br from-primary-100 to-blue-100 dark:from-primary-900/30 dark:to-blue-900/30 overflow-hidden">
                    @if($article->thumbnail)
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary-200 dark:text-primary-800" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    </div>
                    @endif
                    @if($article->category)
                    <span class="absolute top-3 left-3 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $article->category->name }}</span>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                            {{ $article->published_at?->format('d M Y') }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $article->views }} views
                        </span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary-600 transition-colors mb-2 line-clamp-2 flex-1">{{ $article->title }}</h3>
                    <div class="flex items-center gap-1 mt-4 text-primary-600 dark:text-primary-400 text-sm font-semibold">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── CTA ── --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hero-gradient rounded-3xl p-12 sm:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-80 h-80 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">Butuh Bantuan Medis Segera?</h2>
                <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">Tim medis kami siap membantu Anda 24 jam sehari, 7 hari seminggu.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:02112345678" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-primary-700 font-bold rounded-2xl hover:bg-primary-50 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        (021) 1234-5678
                    </a>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/15 border border-white/30 text-white font-semibold rounded-2xl hover:bg-white/25 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        Kirim Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
