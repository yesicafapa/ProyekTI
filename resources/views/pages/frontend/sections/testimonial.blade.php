<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- CSS Khusus untuk Scrollbar Orange --}}
    <style>
        .custom-testi-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-testi-scroll::-webkit-scrollbar-track {
            background: rgba(26, 19, 5, 0.2);
            border-radius: 10px;
        }
        .custom-testi-scroll::-webkit-scrollbar-thumb {
            background: #f97316; 
            border-radius: 10px;
        }
        .custom-testi-scroll::-webkit-scrollbar-thumb:hover {
            background: #ea580c;
        }
        /* Menghaluskan pergerakan scroll di Firefox */
        .custom-testi-scroll {
            scrollbar-width: thin;
            scrollbar-color: #f97316 rgba(26, 19, 5, 0.2);
        }
    </style>

     {{-- BACKGROUND FRAME (SINKRON DENGAN HERO & LAYANAN) --}}
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

    <div class="container mx-auto max-w-4xl relative z-10">
        
        {{-- HEADER SECTION --}}
        <div class="mb-16 flex flex-col items-center text-center">
            <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Testimoni</h2>
            <div class="h-1.5 w-28 bg-orange-500"></div>
        </div>
        
        {{-- AREA SCROLLABLE --}}
        <div class="max-h-[550px] overflow-y-auto pr-4 space-y-6 custom-testi-scroll">
            @forelse($testimonis as $testi)
                {{-- Item Testimoni --}}
                <div class="p-8 md:p-10 rounded-[2.5rem] bg-[#1a1305]/40 border border-orange-900/20 flex flex-col md:flex-row gap-8 items-center backdrop-blur-sm hover:border-orange-500/50 transition-all duration-300">
                    
                    {{-- Foto Profil --}}
                    <div class="h-20 w-20 rounded-full bg-slate-800 flex-shrink-0 border-2 border-orange-500/30 overflow-hidden shadow-[0_0_15px_rgba(249,115,22,0.2)]">
                        @if($testi->image_pengguna)
                            <img src="{{ asset('storage/' . $testi->image_pengguna) }}" class="w-full h-full object-cover" alt="{{ $testi->pengguna }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-600 to-orange-900 text-white font-bold text-xl">
                                {{ strtoupper(substr($testi->pengguna, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Konten --}}
                    <div class="space-y-3 flex-1">
                        <p class="text-sm md:text-base text-slate-300 italic leading-relaxed text-center md:text-left">
                            "{{ $testi->deskripsi }}"
                        </p>
                        <div class="text-center md:text-left">
                            <h5 class="text-white font-black tracking-tight">{{ $testi->pengguna }}</h5>
                            <p class="text-[10px] text-orange-500 uppercase font-bold tracking-widest">
                                {{ $testi->jabatan ?? 'Happy Client' }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-slate-500 italic">Belum ada testimoni yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
        
        {{-- Penanda Scroll (Opsional) --}}
        <div class="mt-8 flex justify-center opacity-30">
             <p class="text-[10px] text-white uppercase tracking-widest animate-bounce">Scroll to see more ↓</p>
        </div>

    </div>
</section>