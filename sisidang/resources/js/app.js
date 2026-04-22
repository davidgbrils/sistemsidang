import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.dark = localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

window.toggleTheme = function() {
    window.dark = !window.dark;
    if (window.dark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
};

Alpine.start();