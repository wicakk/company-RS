{{-- resources/views/pages/admin/articles/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit Artikel')
@section('breadcrumb','Admin / Artikel / Edit')

@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6">
            <h3 class="font-bold text-gray-900 dark:text-white mb-5">Edit Artikel</h3>
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipe</label>
                        <select name="type" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                            <option value="news" {{ old('type', $article->type) === 'news' ? 'selected' : '' }}>Berita</option>
                            <option value="announcement" {{ old('type', $article->type) === 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                        <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ringkasan</label>
                    <textarea name="excerpt" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none resize-none">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Konten <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="12" required
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none font-mono">{{ old('content', $article->content) }}</textarea>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6">
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Thumbnail Baru</label>
                    @if($article->thumbnail)
                    <div class="mb-3">
                        <img src="{{ $article->thumbnail_url }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200 dark:border-gray-700" alt="">
                        <p class="text-xs text-gray-400 mt-1">Thumbnail saat ini</p>
                    </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-brand-50 dark:file:bg-primary-900/30 file:text-brand-600 hover:file:bg-brand-100 cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>✅ Published</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Update Artikel
            </button>
            <a href="{{ route('admin.articles.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
