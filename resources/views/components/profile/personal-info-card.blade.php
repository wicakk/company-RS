{{-- resources/views/components/profile/personal-info-card.blade.php --}}
@props(['user' => null])
@php $user = $user ?? auth()->user(); @endphp
<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Pribadi</h3>
        <a href="{{ route('dashboard.profile') }}" class="text-xs text-brand-500 hover:text-brand-600 font-medium transition-colors">Edit</a>
    </div>
    <div class="space-y-4">
        @foreach([
            ['label'=>'Nama Lengkap','value'=>$user->name,'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
            ['label'=>'Email','value'=>$user->email,'icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['label'=>'Telepon','value'=>$user->phone ?? '-','icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
            ['label'=>'Tanggal Lahir','value'=>$user->date_of_birth ? $user->date_of_birth->format('d M Y') : '-','icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ] as $info)
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-gray-800 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $info['label'] }}</p>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-0.5">{{ $info['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
