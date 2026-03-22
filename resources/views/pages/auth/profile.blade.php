{{-- resources/views/pages/auth/profile.blade.php --}}
@extends('layouts.app')
@section('title','Profil Saya')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-4 gap-6">
        {{-- Sidebar --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-4 h-fit">
            <div class="text-center pb-4 mb-4 border-b border-slate-100 dark:border-slate-800">
                <img src="{{ $user->avatar_url }}" class="w-16 h-16 rounded-full mx-auto mb-2 object-cover" alt="">
                <div class="font-semibold text-sm text-slate-900 dark:text-white">{{ $user->name }}</div>
                <div class="text-xs text-slate-400">{{ $user->email }}</div>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Kembali
                </a>
            </nav>
        </div>

        <div class="lg:col-span-3 space-y-6">
            {{-- Update Profile --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Informasi Pribadi</h2>
                <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf @method('PUT')
                    <div class="flex items-center gap-6 mb-6">
                        <img src="{{ $user->avatar_url }}" id="avatar-preview" class="w-20 h-20 rounded-full object-cover border-4 border-slate-100 dark:border-slate-700" alt="">
                        <div>
                            <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-brand-50 dark:bg-primary-900/30 text-brand-600 dark:text-brand-400 text-sm font-medium rounded-xl hover:bg-primary-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Ganti Foto
                                <input type="file" name="avatar" accept="image/*" class="hidden" onchange="document.getElementById('avatar-preview').src = URL.createObjectURL(this.files[0])">
                            </label>
                            <p class="text-xs text-slate-400 mt-1">JPG, PNG max 2MB</p>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">No. Telepon</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tanggal Lahir</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jenis Kelamin</label>
                            <select name="gender" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                                <option value="">Pilih...</option>
                                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Alamat</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none resize-none">{{ old('address', $user->address) }}</textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Update Password --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Ubah Password</h2>
                <form method="POST" action="{{ route('dashboard.password.update') }}" class="space-y-5">
                    @csrf @method('PUT')
                    @foreach([['current_password','Password Lama'],['password','Password Baru'],['password_confirmation','Konfirmasi Password Baru']] as $f)
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ $f[1] }}</label>
                        <input type="password" name="{{ $f[0] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="••••••••">
                        @error($f[0])<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    @endforeach
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 dark:hover:bg-slate-600 text-white font-semibold rounded-xl transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Perbarui Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
