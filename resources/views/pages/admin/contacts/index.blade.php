@extends('layouts.admin')
@section('title','Pesan Masuk')
@section('breadcrumb','Kontak')

@section('content')
<div class="space-y-5">
    <div class="flex flex-wrap gap-2">
        @foreach(['' => 'Semua', 'unread' => 'Belum Dibaca', 'read' => 'Dibaca', 'replied' => 'Dibalas'] as $val => $label)
        <a href="{{ route('admin.contacts.index', $val ? ['status'=>$val] : []) }}"
           class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == $val ? 'bg-brand-600 text-white' : 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
            {{ $label }}
            @if($val === 'unread')
            @php $uc = \App\Models\Contact::where('status','unread')->count(); @endphp
            @if($uc > 0)
            <span class="ml-1.5 inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold rounded-full {{ request('status') === 'unread' ? 'bg-white text-brand-600' : 'bg-red-500 text-white' }}">{{ $uc }}</span>
            @endif
            @endif
        </a>
        @endforeach
    </div>

    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
        <div class="divide-y divide-gray-50 dark:divide-gray-800">
            @forelse($contacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact->id) }}"
               class="flex items-start gap-4 px-6 py-4 transition-colors {{ $contact->status === 'unread' ? 'bg-brand-50/30 dark:bg-brand-500/5 hover:bg-brand-50/50' : 'hover:bg-gray-50 dark:hover:bg-gray-800/30' }}">
                <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center flex-shrink-0">
                    <span class="text-brand-600 dark:text-brand-400 font-bold text-sm">{{ strtoupper(substr($contact->name,0,1)) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-3 mb-1">
                        <span class="font-{{ $contact->status === 'unread' ? 'semibold' : 'medium' }} text-gray-900 dark:text-white text-sm">{{ $contact->name }}</span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($contact->status === 'unread')
                            <span class="w-2 h-2 bg-brand-500 rounded-full"></span>
                            @endif
                            @php $bc = match($contact->status) { 'unread'=>'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400','read'=>'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400',default=>'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400' }; @endphp
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $bc }} font-medium">{{ ucfirst($contact->status) }}</span>
                            <span class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $contact->subject }}</p>
                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ $contact->message }}</p>
                </div>
                <svg class="w-4 h-4 text-gray-300 flex-shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
            @empty
            <div class="px-6 py-20 text-center">
                <svg class="w-14 h-14 mx-auto text-gray-200 dark:text-gray-700 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                <p class="text-sm text-gray-400">Tidak ada pesan.</p>
            </div>
            @endforelse
        </div>
        @if($contacts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $contacts->links() }}</div>
        @endif
    </div>
</div>
@endsection
