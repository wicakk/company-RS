{{-- resources/views/pages/admin/educations/index.blade.php --}}
@extends('layouts.admin')
@section('title','Konten Edukasi')
@section('content')
<div class="space-y-5">
    <div class="flex flex-col sm:flex-row gap-3 justify-between">
        <form method="GET" class="flex gap-3 flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari edukasi..." class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
            <select name="status" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected':'' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected':'' }}>Draft</option>
            </select>
            <button type="submit" class="px-4 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-xl text-sm font-medium">Cari</button>
        </form>
        <a href="{{ route('admin.educations.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Konten Baru
        </a>
    </div>
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                <tr>
                    @foreach(['Konten','Tipe','Status','Views','Tanggal','Aksi'] as $h)
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-4 {{ $loop->last ? 'text-right':'' }}">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                @forelse($educations as $edu)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white text-sm line-clamp-1 max-w-xs">{{ $edu->title }}</div>
                        @if($edu->excerpt)<div class="text-xs text-gray-400 line-clamp-1">{{ $edu->excerpt }}</div>@endif
                    </td>
                    <td class="px-6 py-4">
                        @php $typeMap = ['article'=>['📄','bg-blue-50 dark:bg-blue-900/20 text-blue-600'],'video'=>['🎥','bg-purple-50 dark:bg-purple-900/20 text-purple-600'],'infographic'=>['🖼️','bg-amber-50 dark:bg-amber-900/20 text-amber-600']]; @endphp
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $typeMap[$edu->type][1] }}">
                            {{ $typeMap[$edu->type][0] }} {{ ucfirst($edu->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $edu->status === 'published' ? 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400':'bg-gray-100 dark:bg-gray-800 text-gray-500' }}">
                            {{ $edu->status === 'published' ? '✓ Published':'○ Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ number_format($edu->views) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $edu->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.educations.edit', $edu->id) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.educations.destroy', $edu->id) }}" onsubmit="return confirm('Hapus konten?')">
                                @csrf @method('DELETE')
                                <button class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-16 text-center text-gray-400">Belum ada konten edukasi.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($educations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $educations->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
