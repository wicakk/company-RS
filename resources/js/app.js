/**
 * RS Medika Nusantara - Main JavaScript
 * Dark Mode is handled by Alpine.js in the layout (localStorage-based)
 */

import './bootstrap';

// ============================================================
// Dark Mode Initialization
// Applied before page paint to prevent flash
// ============================================================
(function () {
    const savedMode = localStorage.getItem('darkMode');
    if (savedMode === 'true') {
        document.documentElement.classList.add('dark');
    } else if (savedMode === 'false') {
        document.documentElement.classList.remove('dark');
    } else {
        // Default: respect OS preference
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'true');
        }
    }
})();

// ============================================================
// Smooth anchor scroll
// ============================================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ============================================================
// Auto-dismiss flash messages
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const flashes = document.querySelectorAll('[data-flash]');
    flashes.forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }, 4000);
    });
});
