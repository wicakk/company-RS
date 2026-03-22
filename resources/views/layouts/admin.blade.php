<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | RS Company</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: {
                            50:'#eff8ff',100:'#dbeffe',200:'#bfe3fd',300:'#93d1fb',
                            400:'#60b5f7',500:'#3b97f3',600:'#1d77e8',700:'#1560d5',
                            800:'#174dac',900:'#184488',950:'#142b54',
                        },
                        primary: {
                            50:'#eff8ff',100:'#dbeffe',200:'#bfe3fd',300:'#93d1fb',
                            400:'#60b5f7',500:'#3b97f3',600:'#1d77e8',700:'#1560d5',
                            800:'#174dac',900:'#184488',950:'#142b54',
                        },
                    },
                    zIndex: { '99999': '99999', '9999': '9999' },
                    boxShadow: {
                        'theme-xs': '0 1px 2px 0 rgba(0,0,0,0.05)',
                        'theme-sm': '0 1px 3px 0 rgba(0,0,0,0.1)',
                        'theme-md': '0 4px 6px -1px rgba(0,0,0,0.1)',
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Theme & Sidebar Alpine Stores -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const saved = localStorage.getItem('theme');
                    const sys = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    this.theme = saved || sys;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    if (this.theme === 'dark') {
                        document.documentElement.classList.add('dark');
                        document.body.classList.add('dark', 'bg-gray-900');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,
                toggleExpanded()   { this.isExpanded = !this.isExpanded; this.isMobileOpen = false; },
                toggleMobileOpen() { this.isMobileOpen = !this.isMobileOpen; },
                setMobileOpen(val) { this.isMobileOpen = val; },
                setHovered(val)    { if (window.innerWidth >= 1280 && !this.isExpanded) this.isHovered = val; }
            });
        });
    </script>

    <!-- Prevent flash on dark mode -->
    <script>
        (function(){
            const t = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (t === 'dark') {
                document.documentElement.classList.add('dark');
                document.body && document.body.classList.add('dark','bg-gray-900');
            }
        })();
    </script>

    <style>
        [x-cloak]  { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── Admin Sidebar Menu Styles ───────────────── */
        .menu-item {
            display:flex; align-items:center; gap:0.75rem;
            padding:0.625rem 0.75rem; border-radius:0.75rem;
            font-size:0.875rem; font-weight:500;
            transition:all 0.2s; cursor:pointer; width:100%;
            text-decoration:none;
        }
        .menu-item-active   { background:#eff8ff; color:#1d77e8; }
        .menu-item-inactive { color:#4b5563; }
        .menu-item-inactive:hover { background:#f9fafb; color:#111827; }

        .dark .menu-item-active   { background:rgba(59,151,243,0.1); color:#60b5f7; }
        .dark .menu-item-inactive { color:#9ca3af; }
        .dark .menu-item-inactive:hover { background:rgba(255,255,255,0.05); color:#f9fafb; }

        .menu-item-icon-active   { color:#1d77e8; }
        .menu-item-icon-inactive { color:#9ca3af; }
        .dark .menu-item-icon-active  { color:#60b5f7; }

        .menu-dropdown-item { display:flex; align-items:center; gap:0.5rem; padding:0.5rem 0.75rem; border-radius:0.5rem; font-size:0.875rem; transition:all 0.15s; text-decoration:none; }
        .menu-dropdown-item-active   { color:#1d77e8; font-weight:600; }
        .menu-dropdown-item-inactive { color:#6b7280; }
        .menu-dropdown-item-inactive:hover { color:#111827; }
        .dark .menu-dropdown-item-inactive { color:#9ca3af; }
        .dark .menu-dropdown-item-inactive:hover { color:#f9fafb; }

        /* ── Public site ──────────────────────────────── */
        .gradient-text {
            background:linear-gradient(135deg,#1d77e8 0%,#60b5f7 100%);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .hero-gradient { background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 40%,#1d77e8 100%); }
        .card-hover { transition:all 0.3s; }
        .card-hover:hover { transform:translateY(-4px); box-shadow:0 20px 40px rgba(0,0,0,0.12); }
        .nav-link { position:relative; }
        .nav-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:#3b97f3; transition:width 0.3s; }
        .nav-link:hover::after,.nav-link.active::after { width:100%; }
    </style>

    @stack('styles')
</head>

<body class="font-sans bg-gray-50 dark:bg-gray-950"
      style="font-family:'Plus Jakarta Sans',sans-serif;"
      x-data="{ loaded: true }"
      x-init="
          $store.sidebar.isExpanded = window.innerWidth >= 1280;
          window.addEventListener('resize', () => {
              if (window.innerWidth < 1280) {
                  $store.sidebar.setMobileOpen(false);
                  $store.sidebar.isExpanded = false;
              } else {
                  $store.sidebar.isMobileOpen = false;
                  $store.sidebar.isExpanded = true;
              }
          });
      ">

    {{-- Preloader --}}
    <x-common.preloader />

    <div class="min-h-screen xl:flex">

        {{-- Mobile backdrop --}}
        <div x-cloak
             :class="$store.sidebar.isMobileOpen ? 'block xl:hidden' : 'hidden'"
             @click="$store.sidebar.setMobileOpen(false)"
             class="fixed inset-0 z-[9999] bg-gray-900/50">
        </div>

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 transition-all duration-300 ease-in-out"
             :class="{
                 'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                 'xl:ml-[90px]' : !$store.sidebar.isExpanded && !$store.sidebar.isHovered
             }">

            {{-- Header --}}
            @include('layouts.app-header')

            {{-- Flash Messages --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mx-4 md:mx-6 mt-4 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mx-4 md:mx-6 mt-4 flex items-center gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                {{ session('error') }}
            </div>
            @endif

            {{-- Page Content --}}
            <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
                @hasSection('title')
                <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">@yield('title')</h1>
                        @hasSection('breadcrumb')
                        <nav class="flex items-center gap-1.5 text-xs text-gray-400 mt-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-500 transition-colors">Dashboard</a>
                            <span>/</span>
                            <span>@yield('breadcrumb')</span>
                        </nav>
                        @endif
                    </div>
                    @hasSection('page-actions')
                    <div class="flex items-center gap-3">@yield('page-actions')</div>
                    @endif
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
