{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon dinamis --}}
    @if($siteSettings->favicon)
    <link rel="icon" type="image/png" href="{{ $siteSettings->favicon_url }}">
    @endif

    <title>@yield('title', $siteSettings->hospital_name ?? 'RS Company') - Rumah Sakit Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'RS Company - Rumah Sakit modern dengan layanan kesehatan terlengkap dan terpercaya.')">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    {{-- Tailwind CDN (untuk development) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        primary: {
                            50:  '#eff8ff',
                            100: '#dbeffe',
                            200: '#bfe3fd',
                            300: '#93d1fb',
                            400: '#60b5f7',
                            500: '#3b97f3',
                            600: '#1d77e8',
                            700: '#1560d5',
                            800: '#174dac',
                            900: '#184488',
                            950: '#142b54',
                        },
                        slate: {
                            750: '#2a3347',
                            850: '#1a2235',
                            950: '#0d1424',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'fade-in':    'fadeIn 0.5s ease-out',
                        'slide-down': 'slideDown 0.4s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeInUp:  { '0%': { opacity: '0', transform: 'translateY(20px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        fadeIn:    { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideDown: { '0%': { opacity: '0', transform: 'translateY(-10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom CSS --}}
    <style>
        [x-cloak] { display: none !important; }
        .gradient-text { background: linear-gradient(135deg, #1d77e8 0%, #60b5f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #1d77e8 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .dark .card-hover:hover { box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: #3b97f3; transition: width 0.3s ease; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .smooth-scroll { scroll-behavior: smooth; }
        * { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #3b97f3; border-radius: 3px; }
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
    </style>

    @stack('styles')
</head>
<body class="font-sans bg-white dark:bg-slate-950 text-slate-800 dark:text-slate-100 transition-colors duration-300 smooth-scroll">

    {{-- Announcement Banner --}}
    @if(isset($announcement))
    <div x-data="{ show: true }" x-show="show" class="bg-primary-600 text-white text-sm py-2 px-4 text-center relative">
        <span>📢 {{ $announcement->title }}</span>
        <button @click="show = false" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">✕</button>
    </div>
    @endif

    {{-- ══ NAVIGATION ══ --}}
    <nav x-data="{ mobileOpen: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 20"
         :class="scrolled ? 'bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-lg' : 'bg-white dark:bg-slate-900'"
         class="sticky top-0 z-50 transition-all duration-300 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo dinamis --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if($siteSettings->logo)
                        <img src="{{ $siteSettings->logo_url }}"
                             class="h-10 w-auto object-contain group-hover:opacity-90 transition-opacity"
                             alt="{{ $siteSettings->hospital_name }}">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-md group-hover:shadow-primary-300 transition-shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="hidden sm:block">
                        <div class="font-bold text-slate-900 dark:text-white text-base leading-tight">
                            {{ $siteSettings->hospital_name ?? 'RS Medika' }}
                        </div>
                        @if($siteSettings->hospital_tagline)
                        <div class="text-xs text-primary-600 font-medium">
                            {{ $siteSettings->hospital_tagline }}
                        </div>
                        @endif
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-1">
                    @php
                        $navItems = [
                            ['route' => 'home',             'label' => 'Beranda'],
                            ['route' => 'about',            'label' => 'Tentang Kami'],
                            ['route' => 'services.index',   'label' => 'Layanan'],
                            ['route' => 'doctors.index',    'label' => 'Dokter'],
                            ['route' => 'articles.index',   'label' => 'Berita'],
                            ['route' => 'educations.index', 'label' => 'Edukasi'],
                            ['route' => 'contact.index',    'label' => 'Kontak'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="nav-link px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->routeIs($item['route']) ? 'active text-primary-600 dark:text-primary-400' : '' }}">
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                </div>

                {{-- Right Controls --}}
                <div class="flex items-center gap-2">

                    {{-- Dark Mode Toggle --}}
                    <button @click="darkMode = !darkMode"
                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all"
                            :title="darkMode ? 'Mode Terang' : 'Mode Gelap'">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    {{-- Auth --}}
                    @auth
                        <div x-data="{ open: false }" class="relative hidden lg:block">
                            <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all text-sm font-medium text-slate-700 dark:text-slate-300">
                                <img src="{{ auth()->user()->avatar_url }}" class="w-6 h-6 rounded-full" alt="">
                                <span class="max-w-24 truncate">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="absolute right-0 mt-2 w-52 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 py-1 z-50">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                                    Panel Admin
                                </a>
                                @endif
                                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil Saya
                                </a>
                                <hr class="my-1 border-slate-100 dark:border-slate-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-300/30">
                            Masuk
                        </a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-cloak class="lg:hidden border-t border-slate-100 dark:border-slate-800 py-3 pb-4 space-y-1">
                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}" class="block px-4 py-2.5 text-sm font-medium rounded-xl text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 {{ request()->routeIs($item['route']) ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : '' }}">
                    {{ $item['label'] }}
                </a>
                @endforeach
                @auth
                <hr class="border-slate-100 dark:border-slate-700 my-2">
                <a href="{{ route('dashboard.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-xl text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-900/20">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20">Keluar</button>
                </form>
                @else
                <div class="px-4 pt-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-5 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl">Masuk</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-24 right-4 z-50 flex items-center gap-3 bg-green-500 text-white px-5 py-3.5 rounded-2xl shadow-xl animate-slide-down">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
        <button @click="show = false" class="ml-2 text-white/80 hover:text-white">✕</button>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-24 right-4 z-50 flex items-center gap-3 bg-red-500 text-white px-5 py-3.5 rounded-2xl shadow-xl animate-slide-down">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        <span class="text-sm font-medium">{{ session('error') }}</span>
        <button @click="show = false" class="ml-2 text-white/80 hover:text-white">✕</button>
    </div>
    @endif

    {{-- Main Content --}}
    <main>@yield('content')</main>

    {{-- ══ FOOTER ══ --}}
    <footer class="bg-slate-900 dark:bg-slate-950 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Brand dinamis --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        @if($siteSettings->logo)
                            <img src="{{ $siteSettings->logo_url }}"
                                 class="h-10 w-auto object-contain brightness-0 invert"
                                 alt="{{ $siteSettings->hospital_name }}">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-white">{{ $siteSettings->hospital_name ?? 'RS Company' }}</div>
                            @if($siteSettings->hospital_tagline)
                            <div class="text-xs text-primary-400">{{ $siteSettings->hospital_tagline }}</div>
                            @endif
                        </div>
                    </div>

                    <p class="text-slate-400 text-sm leading-relaxed">
                        {{ $siteSettings->footer_description ?? 'Melayani masyarakat dengan penuh dedikasi sejak 1995. Didukung tenaga medis profesional dan fasilitas modern.' }}
                    </p>

                    {{-- Social Media --}}
                    <div class="flex gap-3 mt-5">
                        @if($siteSettings->social_facebook)
                        <a href="{{ $siteSettings->social_facebook }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-blue-600 flex items-center justify-center transition-colors" title="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif

                        @if($siteSettings->social_twitter)
                        <a href="{{ $siteSettings->social_twitter }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-sky-500 flex items-center justify-center transition-colors" title="Twitter / X">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        @endif

                        @if($siteSettings->social_instagram)
                        <a href="{{ $siteSettings->social_instagram }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-pink-600 flex items-center justify-center transition-colors" title="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                            </svg>
                        </a>
                        @endif

                        @if($siteSettings->social_youtube)
                        <a href="{{ $siteSettings->social_youtube }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-red-600 flex items-center justify-center transition-colors" title="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        @endif

                        @if($siteSettings->social_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->social_whatsapp) }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-green-600 flex items-center justify-center transition-colors" title="WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                        @endif

                        {{-- Fallback jika semua sosmed kosong --}}
                        @if(!$siteSettings->social_facebook && !$siteSettings->social_twitter && !$siteSettings->social_instagram && !$siteSettings->social_youtube && !$siteSettings->social_whatsapp)
                        <span class="text-slate-600 text-xs italic">Belum ada media sosial</span>
                        @endif
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="font-semibold text-white mb-5">Navigasi</h4>
                    <ul class="space-y-3">
                        @foreach([
                            ['home',           'Beranda'],
                            ['about',          'Tentang Kami'],
                            ['services.index', 'Layanan'],
                            ['doctors.index',  'Dokter'],
                        ] as $l)
                        <li>
                            <a href="{{ route($l[0]) }}" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">
                                {{ $l[1] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Informasi --}}
                <div>
                    <h4 class="font-semibold text-white mb-5">Informasi</h4>
                    <ul class="space-y-3">
                        @foreach([
                            ['articles.index',   'Berita & Kegiatan'],
                            ['educations.index', 'Edukasi Kesehatan'],
                            ['contact.index',    'Hubungi Kami'],
                        ] as $l)
                        <li>
                            <a href="{{ route($l[0]) }}" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">
                                {{ $l[1] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak dinamis --}}
                <div>
                    <h4 class="font-semibold text-white mb-5">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-slate-400">

                        @if($siteSettings->address)
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-primary-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $siteSettings->address }}
                        </li>
                        @endif

                        @if($siteSettings->phone)
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings->phone) }}" class="hover:text-primary-400 transition-colors">
                                {{ $siteSettings->phone }}
                            </a>
                        </li>
                        @endif

                        @if($siteSettings->email)
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $siteSettings->email }}" class="hover:text-primary-400 transition-colors">
                                {{ $siteSettings->email }}
                            </a>
                        </li>
                        @endif

                        @if($siteSettings->hours)
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $siteSettings->hours }}
                        </li>
                        @endif

                    </ul>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500">
                <p>{{ $siteSettings->copyright }}</p>
                <p>Dibuat dengan ❤️ untuk kesehatan masyarakat</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>