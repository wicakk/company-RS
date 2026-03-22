{{-- resources/views/pages/admin/schedules/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit Jadwal')
@section('content')
<div class="max-w-lg">
    <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6 space-y-5">
            <h3 class="font-bold text-gray-900 dark:text-white">Edit Jadwal Praktik</h3>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Dokter</label>
                <select name="doctor_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                    @foreach($doctors as $doc)
                    <option value="{{ $doc->id }}" {{ old('doctor_id', $schedule->doctor_id) == $doc->id ? 'selected':'' }}>dr. {{ $doc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Layanan</label>
                <select name="service_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                    <option value="">Pilih Layanan</option>
                    @foreach($services as $svc)
                    <option value="{{ $svc->id }}" {{ old('service_id', $schedule->service_id) == $svc->id ? 'selected':'' }}>{{ $svc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Hari</label>
                <select name="day" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                    <option value="{{ $day }}" {{ old('day', $schedule->day) === $day ? 'selected':'' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jam Mulai</label>
                    <input type="time" name="time_start" value="{{ old('time_start', substr($schedule->time_start,0,5)) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jam Selesai</label>
                    <input type="time" name="time_end" value="{{ old('time_end', substr($schedule->time_end,0,5)) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ruangan</label>
                    <input type="text" name="room" value="{{ old('room', $schedule->room) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Kuota</label>
                    <input type="number" name="quota" value="{{ old('quota', $schedule->quota) }}" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $schedule->is_active) ? 'checked':'' }} class="rounded border-gray-300 text-brand-600">
                <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</label>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-sm">Update Jadwal</button>
            <a href="{{ route('admin.schedules.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
