{{-- resources/views/components/common/preloader.blade.php --}}
<div id="rs-preloader"
     style="position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;background:white;flex-direction:column;gap:1rem;"
     class="dark:!bg-gray-900">
    <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#3b97f3,#1560d5);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(29,119,232,0.3);">
        <svg width="32" height="32" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
    </div>
    <div style="display:flex;gap:6px;">
        <div style="width:8px;height:8px;background:#3b97f3;border-radius:50%;animation:rs-bounce 1s infinite 0ms;"></div>
        <div style="width:8px;height:8px;background:#3b97f3;border-radius:50%;animation:rs-bounce 1s infinite 150ms;"></div>
        <div style="width:8px;height:8px;background:#3b97f3;border-radius:50%;animation:rs-bounce 1s infinite 300ms;"></div>
    </div>
    <p style="font-size:12px;color:#9ca3af;font-family:'Plus Jakarta Sans',sans-serif;font-weight:500;">RS Medika Nusantara</p>
</div>
<style>
    @keyframes rs-bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
</style>
<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            var el = document.getElementById('rs-preloader');
            if (el) { el.style.transition='opacity 0.4s ease'; el.style.opacity='0'; setTimeout(function(){ if(el) el.remove(); }, 400); }
        }, 600);
    });
</script>
