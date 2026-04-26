<div
    x-data="{ show: true }"
    x-init="window.onload = () => { setTimeout(() => show = false, 100) }"
    x-show="show"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[999999] flex items-center justify-center bg-white dark:bg-[#0a0a0a]"
>
    <div class="relative flex items-center justify-center">
        <div class="absolute h-12 w-12 rounded-full border-4 border-orange-500/10"></div>
        
        <div class="h-12 w-12 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent shadow-sm"></div>
    </div>
</div>