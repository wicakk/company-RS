@extends('layouts.app')
@section('title','Tentang Kami')
@section('content')

<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-white text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
            Tentang Kami
        </div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Mengenal <span class="text-primary-300">RS Medika</span> Nusantara</h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto">Lebih dari dua dekade melayani masyarakat Indonesia dengan penuh dedikasi</p>
    </div>
</section>

{{-- Profil --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-6">Profil Rumah Sakit</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-6">Berdiri Sejak <span class="gradient-text">1995</span></h2>
            <div class="space-y-4 text-slate-600 dark:text-slate-400 leading-relaxed text-sm">
                <p>RS Company adalah rumah sakit swasta terkemuka yang telah berdiri sejak tahun 1995 dan berkomitmen untuk memberikan pelayanan kesehatan terbaik kepada masyarakat Indonesia.</p>
                <p>Dengan pengalaman lebih dari 29 tahun, kami telah berkembang menjadi salah satu rumah sakit terpercaya di wilayah Jakarta Selatan, melayani lebih dari 50.000 pasien setiap tahunnya.</p>
                <p>Kami bangga telah mendapatkan akreditasi Paripurna dari KARS, yang merupakan pengakuan tertinggi atas standar kualitas pelayanan kami.</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-5">
            @foreach([
                ['1995','Tahun Berdiri','text-primary-600','bg-primary-50 dark:bg-primary-900/20'],
                ['50K+','Pasien/Tahun','text-emerald-600','bg-emerald-50 dark:bg-emerald-900/20'],
                ['★★★★★','Akreditasi KARS','text-amber-600','bg-amber-50 dark:bg-amber-900/20'],
                ['24/7','Layanan IGD','text-red-600','bg-red-50 dark:bg-red-900/20'],
            ] as $s)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6 text-center card-hover">
                <div class="text-2xl font-bold {{ $s[2] }} mb-2">{{ $s[0] }}</div>
                <div class="text-slate-500 dark:text-slate-400 text-sm">{{ $s[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Visi & Misi --}}
<section class="bg-slate-50 dark:bg-slate-900/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-4">Visi & Misi</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">Landasan <span class="gradient-text">Kami Berkarya</span></h2>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-10 text-white">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Visi</h3>
                <p class="text-white/85 leading-relaxed">Menjadi rumah sakit pilihan utama masyarakat Indonesia dengan pelayanan kesehatan berstandar internasional yang mengutamakan keselamatan, kualitas, dan kepuasan pasien.</p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-10">
                <div class="w-14 h-14 bg-primary-50 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-5">Misi</h3>
                <ul class="space-y-3">
                    @foreach([
                        'Memberikan pelayanan medis bermutu tinggi dengan menggunakan teknologi terkini.',
                        'Mengembangkan sumber daya manusia yang profesional, kompeten, dan berintegritas.',
                        'Menciptakan lingkungan rumah sakit yang nyaman, bersih, dan aman bagi pasien.',
                        'Meningkatkan aksesibilitas layanan kesehatan untuk seluruh lapisan masyarakat.',
                        'Berperan aktif dalam edukasi kesehatan dan pencegahan penyakit di masyarakat.',
                    ] as $misi)
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ $misi }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Sejarah --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-14">
        <div class="inline-flex items-center gap-2 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Sejarah
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">Perjalanan <span class="gradient-text">Panjang Kami</span></h2>
    </div>
    <div class="space-y-8">
        @foreach([
            ['1995','Pendirian Rumah Sakit','RS Company resmi didirikan dengan kapasitas 50 tempat tidur dan 10 dokter spesialis.'],
            ['2002','Ekspansi dan Modernisasi','Pembangunan gedung baru menambah kapasitas hingga 150 tempat tidur, dilengkapi ICU modern.'],
            ['2010','Akreditasi Paripurna','Meraih akreditasi tertinggi KARS Paripurna untuk pertama kalinya.'],
            ['2015','Pengembangan Digital','Implementasi sistem informasi rumah sakit (SIMRS) terintegrasi dan layanan online.'],
            ['2020','RS di Masa Pandemi','Menjadi garda terdepan penanganan COVID-19.'],
            ['2024','Era Baru Pelayanan','Meluncurkan website baru dan terus berinovasi untuk pelayanan yang lebih baik.'],
        ] as $i => $h)
        <div class="flex items-start gap-6">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-2xl bg-primary-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-primary-300/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                </div>
                @if($i < 5)<div class="w-0.5 h-8 bg-primary-100 dark:bg-primary-900/30 mt-2"></div>@endif
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6 flex-1 card-hover">
                <div class="text-primary-600 dark:text-primary-400 font-bold text-lg mb-1">{{ $h[0] }}</div>
                <h3 class="font-bold text-slate-900 dark:text-white mb-2">{{ $h[1] }}</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $h[2] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- Nilai --}}
<section class="bg-slate-50 dark:bg-slate-900/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">Nilai-Nilai <span class="gradient-text">Kami</span></h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z','Integritas','Kami selalu jujur dan transparan dalam setiap aspek pelayanan'],
                ['M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z','Empati','Memahami dan peduli terhadap kondisi setiap pasien yang kami layani'],
                ['M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z','Profesional','Tenaga medis bersertifikat dan terus mengembangkan kompetensi'],
                ['M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .03 2.798-1.352 2.798H4.15c-1.382 0-2.352-1.798-1.352-2.798L4.15 15.3','Inovatif','Terus berinovasi mengadopsi teknologi medis terkini'],
            ] as $v)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6 text-center card-hover">
                <div class="w-12 h-12 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $v[0] }}"/></svg>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white mb-2">{{ $v[1] }}</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $v[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
