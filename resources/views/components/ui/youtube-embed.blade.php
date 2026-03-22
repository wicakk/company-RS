{{-- resources/views/components/ui/youtube-embed.blade.php --}}
@props(['url' => '', 'title' => 'Video Edukasi'])
@php
// Convert YouTube URL to embed URL
$embedUrl = $url;
if (str_contains($url, 'youtube.com/watch?v=')) {
    $videoId = explode('v=', $url)[1];
    $videoId = explode('&', $videoId)[0];
    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
} elseif (str_contains($url, 'youtu.be/')) {
    $videoId = explode('youtu.be/', $url)[1];
    $videoId = explode('?', $videoId)[0];
    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
}
@endphp
@if($embedUrl)
<div class="relative w-full rounded-2xl overflow-hidden" style="padding-bottom: 56.25%;">
    <iframe src="{{ $embedUrl }}"
            title="{{ $title }}"
            class="absolute inset-0 w-full h-full"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
    </iframe>
</div>
@else
<div class="w-full rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center p-8 text-gray-400">
    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
</div>
@endif
