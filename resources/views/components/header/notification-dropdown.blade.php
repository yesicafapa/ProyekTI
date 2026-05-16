<div class="relative" x-data="{
    dropdownOpen: false,
    notifying: {{ ($unreadCount ?? 0) > 0 ? 'true' : 'false' }},
    toggleDropdown() {
        this.dropdownOpen = !this.dropdownOpen;
        this.notifying = false;
    },
    closeDropdown() {
        this.dropdownOpen = false;
    }
}" @click.away="closeDropdown()">
    
    {{-- Trigger Button --}}
    <button
        class="relative flex h-11 w-11 items-center justify-center rounded-2xl border border-gray-100 bg-white text-gray-500 transition-all hover:bg-orange-500/10 hover:text-orange-500 dark:border-white/5 dark:bg-[#1a1c21] dark:text-gray-400 dark:hover:bg-orange-500/10 dark:hover:text-orange-500"
        @click="toggleDropdown()"
        type="button"
    >
        <template x-if="notifying">
            <span class="absolute right-2.5 top-2.5 flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange-500 opacity-75"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-orange-600"></span>
            </span>
        </template>

        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.75 2.29248C10.75 1.87827 10.4143 1.54248 10 1.54248C9.58583 1.54248 9.25004 1.87827 9.25004 2.29248V2.83613C6.08266 3.20733 3.62504 5.9004 3.62504 9.16748V14.4591H3.33337C2.91916 14.4591 2.58337 14.7949 2.58337 15.2091C2.58337 15.6234 2.91916 15.9591 3.33337 15.9591H4.37504H15.625H16.6667C17.0809 15.9591 17.4167 15.6234 17.4167 15.2091C17.4167 14.7949 17.0809 14.4591 16.6667 14.4591H16.375V9.16748C16.375 5.9004 13.9174 3.20733 10.75 2.83613V2.29248ZM14.875 14.4591V9.16748C14.875 6.47509 12.6924 4.29248 10 4.29248C7.30765 4.29248 5.12504 6.47509 5.12504 9.16748V14.4591H14.875ZM8.00004 17.7085C8.00004 18.1228 8.33583 18.4585 8.75004 18.4585H11.25C11.6643 18.4585 12 18.1228 12 17.7085C12 17.2943 11.6643 16.9585 11.25 16.9585H8.75004C8.33583 16.9585 8.00004 17.2943 8.00004 17.7085Z" />
        </svg>
    </button>

    {{-- Dropdown Card --}}
    <div
        x-show="dropdownOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-cloak
        {{-- Responsive Positioning: Center di mobile, right di desktop --}}
        class="fixed inset-x-4 top-24 z-50 mx-auto flex h-[480px] max-w-[calc(100vw-32px)] flex-col rounded-[2rem] border border-gray-100 bg-white/95 p-4 shadow-[0_20px_50px_rgba(0,0,0,0.1)] backdrop-blur-xl dark:border-white/5 dark:bg-[#111317]/95 dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)] sm:absolute sm:inset-auto sm:right-0 sm:mt-5 sm:w-[380px]"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between pb-4 mb-2 border-b border-gray-100 dark:border-white/5">
            <h5 class="text-base font-black uppercase tracking-widest text-gray-800 dark:text-white">Pesan Masuk</h5>
            <span class="rounded-full bg-orange-500/10 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-orange-500 border border-orange-500/10">
                {{ $unreadCount ?? 0 }} Baru
            </span>
        </div>

        {{-- Scrollable List --}}
        <ul class="flex-1 overflow-y-auto pr-1 custom-scrollbar">
            {{-- Menggunakan collect() untuk mencegah crash jika $notifications lupa dikirim atau null --}}
            @forelse (collect($notifications ?? []) as $notif)
                <li class="mb-1 last:mb-0">
                    <a class="group flex gap-4 rounded-2xl p-3 transition-all hover:bg-gray-50 dark:hover:bg-white/5" 
                       href="{{ route('contact.index') }}">
                        
                        {{-- Initial Avatar --}}
                        <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-orange-500 text-sm font-black text-white shadow-lg shadow-orange-500/20 transition-transform group-hover:scale-110">
                            {{ strtoupper(substr($notif->nama ?? 'U', 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between mb-0.5">
                                <span class="truncate text-[13px] font-black uppercase tracking-tight text-gray-900 dark:text-white group-hover:text-orange-500 transition-colors">
                                    {{ $notif->nama ?? 'Unknown' }}
                                </span>
                                <span class="flex-shrink-0 text-[10px] font-bold text-gray-400 dark:text-gray-500">
                                    {{ isset($notif->created_at) ? $notif->created_at->diffForHumans(null, true) : '-' }}
                                </span>
                            </div>
                            
                            <p class="truncate text-xs font-medium text-gray-500 dark:text-gray-400">
                                "{{ $notif->pesan ?? '' }}"
                            </p>

                            <div class="mt-2 flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-orange-500/80">Pesan Baru</span>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="flex flex-col items-center justify-center h-full py-20 text-center">
                    <div class="mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gray-50 dark:bg-white/5">
                        <svg class="h-8 w-8 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Belum ada pesan baru</p>
                </li>
            @endforelse
        </ul>

        {{-- Footer Action --}}
        <div class="mt-3 pt-3 border-t border-gray-100 dark:border-white/5">
            <a href="{{ route('contact.index') }}"
                class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gray-900 px-4 py-3.5 text-[11px] font-black uppercase tracking-[0.15em] text-white transition-all hover:bg-orange-600 dark:bg-white/5 dark:hover:bg-orange-500">
                Lihat Semua Pesan
                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path d="M5 12h14m-7-7l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a> 
        </div>
    </div>
</div>