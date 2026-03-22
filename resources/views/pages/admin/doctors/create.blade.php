{{-- resources/views/pages/admin/doctors/create.blade.php --}}
@extends('layouts.admin')
@section('title','Tambah Dokter')
@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6 space-y-5">
            <h3 class="font-bold text-gray-900 dark:text-white">Data Dokter</h3>
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="Nama dokter (tanpa gelar)">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Spesialisasi <span class="text-red-500">*</span></label>
                    <input type="text" name="specialization" value="{{ old('specialization') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="Contoh: Dokter Spesialis Anak">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Poli / Layanan</label>
                    <select name="service_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="">Pilih layanan</option>
                        @foreach($services as $s)
                        <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected':'' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pendidikan</label>
                    <input type="text" name="education" value="{{ old('education') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="Contoh: FK UI, Sp.A">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">No. STR</label>
                    <input type="text" name="str_number" value="{{ old('str_number') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="Nomor STR dokter">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Foto Profil</label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-brand-50 dark:file:bg-primary-900/30 file:text-brand-600 hover:file:bg-brand-100 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1">Max 2MB</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Biografi Singkat</label>
                    <textarea name="bio" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none resize-none" placeholder="Deskripsi singkat pengalaman dokter">{{ old('bio') }}</textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') ? 'checked':'' }} class="rounded border-gray-300 dark:border-gray-600 text-brand-600">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif / Tampilkan di website</label>
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Dokter
            </button>
            <a href="{{ route('admin.doctors.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
