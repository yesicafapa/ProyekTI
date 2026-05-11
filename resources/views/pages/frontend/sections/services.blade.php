<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
     {{-- BACKGROUND FRAME --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
        {{-- DESKTOP: Koordinat disamakan agar alur garis menyambung sempurna --}}
        <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                {{-- ATAS: Garis horizontal dengan lekukan --}}
                <path d="M0 100 H550 L630 20 H1290 L1370 100 H1920" opacity="0.6"/>
                
                {{-- KIRI: Berhenti di 980 supaya tidak nembus garis bawah --}}
                <path d="M15 100 V450 L45 480 V600 L15 630 V980" opacity="0.6" />
                
                {{-- KANAN: Berhenti di 980 (Simetris sempurna) --}}
                <path d="M1905 100 V450 L1875 480 V600 L1905 630 V980" opacity="0.6" />

                {{-- BAWAH: Garis horizontal penutup --}}
                <path d="M0 980 H550 L630 1060 H1290 L1370 980 H1920" opacity="0.6"/>
            </g>
        </svg>

        {{-- MOBILE: TETAP SESUAI KODEMU (TIDAK DIRUBAH) --}}
        <div class="absolute top-0 left-0 right-0 lg:hidden">
            <svg class="w-full h-[80px]" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                <path d="M0 60 H120 L150 20 H250 L280 60 H400" stroke="#F97316" stroke-width="2" opacity="0.5"/>
            </svg>
        </div>
        <div class="absolute bottom-0 left-0 right-0 lg:hidden">
            <svg class="w-full h-[80px]" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                <path d="M0 20 H120 L150 60 H250 L280 20 H400" stroke="#F97316" stroke-width="2" opacity="0.5"/>
            </svg>
        </div>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Header --}}
        <div class="mb-16 mt-10"> 
            <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Layanan Kami</h2>
            <div class="h-1.5 w-28 bg-[#F97316]"></div>
        </div>

        {{-- Grid Card --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Card 1 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-[#F97316]/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">IT Consulting Made Simple & Smart</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Kami membantu merancang strategi IT yang efisien untuk bisnis Anda.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-[#F97316]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-[#F97316]/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">Software & APP Development</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Pengembangan aplikasi mobile (Android/iOS) dan sistem web berbasis Laravel.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-[#F97316]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-[#F97316]/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">UI/UX Design</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Menciptakan pengalaman pengguna yang berkesan melalui desain modern dan fungsional.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-[#F97316]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="group p-10 rounded-[2.5rem] bg-gradient-to-br from-[#1a1305] to-[#0a0a0a] border border-orange-900/20 hover:border-[#F97316]/50 transition-all duration-500 shadow-2xl backdrop-blur-sm">
                <h3 class="text-2xl font-bold text-white mb-4 tracking-tight">Digital Transformation Strategy</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Membawa bisnis konvensional Anda ke dunia digital dengan integrasi sistem yang mulus.</p>
                <div class="mt-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0 text-[#F97316]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>
        </div>
    </div>
</section>