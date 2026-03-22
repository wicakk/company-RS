{{-- resources/views/pages/admin/users/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit User')
@section('content')
<div class="max-w-lg">
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-6 space-y-5">
            <div class="flex items-center gap-4 pb-4 border-b border-gray-100 dark:border-gray-800">
                <img src="{{ $user->avatar_url }}" class="w-14 h-14 rounded-full object-cover" alt="">
                <div>
                    <div class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Role</label>
                    <select name="role" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected':'' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected':'' }}>Admin</option>
                    </select>
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked':'' }} class="rounded border-gray-300 text-brand-600">
                        <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Akun Aktif</label>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-800 pt-5">
                <p class="text-xs text-gray-400 mb-4">Kosongkan kolom password jika tidak ingin mengubah password.</p>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none" placeholder="••••••••">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-sm">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="px-7 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
