{{-- resources/views/admin/hero-sliders/index.blade.php --}}
{{-- Route resource: admin/hero-sliders --}}

@extends('layouts.admin')
@section('title', 'Kelola Hero Slider')

@section('content')
<div x-data="sliderAdmin()" class="min-h-screen bg-slate-50 dark:bg-slate-950 p-6">

  {{-- ══ PAGE HEADER ══ --}}
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Hero Slider</h1>
      <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola slide pada halaman beranda</p>
    </div>
    <button @click="openCreate()"
      class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all text-sm shadow-lg shadow-primary-300/30">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
      </svg>
      Tambah Slide
    </button>
  </div>

  {{-- ══ FLASH MESSAGES ══ --}}
  @if(session('success'))
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false,4000)"
       class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl mb-6 text-sm">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif

  {{-- ══ SLIDES TABLE ══ --}}
  <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm mb-10">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-xs tracking-wider">
          <tr>
            <th class="px-5 py-4 text-left w-16">Urutan</th>
            <th class="px-5 py-4 text-left">Judul</th>
            <th class="px-5 py-4 text-left">Badge</th>
            <th class="px-5 py-4 text-center">Gambar BG</th>
            <th class="px-5 py-4 text-center">Statistik</th>
            <th class="px-5 py-4 text-center">Status</th>
            <th class="px-5 py-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($slides as $slide)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors group">
            <td class="px-5 py-4">
              <div class="flex items-center gap-1">
                {{-- Drag handle or order buttons --}}
                <form method="POST" action="{{ route('admin.hero-sliders.reorder', $slide) }}" class="inline">
                  @csrf @method('PATCH')
                  <input type="hidden" name="direction" value="up">
                  <button type="submit" class="p-1 text-slate-400 hover:text-primary-600">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/></svg>
                  </button>
                </form>
                <span class="font-bold text-slate-700 dark:text-slate-300 w-5 text-center">{{ $slide->order }}</span>
                <form method="POST" action="{{ route('admin.hero-sliders.reorder', $slide) }}" class="inline">
                  @csrf @method('PATCH')
                  <input type="hidden" name="direction" value="down">
                  <button type="submit" class="p-1 text-slate-400 hover:text-primary-600">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                  </button>
                </form>
              </div>
            </td>
            <td class="px-5 py-4">
              <div class="font-semibold text-slate-900 dark:text-white max-w-xs truncate">{{ $slide->title }}</div>
              @if($slide->subtitle)
              <div class="text-slate-400 text-xs mt-0.5 max-w-xs truncate">{{ $slide->subtitle }}</div>
              @endif
            </td>
            <td class="px-5 py-4 text-slate-500 dark:text-slate-400">{{ $slide->badge_text ?? '—' }}</td>
            <td class="px-5 py-4 text-center">
              @if($slide->bg_image)
                <img src="{{ $slide->bg_image_url }}" class="w-16 h-10 object-cover rounded-lg mx-auto border border-slate-100 dark:border-slate-700" alt="">
              @else
                <span class="text-slate-300 dark:text-slate-600 text-xs">Tidak ada</span>
              @endif
            </td>
            <td class="px-5 py-4 text-center">
              <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $slide->show_stats ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-400 dark:bg-slate-800' }}">
                {{ $slide->show_stats ? 'Tampil' : 'Sembunyikan' }}
              </span>
            </td>
            <td class="px-5 py-4 text-center">
              <form method="POST" action="{{ route('admin.hero-sliders.toggle', $slide) }}" class="inline">
                @csrf @method('PATCH')
                <button type="submit" class="px-2.5 py-1 rounded-full text-xs font-semibold transition-all
                  {{ $slide->is_active
                      ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400 hover:bg-primary-100'
                      : 'bg-slate-100 text-slate-400 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700' }}">
                  {{ $slide->is_active ? 'Aktif' : 'Nonaktif' }}
                </button>
              </form>
            </td>
            <td class="px-5 py-4 text-center">
              <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button @click="openEdit({{ $slide->toJson() }})"
                  class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                  </svg>
                </button>
                <form method="POST" action="{{ route('admin.hero-sliders.destroy', $slide) }}"
                  onsubmit="return confirm('Hapus slide ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="px-5 py-16 text-center text-slate-400">
              <svg class="w-12 h-12 mx-auto mb-3 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
              </svg>
              Belum ada slide. Klik "Tambah Slide" untuk memulai.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ══════════════════════════════════════════ --}}
  {{-- ══        FOOTER SETTINGS SECTION        ══ --}}
  {{-- ══════════════════════════════════════════ --}}
  <div class="mb-8">
    <div class="flex items-center gap-3 mb-6">
      <div class="w-8 h-8 rounded-xl bg-slate-900 dark:bg-slate-700 flex items-center justify-center">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
        </svg>
      </div>
      <div>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Pengaturan Footer & Logo</h2>
        <p class="text-slate-400 text-sm">Kelola logo, nama rumah sakit, dan informasi kontak di footer</p>
      </div>
    </div>

    <form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      @csrf @method('PUT')

      {{-- Logo & Branding --}}
      <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
        <h3 class="font-semibold text-slate-900 dark:text-white mb-5 flex items-center gap-2">
          <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
          Logo & Branding
        </h3>

        {{-- Logo Upload --}}
        <div class="mb-5">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Logo Rumah Sakit
          </label>
          <div x-data="{ preview: '{{ $settings->logo_url ?? '' }}' }"
               class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-4 text-center hover:border-primary-400 transition-colors">
            <div x-show="preview" class="mb-3">
              <img :src="preview" class="h-16 mx-auto object-contain rounded-lg">
            </div>
            <div x-show="!preview" class="mb-3">
              <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
              </div>
            </div>
            <label class="cursor-pointer">
              <span class="text-xs text-primary-600 font-semibold hover:underline">Pilih gambar logo</span>
              <input type="file" name="logo" accept="image/*" class="hidden"
                @change="preview = URL.createObjectURL($event.target.files[0])">
            </label>
            <p class="text-xs text-slate-400 mt-1">PNG, SVG, JPG · Maks 2MB</p>
          </div>
        </div>

        {{-- Favicon Upload --}}
        <div class="mb-5">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Favicon
          </label>
          <div x-data="{ preview: '{{ $settings->favicon_url ?? '' }}' }"
               class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-3 text-center hover:border-primary-400 transition-colors">
            <div x-show="preview" class="mb-2">
              <img :src="preview" class="w-8 h-8 mx-auto object-contain">
            </div>
            <label class="cursor-pointer">
              <span class="text-xs text-primary-600 font-semibold hover:underline">Pilih favicon</span>
              <input type="file" name="favicon" accept="image/*" class="hidden"
                @change="preview = URL.createObjectURL($event.target.files[0])">
            </label>
            <p class="text-xs text-slate-400 mt-1">ICO, PNG 32×32</p>
          </div>
        </div>

        {{-- Hospital Name --}}
        <div class="mb-4">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Nama Rumah Sakit
          </label>
          <input type="text" name="hospital_name"
            value="{{ old('hospital_name', $settings->hospital_name ?? 'RS Medika Nusantara') }}"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
        </div>

        {{-- Tagline --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Tagline / Sub-nama
          </label>
          <input type="text" name="hospital_tagline"
            value="{{ old('hospital_tagline', $settings->hospital_tagline ?? 'Kesehatan Anda Prioritas Kami') }}"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
        </div>
      </div>

      {{-- Contact & Social --}}
      <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
        <h3 class="font-semibold text-slate-900 dark:text-white mb-5 flex items-center gap-2">
          <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          Kontak & Alamat
        </h3>
        @foreach([
          ['address', 'Alamat Lengkap', 'textarea', 'Jl. Kesehatan No. 1, Jakarta Selatan 12345'],
          ['phone',   'Nomor Telepon',   'text',     '(021) 1234-5678'],
          ['email',   'Email',           'email',    'info@rsmedika.com'],
          ['hours',   'Jam Operasional', 'text',     'IGD: 24 Jam / 7 Hari'],
        ] as [$field, $label, $type, $placeholder])
        <div class="mb-4">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            {{ $label }}
          </label>
          @if($type === 'textarea')
          <textarea name="{{ $field }}" rows="2"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none resize-none"
            placeholder="{{ $placeholder }}">{{ old($field, $settings->$field ?? '') }}</textarea>
          @else
          <input type="{{ $type }}" name="{{ $field }}"
            value="{{ old($field, $settings->$field ?? '') }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
          @endif
        </div>
        @endforeach

        {{-- Footer description --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Deskripsi Footer
          </label>
          <textarea name="footer_description" rows="3"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none resize-none"
            placeholder="Melayani masyarakat dengan penuh dedikasi...">{{ old('footer_description', $settings->footer_description ?? '') }}</textarea>
        </div>
      </div>

      {{-- Social Media --}}
      <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6">
        <h3 class="font-semibold text-slate-900 dark:text-white mb-5 flex items-center gap-2">
          <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
          </svg>
          Media Sosial
        </h3>
        @foreach([
          ['social_facebook',  'Facebook URL',  'https://facebook.com/...'],
          ['social_twitter',   'Twitter/X URL', 'https://twitter.com/...'],
          ['social_instagram', 'Instagram URL', 'https://instagram.com/...'],
          ['social_youtube',   'YouTube URL',   'https://youtube.com/...'],
          ['social_whatsapp',  'WhatsApp (no. lengkap)', '6281234567890'],
        ] as [$field, $label, $placeholder])
        <div class="mb-4">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">{{ $label }}</label>
          <input type="text" name="{{ $field }}"
            value="{{ old($field, $settings->$field ?? '') }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
        </div>
        @endforeach

        {{-- Copyright text --}}
        <div class="mb-6">
          <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
            Teks Copyright
          </label>
          <input type="text" name="copyright_text"
            value="{{ old('copyright_text', $settings->copyright_text ?? '© {year} RS Company. Hak cipta dilindungi undang-undang.') }}"
            class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none"
            placeholder="Gunakan {year} untuk tahun otomatis">
        </div>

        <button type="submit"
          class="w-full py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-primary-300/30">
          Simpan Semua Pengaturan
        </button>
      </div>
    </form>
  </div>

  {{-- ══════════════════════════════════════════ --}}
  {{-- ══    CREATE / EDIT SLIDE MODAL          ══ --}}
  {{-- ══════════════════════════════════════════ --}}
  <div x-show="modalOpen" x-cloak
       class="fixed inset-0 z-50 flex items-center justify-center p-4"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="modalOpen = false"></div>

    {{-- Panel --}}
    <div class="relative bg-white dark:bg-slate-900 rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">

      <div class="sticky top-0 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 px-6 py-4 flex items-center justify-between rounded-t-3xl z-10">
        <h2 class="font-bold text-lg text-slate-900 dark:text-white" x-text="editing ? 'Edit Slide' : 'Tambah Slide Baru'"></h2>
        <button @click="modalOpen = false" class="p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
          <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <form method="POST"
            :action="editing ? '{{ route('admin.hero-sliders.index') }}/' + form.id : '{{ route('admin.hero-sliders.store') }}'"
            enctype="multipart/form-data"
            class="p-6 space-y-5">
        @csrf
        <input type="hidden" name="_method" :value="editing ? 'PUT' : 'POST'">
        <input type="hidden" name="id" :value="form.id">

        {{-- Title --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Judul Slide *</label>
          <textarea name="title" rows="2" required
            x-model="form.title"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none"
            placeholder="Kesehatan Anda&#10;Prioritas Kami"></textarea>
          <p class="text-xs text-slate-400 mt-1">Gunakan enter untuk baris baru (akan muncul di heading)</p>
        </div>

        {{-- Subtitle --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Subtitle / Deskripsi</label>
          <textarea name="subtitle" rows="2"
            x-model="form.subtitle"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none"
            placeholder="RS Company hadir dengan layanan kesehatan komprehensif..."></textarea>
        </div>

        {{-- Badge --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Teks Badge (opsional)</label>
          <input type="text" name="badge_text"
            x-model="form.badge_text"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none"
            placeholder="Melayani 24/7 — IGD Siap Membantu">
        </div>

        {{-- Buttons --}}
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tombol 1 — Label</label>
            <input type="text" name="btn1_label" x-model="form.btn1_label"
              class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 outline-none"
              placeholder="Lihat Layanan">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tombol 1 — URL</label>
            <input type="text" name="btn1_url" x-model="form.btn1_url"
              class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 outline-none"
              placeholder="/layanan">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tombol 2 — Label</label>
            <input type="text" name="btn2_label" x-model="form.btn2_label"
              class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 outline-none"
              placeholder="Hubungi Kami">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tombol 2 — URL</label>
            <input type="text" name="btn2_url" x-model="form.btn2_url"
              class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 outline-none"
              placeholder="/kontak">
          </div>
        </div>

        {{-- Background Image --}}
        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Gambar Background (opsional)</label>
          <div x-data="{ preview: form.bg_image_url ?? null }"
               class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-5 text-center hover:border-primary-400 transition-colors">
            <div x-show="preview" class="mb-3">
              <img :src="preview" class="h-32 mx-auto object-cover rounded-xl w-full">
            </div>
            <div x-show="!preview" class="mb-3 py-4">
              <svg class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
              </svg>
            </div>
            <label class="cursor-pointer">
              <span class="text-sm text-primary-600 font-semibold hover:underline">Pilih gambar background</span>
              <input type="file" name="bg_image" accept="image/*" class="hidden"
                @change="preview = URL.createObjectURL($event.target.files[0])">
            </label>
            <p class="text-xs text-slate-400 mt-1">JPG, PNG · Rekomendasi 1920×1080px · Maks 5MB</p>
          </div>
        </div>

        {{-- Overlay Colors --}}
        <div class="grid grid-cols-3 gap-4">
          @foreach([
            ['overlay_from', 'Overlay Dari (RGB)', '15,23,42'],
            ['overlay_mid',  'Overlay Tengah (RGB)', '30,58,95'],
            ['overlay_to',   'Overlay Ke (RGB)', '29,119,232'],
          ] as [$field, $label, $placeholder])
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">{{ $label }}</label>
            <input type="text" name="{{ $field }}" :value="form.{{ $field }}"
              class="w-full px-3 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 outline-none"
              placeholder="{{ $placeholder }}">
          </div>
          @endforeach
        </div>

        {{-- Toggles --}}
        <div class="flex items-center gap-6 pt-2">
          <label class="flex items-center gap-3 cursor-pointer">
            <div class="relative">
              <input type="checkbox" name="show_stats" class="sr-only peer" :checked="form.show_stats">
              <div class="w-11 h-6 rounded-full bg-slate-200 dark:bg-slate-700 peer-checked:bg-primary-600 transition-colors"></div>
              <div class="absolute left-0.5 top-0.5 w-5 h-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></div>
            </div>
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tampilkan Statistik</span>
          </label>
          <label class="flex items-center gap-3 cursor-pointer">
            <div class="relative">
              <input type="checkbox" name="is_active" class="sr-only peer" :checked="form.is_active ?? true">
              <div class="w-11 h-6 rounded-full bg-slate-200 dark:bg-slate-700 peer-checked:bg-primary-600 transition-colors"></div>
              <div class="absolute left-0.5 top-0.5 w-5 h-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></div>
            </div>
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Aktifkan Slide</span>
          </label>
        </div>

        {{-- Submit --}}
        <div class="flex gap-3 pt-2">
          <button type="button" @click="modalOpen = false"
            class="flex-1 py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl transition-all text-sm">
            Batal
          </button>
          <button type="submit"
            class="flex-1 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-primary-300/30">
            <span x-text="editing ? 'Simpan Perubahan' : 'Tambah Slide'"></span>
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
function sliderAdmin() {
  return {
    modalOpen: false,
    editing: false,
    form: {
      id: null,
      title: '',
      subtitle: '',
      badge_text: '',
      btn1_label: 'Lihat Layanan',
      btn1_url: '/layanan',
      btn2_label: 'Hubungi Kami',
      btn2_url: '/kontak',
      show_stats: true,
      is_active: true,
      bg_image_url: null,
      overlay_from: '15,23,42',
      overlay_mid: '30,58,95',
      overlay_to: '29,119,232',
    },

    openCreate() {
      this.editing = false;
      this.form = {
        id: null, title: '', subtitle: '', badge_text: '',
        btn1_label: 'Lihat Layanan', btn1_url: '/layanan',
        btn2_label: 'Hubungi Kami', btn2_url: '/kontak',
        show_stats: true, is_active: true, bg_image_url: null,
        overlay_from: '15,23,42', overlay_mid: '30,58,95', overlay_to: '29,119,232',
      };
      this.modalOpen = true;
    },

    openEdit(slide) {
      this.editing = true;
      this.form = { ...slide };
      this.modalOpen = true;
    },
  }
}
</script>
@endpush