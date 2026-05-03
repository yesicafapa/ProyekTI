<nav x-data="{ open: false }" class="fixed w-full z-[100] px-6 lg:px-20 top-0 left-0 bg-[#0a0a0a]/95 backdrop-blur-md border-b border-white/5 py-5 font-['Poppins']">
    <div class="container mx-auto flex items-center justify-between">
        
        {{-- LOGO AREA --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="relative w-12 h-12 flex items-center justify-center">
                <img src="{{ asset('assets/img/logo/logo-main.png') }}" 
                     class="h-full w-auto object-contain transition-transform duration-500 group-hover:rotate-12 group-hover:scale-110" 
                     alt="Seov Detech Logo">
            </div>

            <div class="flex flex-col leading-none">
                <span class="text-white font-[1000] text-2xl tracking-tighter uppercase">
                    Seov <span class="text-orange-500">Detech</span>
                </span>
                <span class="text-[8px] text-slate-500 font-bold tracking-[0.4em] uppercase mt-1">
                    Innovation & Technology
                </span>
            </div>
        </a>
        
        {{-- WRAPPER UNTUK MENU & BUTTON (DESKTOP) --}}
        <div class="hidden md:flex items-center gap-12 ml-auto">
            <div class="flex items-center gap-10">
                {{-- Link ke Home --}}
                <a href="{{ route('home') }}" 
                   class="text-base font-black uppercase tracking-widest hover:text-orange-500 transition-all {{ request()->routeIs('home') ? 'text-orange-500' : 'text-white' }}">
                   Beranda
                </a>

                {{-- Link ke Halaman Portofolio --}}
                <a href="{{ route('frontend.portofolio.index') }}" 
                   class="text-base font-black uppercase tracking-widest hover:text-orange-500 transition-all {{ request()->routeIs('frontend.portofolio.*') ? 'text-orange-500' : 'text-white' }}">
                   Portfolio
                </a>

                {{-- Link ke Halaman Blog --}}
                <a href="{{ route('frontend.blog.index') }}" 
                   class="text-base font-black uppercase tracking-widest hover:text-orange-500 transition-all {{ request()->routeIs('frontend.blog.*') ? 'text-orange-500' : 'text-white' }}">
                   Artikel
                </a>
            </div>

            {{-- BUTTON CONTACT --}}
            <a href="{{ route('frontend.contact') }}" 
               class="bg-orange-500 text-black px-10 py-4 rounded-xl text-sm font-black uppercase tracking-widest hover:bg-white transition-all duration-300 shadow-xl shadow-orange-500/20">
               Kontak Kami
            </a>
        </div>

        {{-- MOBILE MENU BUTTON --}}
        <button @click="open = !open" class="md:hidden text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    {{-- MOBILE MENU (Tampilan HP) --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="md:hidden bg-[#0d0d0d] border-t border-white/5 px-6 py-10 space-y-8">
        
        <a href="{{ route('home') }}" class="block font-black uppercase text-base tracking-widest {{ request()->routeIs('home') ? 'text-orange-500' : 'text-white' }}">Beranda</a>
        
        <a href="{{ route('frontend.portofolio.index') }}" class="block font-black uppercase text-base tracking-widest {{ request()->routeIs('frontend.portofolio.*') ? 'text-orange-500' : 'text-white' }}">Portfolio</a>
        
        <a href="{{ route('frontend.blog.index') }}" class="block font-black uppercase text-base tracking-widest {{ request()->routeIs('frontend.blog.*') ? 'text-orange-500' : 'text-white' }}">Artikel</a>
        
        <a href="{{ route('frontend.contact') }}" class="block text-orange-500 font-black uppercase text-base tracking-widest">Kontak Kami</a>
    </div>
</nav>