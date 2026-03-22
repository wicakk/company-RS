@extends('layouts.admin')
@section('title','Detail Pesan')
@section('breadcrumb','Kontak / Detail')

@section('content')
<div class="max-w-3xl space-y-6">
    <a href="{{ route('admin.contacts.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-brand-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Kembali ke Pesan
    </a>

    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center flex-shrink-0">
                    <span class="text-brand-600 dark:text-brand-400 font-bold text-lg">{{ strtoupper(substr($contact->name,0,1)) }}</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $contact->name }}</h3>
                    <a href="mailto:{{ $contact->email }}" class="text-brand-500 text-sm hover:underline">{{ $contact->email }}</a>
                    @if($contact->phone)<div class="text-gray-400 text-sm mt-0.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        {{ $contact->phone }}
                    </div>@endif
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-400 flex items-center gap-1 justify-end">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $contact->created_at->format('d F Y, H:i') }}
                </div>
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" onsubmit="return confirm('Hapus pesan?')" class="mt-2">
                    @csrf @method('DELETE')
                    <button class="inline-flex items-center gap-1 text-xs text-red-500 hover:text-red-700 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">
            <div class="font-semibold text-gray-800 dark:text-white mb-2">{{ $contact->subject }}</div>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">{{ $contact->message }}</p>
        </div>
    </div>

    @if($contact->reply_message)
    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-6">
        <div class="font-semibold text-green-800 dark:text-green-300 mb-2 flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Balasan terkirim — {{ $contact->replied_at?->format('d F Y, H:i') }}
        </div>
        <p class="text-green-700 dark:text-green-400 text-sm">{{ $contact->reply_message }}</p>
    </div>
    @else
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
        <h3 class="font-semibold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
            Tulis Balasan
        </h3>
        <form method="POST" action="{{ route('admin.contacts.reply', $contact->id) }}" class="space-y-4">
            @csrf
            <textarea name="reply_message" rows="5" required
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none resize-none"
                      placeholder="Tulis balasan Anda..."></textarea>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                Kirim Balasan
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
