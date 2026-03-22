{{-- resources/views/components/admin/table.blade.php --}}
@props(['headers' => []])

<div class="overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
            <tr>
                @foreach($headers as $i => $header)
                <th class="text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider px-6 py-3.5 {{ $loop->last ? 'text-right' : '' }}">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
            {{ $slot }}
        </tbody>
    </table>
</div>
