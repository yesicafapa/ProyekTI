<section class="relative min-h-screen flex items-center pt-20 px-6 lg:px-24 overflow-hidden bg-[#0a0a0a] font-['Poppins']">
    
    {{-- Background Lines (Single Side Lines - Clean Version) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-50">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            
            {{-- Garis Horizontal Atas --}}
            <path d="M0 100 H400 L480 20 H1440 L1520 100 H1920" 
                  stroke="#F97316" stroke-width="3" opacity="0.4"/>
            
            {{-- Garis Horizontal Bawah --}}
            <path d="M0 980 H600 L680 900 H1240 L1320 980 H1920" 
                  stroke="#F97316" stroke-width="3" opacity="0.4"/>

            {{-- Garis Samping Kiri (Single) --}}
            <path d="M50 120 V300 L110 360 V600 L50 660 V960" 
                  stroke="#F97316" stroke-width="2.5" opacity="0.3"/>

            {{-- Garis Samping Kanan (Single) --}}
            <path d="M1870 120 V350 L1810 410 V700 L1870 760 V960" 
                  stroke="#F97316" stroke-width="2.5" opacity="0.3"/>

            {{-- Dekorasi Titik (Dots) --}}
            <circle cx="480" cy="20" r="4" fill="#F97316" />
            <circle cx="1520" cy="100" r="4" fill="#F97316" />
            <circle cx="110" cy="360" r="3" fill="#F97316" opacity="0.5"/>
            <circle cx="1810" cy="410" r="3" fill="#F97316" opacity="0.5"/>
        </svg>
    </div>

    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
        {{-- SISI KIRI: TEXT CONTENT --}}
        <div class="lg:col-span-7 flex flex-col justify-center">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-orange-500 text-2xl animate-pulse">✦</span>
                <span class="text-[10px] sm:text-xs uppercase tracking-[0.5em] text-slate-400 font-bold">
                    Beyond Solutions, We Improve and Innovate
                </span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-black leading-[0.9] tracking-tighter text-white uppercase mb-8">
                Seov Kreasi <br>
                <span class="text-white">Indonesia</span>
            </h1>
            <p class="text-sm lg:text-base text-slate-400 max-w-lg leading-relaxed mb-10 font-medium">
                Innovation meets technology to help your business grow smarter and faster! We're your go-to IT partner, bringing you efficient, creative, and cutting-edge tech solutions.
            </p>
            <div>
                {{-- PERBAIKAN: href sekarang menggunakan route Laravel --}}
                <a href="{{ route('frontend.contact') }}" class="px-10 py-3 border border-white/20 text-white font-bold rounded-full hover:bg-white hover:text-black transition-all duration-500 uppercase text-[10px] tracking-widest bg-white/5 backdrop-blur-sm">
                    Contact Us
                </a>
            </div>
        </div>

        {{-- SISI KANAN: BRANDING --}}
        <div class="lg:col-span-5 relative flex flex-col items-center justify-center">
            <div class="relative flex flex-col items-center">
                <div class="flex items-center gap-6 mb-4">
                    <img src="{{ asset('assets/img/logo/logo-main.png') }}" alt="Seov Detech" class="w-24 lg:w-28 h-auto drop-shadow-[0_0_30px_rgba(249,115,22,0.3)]">
                    <div class="flex flex-col">
                        <span class="text-5xl lg:text-6xl font-black text-white tracking-tighter uppercase leading-none">Seov</span>
                        <span class="text-5xl lg:text-6xl font-black text-slate-200 tracking-tighter uppercase leading-none">Detech</span>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <p class="text-[10px] font-bold text-slate-500 tracking-[0.4em] uppercase mb-6 text-center">CV. SEOV KREASI NUSANTARA</p>
                    <div class="flex gap-4">
                        <span class="px-5 py-2 rounded-full border border-white/10 bg-white/5 text-[9px] font-bold uppercase tracking-widest text-slate-400">Brand Research</span>
                        <span class="px-5 py-2 rounded-full border border-white/10 bg-white/5 text-[9px] font-bold uppercase tracking-widest text-slate-400">Development Team</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>