<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines (High-Tech Frame) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 100 H400 L480 20 H1440 L1520 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M0 980 H600 L680 900 H1240 L1320 980 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 130 V300 L90 350 V600 L40 650 V950" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <path d="M1880 130 V350 L1830 400 V700 L1880 750 V950" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <circle cx="480" cy="20" r="4" fill="#F97316" />
            <circle cx="1520" cy="100" r="4" fill="#F97316" />
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Header Section --}}
        <div class="mb-16">
            {{-- Ukuran dinaikkan ke text-base (16px) agar lebih tegas --}}
            <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Layanan Kami</h2>
            <div class="h-1.5 w-28 bg-orange-500"></div> {{-- Garis dipertebal & diperlebar --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Card 1 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-orange-500/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">IT Consulting Made Simple & Smart</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Kami membantu merancang strategi IT yang efisien untuk bisnis Anda, memastikan teknologi bekerja untuk Anda, bukan sebaliknya.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-orange-500/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">Software & APP Development</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Pengembangan aplikasi mobile (Android/iOS) dan sistem web berbasis Laravel dengan performa tinggi dan keamanan maksimal.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-orange-500/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">UI/UX Design</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Menciptakan pengalaman pengguna yang berkesan melalui desain antarmuka yang modern, bersih, dan fungsional.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-orange-500/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">Digital Transformation Strategy</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Membawa bisnis konvensional Anda ke dunia digital dengan integrasi sistem yang mulus dan data-driven.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>
        </div>
    </div>
</section>