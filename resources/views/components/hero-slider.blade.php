{{-- resources/views/components/hero-slider.blade.php --}}

<section class="relative overflow-hidden" x-data="heroSlider()" x-init="init()">

  <div class="relative min-h-[90vh]">

    {{-- ── BACKGROUNDS ── --}}
    <div class="absolute inset-0">
      @foreach($heroSlides as $i => $slide)
      <div
        class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
        :style="current === {{ $i }} ? 'opacity:1; z-index:1' : 'opacity:0; z-index:0'"
      >
        @if($slide->bg_image)
          <img src="{{ $slide->bg_image_url }}" alt="" class="w-full h-full object-cover">
          <div class="absolute inset-0" style="background: linear-gradient(135deg,
            rgba({{ $slide->overlay_from ?? '15,23,42' }},0.92) 0%,
            rgba({{ $slide->overlay_mid  ?? '30,58,95' }},0.82) 45%,
            rgba({{ $slide->overlay_to   ?? '29,119,232' }},0.75) 100%)">
          </div>
        @else
          <div class="absolute inset-0 hero-gradient"></div>
        @endif
        <div class="absolute top-20 right-20 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl"></div>
      </div>
      @endforeach
    </div>

    {{-- ── CONTENT ── --}}
    <div class="absolute inset-0 flex items-center" style="z-index:10">
      <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">

        @foreach($heroSlides as $i => $slide)
        <div
          class="grid lg:grid-cols-2 gap-16 items-center"
          x-show="current === {{ $i }}"
          x-transition:enter="transition-opacity duration-700"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition-opacity duration-300"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          x-cloak
        >
          {{-- Left --}}
          <div class="text-white">
            @if($slide->badge_text)
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-8">
              <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
              {{ $slide->badge_text }}
            </div>
            @endif

            <h1 class="font-bold text-4xl sm:text-5xl lg:text-6xl leading-tight mb-6">
              {!! nl2br(e($slide->title)) !!}
            </h1>

            @if($slide->subtitle)
            <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-xl">{{ $slide->subtitle }}</p>
            @endif

            <div class="flex flex-col sm:flex-row gap-4">
              @if($slide->btn1_label && $slide->btn1_url)
              <a href="{{ $slide->btn1_url }}"
                 class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-primary-700 font-bold rounded-2xl hover:bg-primary-50 transition-all hover:shadow-xl text-sm">
                {{ $slide->btn1_label }}
              </a>
              @endif
              @if($slide->btn2_label && $slide->btn2_url)
              <a href="{{ $slide->btn2_url }}"
                 class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 border border-white/30 backdrop-blur-sm text-white font-semibold rounded-2xl hover:bg-white/20 transition-all text-sm">
                {{ $slide->btn2_label }}
              </a>
              @endif
            </div>

            @if($slide->show_stats)
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
            @endif
          </div>

          {{-- Right card --}}
          <div class="hidden lg:block">
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-white">
              <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-primary-400/30 flex items-center justify-center">
                  <svg class="w-6 h-6 text-primary-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                  </svg>
                </div>
                <div>
                  <div class="font-bold text-lg">Layanan Tersedia</div>
                  <div class="text-white/60 text-sm">Tersedia sekarang</div>
                </div>
              </div>
              <div class="space-y-3">
                @foreach([
                  ['IGD 24 Jam','Penanganan darurat cepat','#ef4444','M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0'],
                  ['Poli Spesialis','Konsultasi dokter ahli','#3b82f6','M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z'],
                  ['Rawat Inap','Kamar nyaman & bersih','#10b981','M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
                  ['Laboratorium','Hasil akurat & cepat','#f59e0b','M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .03 2.798-1.352 2.798H4.15c-1.382 0-2.352-1.798-1.352-2.798L4.15 15.3'],
                ] as $srv)
                <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3 hover:bg-white/10 transition-colors cursor-pointer">
                  <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:{{ $srv[2] }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $srv[3] }}"/>
                  </svg>
                  <div class="flex-1">
                    <div class="text-sm font-semibold">{{ $srv[0] }}</div>
                    <div class="text-xs text-white/50">{{ $srv[1] }}</div>
                  </div>
                  <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                  </svg>
                </div>
                @endforeach
              </div>
            </div>
          </div>

        </div>
        @endforeach

      </div>
    </div>

    {{-- ── SLIDER CONTROLS ── --}}
    @if($heroSlides->count() > 1)
    <button @click="prev()"
      class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm text-white hover:bg-white/20 transition-all flex items-center justify-center group">
      <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
      </svg>
    </button>
    <button @click="next()"
      class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm text-white hover:bg-white/20 transition-all flex items-center justify-center group">
      <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
      </svg>
    </button>

    <div class="absolute bottom-16 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
      @foreach($heroSlides as $i => $slide)
      <button @click="goTo({{ $i }})"
        class="transition-all duration-300 rounded-full"
        :class="current === {{ $i }} ? 'w-8 h-2.5 bg-white' : 'w-2.5 h-2.5 bg-white/40 hover:bg-white/70'">
      </button>
      @endforeach
    </div>

    <div class="absolute bottom-0 left-0 z-20 h-0.5 bg-white/20 w-full">
      <div class="h-full bg-primary-400" :style="'width:' + progress + '%'" style="transition: width 0.1s linear"></div>
    </div>
    @endif

  </div>

  {{-- Wave --}}
  <div class="absolute bottom-0 left-0 right-0" style="z-index:10">
    <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
      <path d="M0 60L60 50C120 40 240 20 360 15C480 10 600 20 720 25C840 30 960 30 1080 25C1200 20 1320 10 1380 5L1440 0V60H0Z" class="fill-white dark:fill-slate-950"/>
    </svg>
  </div>
</section>

@push('scripts')
<script>
function heroSlider() {
  return {
    current: 0,
    total: {{ $heroSlides->count() }},
    progress: 0,
    timer: null,
    interval: 6000,

    init() {
      if (this.total > 1) this.startAutoplay();
    },

    startAutoplay() {
      let start = null;
      const tick = (ts) => {
        if (!start) start = ts;
        this.progress = Math.min(((ts - start) / this.interval) * 100, 100);
        if (this.progress >= 100) {
          this.next();
          start = ts;
        }
        this.timer = requestAnimationFrame(tick);
      };
      this.timer = requestAnimationFrame(tick);
    },

    resetAutoplay() {
      if (this.timer) cancelAnimationFrame(this.timer);
      this.progress = 0;
      if (this.total > 1) this.startAutoplay();
    },

    next() { this.current = (this.current + 1) % this.total; this.resetAutoplay(); },
    prev() { this.current = (this.current - 1 + this.total) % this.total; this.resetAutoplay(); },
    goTo(i)  { this.current = i; this.resetAutoplay(); },
  }
}
</script>
@endpush