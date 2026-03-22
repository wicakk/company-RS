{{-- resources/views/pages/admin/doctors/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit Dokter')
@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.doctors.update', $doctor->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6 space-y-5">
            <div class="flex items-center gap-4 pb-4 border-b border-gray-100 dark:border-gray-800">
                <img src="{{ $doctor->photo_url }}" class="w-16 h-16 rounded-full object-cover border-4 border-gray-100 dark:border-gray-700" alt="">
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white">dr. {{ $doctor->name }}</h3>
                    <p class="text-brand-600 text-sm">{{ $doctor->specialization }}</p>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $doctor->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Spesialisasi <span class="text-red-500">*</span></label>
                    <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Poli / Layanan</label>
                    <select name="service_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="">Pilih layanan</option>
                        @foreach($services as $s)
                        <option value="{{ $s->id }}" {{ old('service_id', $doctor->service_id) == $s->id ? 'selected':'' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pendidikan</label>
                    <input type="text" name="education" value="{{ old('education', $doctor->education) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">No. STR</label>
                    <input type="text" name="str_number" value="{{ old('str_number', $doctor->str_number) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Foto Profil Baru</label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-brand-50 dark:file:bg-primary-900/30 file:text-brand-600 hover:file:bg-brand-100 cursor-pointer">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Biografi</label>
                    <textarea name="bio" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none resize-none">{{ old('bio', $doctor->bio) }}</textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $doctor->is_active) ? 'checked':'' }} class="rounded border-gray-300 dark:border-gray-600 text-brand-600">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</label>
                </div>
            </div>

            {{-- Schedules Preview --}}
            @if($schedules->isNotEmpty())
            <div class="border-t border-gray-100 dark:border-gray-800 pt-5">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">Jadwal Praktik</h4>
                    <a href="{{ route('admin.schedules.create') }}" class="text-xs text-brand-600 hover:underline">+ Tambah Jadwal</a>
                </div>
                <div class="space-y-2">
                    @foreach($schedules as $sch)
                    <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm">
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $sch->day }}</span>
                        <span class="text-gray-500">{{ $sch->time_range }}</span>
                        <span class="text-gray-400 text-xs">Ruang {{ $sch->room }}</span>
                        <form method="POST" action="{{ route('admin.schedules.destroy', $sch->id) }}" onsubmit="return confirm('Hapus jadwal?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="flex gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Update Dokter
            </button>
            <a href="{{ route('admin.doctors.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
