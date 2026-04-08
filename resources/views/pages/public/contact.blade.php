@extends('layouts.app')
@section('title','Kontak')
@section('content')

<section class="hero-gradient py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-white text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-semibold px-4 py-2 rounded-full mb-6">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
            Kontak
        </div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Hubungi <span class="text-primary-300">Kami</span></h1>
        <p class="text-white/70 text-lg max-w-xl mx-auto">Kami siap membantu Anda. Kirimkan pesan melalui formulir di bawah ini.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Info Cards --}}
        <div class="space-y-5">
            @foreach([
                ['icon'=>'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z','label'=>'Alamat','value'=>'Jl. Kesehatan No. 1, Kebayoran Baru, Jakarta Selatan 12345'],
                ['icon'=>'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z','label'=>'Telepon','value'=>"(021) 1234-5678\nIGD: (021) 1234-9999"],
                ['icon'=>'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75','label'=>'Email','value'=>"info@rsmedika.com\nhumas@rsmedika.com"],
                ['icon'=>'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z','label'=>'Jam Layanan','value'=>"IGD: 24 Jam / 7 Hari\nPoli: Senin–Sabtu 07.00–20.00"],
            ] as $info)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $info['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 dark:text-white text-sm mb-1">{{ $info['label'] }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed whitespace-pre-line">{{ $info['value'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Emergency --}}
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                    <span class="font-bold text-lg">IGD Darurat</span>
                </div>
                <div class="text-3xl font-bold mb-2">(021) 1234-9999</div>
                <div class="text-red-100 text-sm">Tersedia 24 jam sehari, 7 hari seminggu.</div>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Kirim Pesan</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Tim kami akan merespons dalam 1×24 jam.</p>

            @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 mb-6">
                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach($errors->all() as $e)<li class="flex items-center gap-2"><svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach([['name','Nama Lengkap','text','Nama lengkap Anda'],['email','Email','email','email@example.com']] as $f)
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ $f[1] }} <span class="text-red-500">*</span></label>
                        <input type="{{ $f[2] }}" name="{{ $f[0] }}" value="{{ old($f[0]) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-400 outline-none transition-all text-sm"
                               placeholder="{{ $f[3] }}">
                    </div>
                    @endforeach
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach([['phone','No. WhatsApp','tel','08xx-xxxx-xxxx',false],['subject','Tujuan','text','Perihal pesan Anda',true]] as $f)
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ $f[1] }} @if($f[4])<span class="text-red-500">*</span>@endif</label>
                        <input type="{{ $f[2] }}" name="{{ $f[0] }}" value="{{ old($f[0]) }}" {{ $f[4] ? 'required':'' }}
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-400 outline-none transition-all text-sm"
                               placeholder="{{ $f[3] }}">
                    </div>
                    @endforeach
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Pesan <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="10" required
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-400 outline-none transition-all text-sm resize-none"
                              placeholder="Tuliskan pesan Anda...">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-300/30 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    {{-- Google Maps --}}
    <div class="mt-12 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white">Lokasi Kami</h3>
                <p class="text-slate-500 text-sm">Jl. Kesehatan No. 1, Kebayoran Baru, Jakarta Selatan</p>
            </div>
        </div>
        <div class="h-80">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322223!2d106.8195613!3d-6.2087634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sGambir!5e0!3m2!1sen!2sid!4v1234567890"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="grayscale hover:grayscale-0 transition-all duration-500"></iframe>
        </div>
    </div>
</section>
@endsection
