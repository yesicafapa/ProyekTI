@php
    use App\Helpers\MenuHelper;
    $menuGroups = MenuHelper::getMainNavItems(); 
@endphp

{{-- 1. OVERLAY --}}
<div 
    x-show="$store.sidebar.isMobileOpen" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    @click="$store.sidebar.toggleMobileOpen()"
    class="fixed inset-0 z-[9998] bg-black/40 backdrop-blur-sm lg:hidden"
    style="display: none;">
</div>

{{-- 2. TOMBOL HAMBURGER --}}
<button 
    x-show="!$store.sidebar.isMobileOpen"
    @click="$store.sidebar.toggleMobileOpen()"
    class="fixed top-5 left-4 z-[9997] flex h-10 w-10 items-center justify-center rounded-xl bg-white/90 border border-gray-100 shadow-sm backdrop-blur-md dark:bg-[#1a1a1a]/90 dark:border-white/5 lg:hidden">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
</button>

{{-- 3. SIDEBAR ASIDE --}}
<aside id="sidebar"
    class="fixed flex flex-col top-0 left-0 z-[9999] h-screen transition-all duration-300 ease-in-out bg-white border-r border-gray-100 dark:bg-[#0d0d0d] dark:border-white/5 shadow-2xl font-poppins w-72"
    :class="$store.sidebar.isMobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

    {{-- Logo Section --}}
    {{-- Logo Section --}}
    <div class="flex items-center justify-between h-24 px-8 shrink-0">
        <div class="flex items-center gap-3">
            {{-- Ikon Logo --}}
            <img src="{{ asset('favicon.png') }}" alt="Logo SEOV DETECH" class="w-10 h-10 object-contain">
            
            <div class="flex flex-col leading-none">
                <span class="text-2xl font-black tracking-tighter uppercase">
                    <span class="text-slate-800 dark:text-white">SEOV</span>
                    <span class="text-orange-500">DETECH</span>
                </span>
            </div>
        </div>

        {{-- TOMBOL SILANG (Hanya muncul di Mobile) --}}
        <button 
            @click="$store.sidebar.toggleMobileOpen()" 
            class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-gray-500 hover:bg-orange-50 hover:text-orange-500 dark:bg-white/5 dark:text-gray-400 lg:hidden transition-colors">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    {{-- Area Menu --}}
    <div class="no-scrollbar flex-grow overflow-y-auto px-4 py-4">
        <nav class="flex flex-col gap-8">
            @foreach ($menuGroups as $group)
                @php 
                    // Kamus Terjemahan Nama Grup
                    $groupNames = [
                        'ADMINISTRATOR'   => 'ADMINISTRATOR',
                        'DASHBOARD'       => 'PANEL UTAMA',
                        'USER MANAGEMENT' => 'MANAJEMEN PENGGUNA',
                        'MASTER DATA'     => 'DATA MASTER',
                        'CONTENT'         => 'KONTEN',
                        'MANAGEMENT'      => 'MANAJEMEN'
                    ];

                    $groupRaw = strtoupper($group['group']);
                    $groupDisplay = $groupNames[$groupRaw] ?? $groupRaw;
                    $userLevel = strtolower(auth()->user()->level);
                @endphp

                @if (($groupRaw !== 'ADMINISTRATOR' || $userLevel === 'super admin') && 
                     !in_array($groupRaw, ['SYSTEM SETTINGS', 'SETTING SYSTEM', 'SETTINGS']))
                
                <div class="flex flex-col gap-2">
                    <h3 class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $groupDisplay }}</h3>
                    <ul class="flex flex-col gap-1">
                        @foreach ($group['items'] as $item)
                            @php 
                                // Kamus Terjemahan Nama Item
                                $itemNames = [
                                    'DASHBOARD'       => 'Dashboard',
                                    'USER MANAGEMENT' => 'Kelola Pengguna',
                                    'USERS'           => 'Pengguna',
                                    'ROLES'           => 'Hak Akses',
                                    'TESTIMONI'       => 'Testimoni',
                                    'ARTICLE'         => 'Artikel',
                                    'PORTFOLIO'       => 'Portofolio',
                                    'MESSAGES'        => 'Pesan Masuk'
                                ];

                                $isActive = request()->url() == $item['path'];
                                $itemRaw = strtoupper($item['name']);
                                $itemDisplay = $itemNames[$itemRaw] ?? $item['name'];
                            @endphp

                            @if (!in_array($itemRaw, ['SYSTEM SETTINGS', 'SETTING SYSTEM', 'SETTINGS']))
                            <li>
                                <a href="{{ $item['path'] }}"
                                    class="flex items-center rounded-2xl px-4 py-3.5 transition-all duration-200 {{ $isActive ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/20 font-bold' : 'text-gray-500 hover:bg-orange-500/10 hover:text-orange-500 font-medium' }}">
                                    <span class="shrink-0 scale-110">
                                        {!! MenuHelper::getIconSvg($item['icon'] ?? 'dashboard') !!}
                                    </span>
                                    <span class="ml-4 text-sm whitespace-nowrap">{{ $itemDisplay }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif
            @endforeach
        </nav>
    </div>

    {{-- Tombol Keluar --}}
    <div class="p-4 mt-auto border-t border-gray-50 dark:border-white/5">
        <button type="button" 
                onclick="window.confirmLogout()"
                class="flex w-full items-center gap-4 px-4 py-4 rounded-2xl text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all duration-200 group">
            <span class="shrink-0 transition-transform group-hover:-translate-x-1">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </span>
            <span class="text-sm font-bold uppercase tracking-widest">Keluar Akun</span>
        </button>
    </div>
</aside>