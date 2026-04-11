<header
    class="sticky top-0 flex w-full bg-white border-gray-200 z-99999 dark:border-gray-800 dark:bg-gray-900 xl:border-b"
    x-data="{
        isApplicationMenuOpen: false,
        isUserMenuOpen: false, 
        toggleApplicationMenu() {
            this.isApplicationMenuOpen = !this.isApplicationMenuOpen;
        }
    }">
    <div class="flex flex-col items-center justify-between grow xl:flex-row xl:px-6">
        <div class="flex items-center justify-between w-full gap-2 px-3 py-3 border-b border-gray-200 dark:border-gray-800 sm:gap-4 xl:justify-normal xl:border-b-0 xl:px-0 lg:py-4">

            <button class="hidden xl:flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 lg:h-11 lg:w-11"
                @click="$store.sidebar.toggleExpanded()">
                <svg x-show="!$store.sidebar.isMobileOpen" width="16" height="12" viewBox="0 0 16 12" fill="none"><path d="M0.583252 1H15.4166M0.583252 11H15.4166M1.33325 6H8.74992" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>

            <button class="flex xl:hidden items-center justify-center w-10 h-10 text-gray-500 rounded-lg" @click="$store.sidebar.toggleMobileOpen()">
                <svg width="16" height="12" viewBox="0 0 16 12" fill="currentColor"><path d="M0.583252 1H15.4166M0.583252 11H15.4166M0.583252 6H15.4166" /></svg>
            </button>

            <a href="/" class="xl:hidden">
                <img class="dark:hidden h-8" src="/images/logo/logo.svg" alt="Logo" />
                <img class="hidden dark:block h-8" src="/images/logo/logo-dark.svg" alt="Logo" />
            </a>

            <button @click="toggleApplicationMenu()" class="xl:hidden flex items-center justify-center w-10 h-10 text-gray-700">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><circle cx="6" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="18" cy="12" r="1.5"/></svg>
            </button>

            <div class="hidden xl:block">
                <div class="relative">
                    <span class="absolute -translate-y-1/2 left-4 top-1/2 text-gray-400">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.34-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                    </span>
                    <input type="text" placeholder="Search..." class="h-11 w-[430px] rounded-lg border border-gray-200 bg-transparent pl-12 pr-4 text-sm dark:border-gray-800 dark:text-white" />
                </div>
            </div>
        </div>

        <div :class="isApplicationMenuOpen ? 'flex' : 'hidden'" class="items-center justify-between w-full gap-4 px-5 py-4 xl:flex xl:justify-end xl:px-0">
            <div class="flex items-center gap-2 2xsm:gap-3">
                <button class="flex items-center justify-center border border-gray-200 rounded-full h-11 w-11 dark:border-gray-800" @click="$store.theme.toggle()">
                    <svg class="hidden dark:block" width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10z"/></svg>
                    <svg class="dark:hidden" width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 0 1 6.707 2.707a8.001 8.001 0 1 0 10.586 10.586z"/></svg>
                </button>
                <x-header.notification-dropdown />
            </div>

            <div class="relative">
                <button @click="isUserMenuOpen = !isUserMenuOpen" @click.away="isUserMenuOpen = false" class="flex items-center gap-3 focus:outline-none">
                    <span class="hidden text-right xl:block">
                        <span class="block text-sm font-medium text-gray-800 dark:text-white">{{ Auth::user()->nama }}</span>
                        <span class="block text-xs text-gray-500">{{ ucfirst(Auth::user()->level) }}</span>
                    </span>

                    {{-- FIX FOTO PROFIL DI SINI --}}
                    @if(Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                             class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-100 dark:border-gray-800" 
                             alt="Profile">
                    @else
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-orange-600 text-white font-bold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </div>
                    @endif

                    <svg :class="isUserMenuOpen ? 'rotate-180' : ''" class="transition-transform duration-200 text-gray-500" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4.16699 7.5L10.0003 13.3333L15.8337 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div x-show="isUserMenuOpen" x-transition class="absolute right-0 mt-3 w-48 rounded-xl border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-800 dark:bg-gray-900 z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5 rounded-lg">Edit Profile</a>
                    <hr class="my-1 border-gray-100 dark:border-gray-800" />
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full px-3 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg text-left">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>