import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// 1. Store untuk Dark Mode
Alpine.store('theme', {
    theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
    
    init() {
        this.updateTheme();
    },
    toggle() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        localStorage.setItem('theme', this.theme);
        this.updateTheme();
    },
    updateTheme() {
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});

// 2. Store untuk Sidebar
Alpine.store('sidebar', {
    isExpanded: window.innerWidth >= 1280,
    isMobileOpen: false,
    isHovered: false,

    toggleExpanded() {
        this.isExpanded = !this.isExpanded;
        if (this.isExpanded) this.isMobileOpen = false;
    },
    toggleMobileOpen() {
        this.isMobileOpen = !this.isMobileOpen;
    },
    setHovered(val) {
        if (window.innerWidth >= 1280 && !this.isExpanded) {
            this.isHovered = val;
        }
    }
});

// Jalankan Alpine
Alpine.start();

// Handle resize jendela otomatis
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1280) {
        Alpine.store('sidebar').isMobileOpen = false;
    } else {
        Alpine.store('sidebar').isExpanded = false;
    }
});