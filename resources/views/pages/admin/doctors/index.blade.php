{{-- resources/views/pages/admin/doctors/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manajemen Dokter')
@section('breadcrumb', 'Dokter')

@section('page-actions')
    <a href="{{ route('admin.doctors.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Dokter
    </a>
@endsection

@section('content')
<div class="space-y-5">
    {{-- Search --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-4">
        <form method="GET" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau spesialisasi..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none transition-all">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl text-sm font-medium transition-colors">Cari</button>
        </form>
    </div>

    {{-- Doctor Cards --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($doctors as $doctor)
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden hover:shadow-theme-md transition-shadow">
            <div class="bg-gradient-to-br from-brand-50 to-blue-50 dark:from-brand-500/5 dark:to-blue-500/5 pt-6 pb-4 px-4 text-center">
                <img src="{{ $doctor->photo_url }}"
                     class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-white dark:border-gray-800 shadow-md"
                     alt="dr. {{ $doctor->name }}">
            </div>
            <div class="p-5">
                <h3 class="font-semibold text-gray-900 dark:text-white text-sm text-center mb-1">dr. {{ $doctor->name }}</h3>
                <p class="text-brand-500 dark:text-brand-400 text-xs text-center mb-4">{{ $doctor->specialization }}</p>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                                 {{ $doctor->is_active ? 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400' : 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $doctor->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                           class="p-1.5 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}" onsubmit="return confirm('Hapus dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 py-20 text-center text-gray-400 dark:text-gray-500 text-sm">
            <svg class="w-14 h-14 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Belum ada dokter. <a href="{{ route('admin.doctors.create') }}" class="text-brand-500 hover:underline">Tambah sekarang</a>
        </div>
        @endforelse
    </div>
    @if($doctors->hasPages())
    <div class="flex justify-center">{{ $doctors->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
