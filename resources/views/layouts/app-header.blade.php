<header 
    class="sticky top-0 z-[997] w-full border-b border-gray-100 bg-white/80 backdrop-blur-md dark:border-white/5 dark:bg-[#0d0d0d]/80 font-poppins transition-all duration-300"
    x-data="{ isUserMenuOpen: false }">
    
    <div class="relative flex h-20 items-center justify-end px-6 sm:px-8 lg:px-10">
        
        {{-- Spacer Mobile --}}
        <div class="flex-grow lg:hidden">
            <div class="w-[60px]"></div>
        </div>

        {{-- Actions & Profile --}}
        <div class="flex items-center gap-4 sm:gap-6">
            
            {{-- Theme & Notif --}}
            {{-- Theme & Notif --}}
<div class="flex items-center gap-2 border-r border-gray-100 dark:border-white/5 pr-4 sm:pr-6">
    {{-- Button Theme dengan perbaikan padding/size agar ikon tidak terpotong --}}
    <button class="flex h-10 w-10 items-center justify-center rounded-xl text-gray-500 transition-all hover:bg-orange-500/10 hover:text-orange-500 dark:text-gray-400 dark:hover:bg-orange-500/10 dark:hover:text-orange-500" @click="$store.theme.toggle()">
        {{-- Ikon Matahari (Mode Gelap) --}}
        <svg class="hidden dark:block" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
        {{-- Ikon Bulan (Mode Terang) - Viewbox diperbaiki agar tidak terpotong --}}
        <svg class="block dark:hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </button>

    {{-- Notification Dropdown - Pastikan di dalam komponen ini tidak ada class 'bg-blue' atau 'ring-blue' --}}
    <div class="relative">
        <x-header.notification-dropdown />
    </div>
</div>

            {{-- User Menu --}}
            <div class="relative">
                <button @click="isUserMenuOpen = !isUserMenuOpen" @click.away="isUserMenuOpen = false" 
                    class="group flex items-center gap-4 rounded-2xl p-1.5 transition-all hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none">
                    
                    <div class="hidden text-right sm:block">
                        <span class="block text-xs font-black uppercase tracking-widest text-gray-900 dark:text-white group-hover:text-orange-500 transition-colors">
                            {{ Auth::user()->nama }}
                        </span>
                        <span class="mt-1 inline-block rounded-md bg-orange-500/10 px-2 py-0.5 text-[8px] font-black uppercase tracking-[0.2em] text-orange-500 border border-orange-500/10">
                            {{ Auth::user()->level }}
                        </span>
                    </div>

                    <div class="relative">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                                 class="h-10 w-10 rounded-xl object-cover ring-2 ring-white shadow-xl dark:ring-[#0d0d0d] group-hover:scale-105 transition-transform" alt="Avatar">
                        @else
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-[10px] font-black text-white shadow-lg shadow-orange-500/20 group-hover:scale-105 transition-transform">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                        @endif
                        <span class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500 dark:border-[#0d0d0d]"></span>
                    </div>

                    <svg :class="isUserMenuOpen ? 'rotate-180 text-orange-500' : ''" class="hidden text-gray-300 transition-all duration-300 sm:block" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div x-show="isUserMenuOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     style="display: none;"
                     class="absolute right-0 z-50 mt-4 w-56 rounded-[1.5rem] border border-gray-100 bg-white/95 p-2 shadow-2xl backdrop-blur-xl dark:border-white/5 dark:bg-[#111111]/95">
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest text-gray-600 dark:text-gray-400 hover:bg-orange-500 hover:text-white transition-all">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="3">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Edit Profil
                    </a>
                    
                    <div class="my-2 border-t border-gray-50 dark:border-white/5"></div>
                    
                    <button type="button" 
                            onclick="window.confirmLogout()" 
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-[10px] font-black text-red-500 uppercase tracking-widest hover:bg-red-50 dark:hover:bg-red-500/10 transition-all">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="3">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Keluar Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>