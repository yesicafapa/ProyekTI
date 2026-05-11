{{-- SECTION HERO --}}
<section class="relative min-h-screen lg:h-screen flex items-center pt-32 pb-32 px-6 lg:py-0 lg:px-24 overflow-hidden bg-[#0a0a0a] font-['Poppins']">
    
    {{-- UNIFIED BACKGROUND FRAME (SINKRON TOTAL) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        {{-- DESKTOP: Satu SVG untuk Frame Keliling --}}
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

            {{-- Titik Ornamen --}}
            <circle cx="630" cy="20" r="4" fill="#F97316" />
            <circle cx="1290" cy="20" r="4" fill="#F97316" />
            <circle cx="630" cy="1060" r="4" fill="#F97316" />
            <circle cx="1290" cy="1060" r="4" fill="#F97316" />
        </svg>

        {{-- MOBILE --}}
        <svg class="lg:hidden w-full h-full" viewBox="0 0 400 800" preserveAspectRatio="none" fill="none">
            <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke" opacity="0.5">
                <path d="M0 60 H120 L150 20 H250 L280 60 H400" />
                <path d="M0 740 H120 L150 780 H250 L280 740 H400" />
            </g>
        </svg>
    </div>

    {{-- CONTENT AREA --}}
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-12 items-center relative z-10">
        {{-- SISI KIRI: TEXT CONTENT --}}
        <div class="lg:col-span-7 flex flex-col justify-center items-center lg:items-start text-center lg:text-left">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-[#F97316] text-xl animate-pulse">✦</span>
                <span class="text-[8px] sm:text-xs uppercase tracking-[0.5em] text-slate-400 font-bold">
                    Beyond Solutions, We Improve and Innovate
                </span>
            </div>

            <div class="relative">
                <h1 class="text-5xl sm:text-6xl lg:text-8xl font-black leading-[1] lg:leading-[0.85] tracking-tighter text-white uppercase mb-8">
                    Seov Kreasi <br>
                    <span class="text-[#F97316]">Indonesia</span>
                </h1>
                <p class="text-[12px] sm:text-sm lg:text-base text-slate-400 max-w-lg leading-relaxed mb-10 font-medium mx-auto lg:mx-0 px-4 lg:px-0 opacity-80">
                    Inovasi bertemu teknologi untuk membantu bisnis Anda tumbuh lebih cerdas dan lebih cepat! Kami menghadirkan solusi teknologi yang efisien, kreatif, dan mutakhir.
                </p>
            </div>
            
            <a href="{{ route('frontend.contact') }}" class="inline-block px-12 py-4 border border-[#F97316]/30 text-white font-bold rounded-full hover:bg-[#F97316] hover:border-[#F97316] transition-all duration-500 uppercase text-[10px] tracking-widest bg-[#F97316]/5 backdrop-blur-sm shadow-lg shadow-[#F97316]/10">
                Kontak Kami
            </a>
        </div>

        {{-- SISI KANAN: BRANDING --}}
        <div class="lg:col-span-5 relative flex flex-col items-center justify-center">
            <div class="relative group">
                <div class="absolute -inset-10 bg-[#F97316]/10 blur-[80px] rounded-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative flex flex-col items-center">
                    <div class="flex items-center gap-6 mb-4">
                        <img src="{{ asset('assets/img/logo/logo-main.png') }}" alt="Seov Detech" class="w-20 lg:w-32 h-auto drop-shadow-[0_0_40px_rgba(249,115,22,0.4)]">
                        <div class="flex flex-col text-left">
                            <span class="text-5xl lg:text-7xl font-black text-white tracking-tighter uppercase leading-none">Seov</span>
                            <span class="text-5xl lg:text-7xl font-black text-[#F97316] tracking-tighter uppercase leading-none">Detech</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center w-full">
                        <p class="text-[9px] lg:text-[11px] font-bold text-slate-500 tracking-[0.4em] uppercase mb-10 text-center">CV. SEOV KREASI NUSANTARA</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            <span class="px-6 py-2 rounded-full border border-white/10 bg-[#0f0f0f]/80 text-[9px] font-bold uppercase tracking-widest text-slate-300 backdrop-blur-md">
                                Brand Research
                            </span>
                            <span class="px-6 py-2 rounded-full border border-white/10 bg-[#0f0f0f]/80 text-[9px] font-bold uppercase tracking-widest text-slate-300 backdrop-blur-md">
                                Development Team
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>