{{-- resources/views/pages/admin/educations/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit Edukasi')
@section('content')
<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.educations.update', $education->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6 space-y-5">
            <h3 class="font-bold text-gray-900 dark:text-white">Edit: {{ Str::limit($education->title, 60) }}</h3>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Judul</label>
                <input type="text" name="title" value="{{ old('title', $education->title) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
            </div>
            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipe</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="article" {{ old('type', $education->type) === 'article' ? 'selected':'' }}>📄 Artikel</option>
                        <option value="video" {{ old('type', $education->type) === 'video' ? 'selected':'' }}>🎥 Video</option>
                        <option value="infographic" {{ old('type', $education->type) === 'infographic' ? 'selected':'' }}>🖼️ Infografis</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $education->category_id) == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="draft" {{ old('status', $education->status) === 'draft' ? 'selected':'' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $education->status) === 'published' ? 'selected':'' }}>✅ Published</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ringkasan</label>
                <textarea name="excerpt" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none resize-none">{{ old('excerpt', $education->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Konten</label>
                <textarea name="content" rows="8" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none font-mono">{{ old('content', $education->content) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">URL Video</label>
                <input type="url" name="video_url" value="{{ old('video_url', $education->video_url) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Thumbnail Baru</label>
                @if($education->thumbnail)
                <img src="{{ $education->thumbnail_url }}" class="w-24 h-16 object-cover rounded-xl mb-2 border" alt="">
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-brand-50 dark:file:bg-primary-900/30 file:text-brand-600 hover:file:bg-brand-100 cursor-pointer">
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-sm">Update Konten</button>
            <a href="{{ route('admin.educations.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
