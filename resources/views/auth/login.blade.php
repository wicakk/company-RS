{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - RS Company</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }, colors: { primary: { 50:'#eff8ff',500:'#3b97f3',600:'#1d77e8',700:'#1560d5' } } } } }</script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white transition-colors min-h-screen flex items-center justify-center p-4">

    <div class="absolute top-4 right-4">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-2.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </button>
    </div>

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-300/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <div class="text-left">
                    <div class="font-bold text-slate-900 dark:text-white text-lg leading-tight">RS Medika</div>
                    <div class="text-xs text-primary-600 font-medium">Nusantara</div>
                </div>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-8 shadow-xl shadow-slate-200/50 dark:shadow-slate-900/50">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Selamat Datang</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Masuk ke akun Anda untuk melanjutkan</p>

            @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 mb-6">
                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            @if(session('status'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 rounded-xl p-4 mb-6 text-sm text-green-600">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all text-sm"
                           placeholder="email@example.com">
                </div>
                <div x-data="{ show: false }">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        
                        <input :type="show ? 'text' : 'password'" name="password" required
                               class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all text-sm pr-12"
                               placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 dark:border-slate-600 text-primary-600 focus:ring-primary-500">
                    <label for="remember" class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</label>
                </div>
                <button type="submit" class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-300/30 text-sm">
                    Masuk ke Akun
                </button>
            </form>

            <div class="text-center mt-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary-600 dark:text-primary-400 font-semibold hover:underline ml-1">Daftar sekarang</a>
                </p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                ← Kembali ke website
            </a>
        </div>
    </div>
</body>
</html>
