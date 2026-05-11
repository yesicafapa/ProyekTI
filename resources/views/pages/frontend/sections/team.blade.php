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
        {{-- Header Section --}}
        <div class="mb-16 mt-10">
            <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Team Kami</h2>
            <div class="h-1.5 w-28 bg-[#F97316]"></div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 lg:gap-8">
            @php
                $teams = [
                    ['nama' => 'Bima', 'role' => 'Software Developer', 'foto' => 'bimo.jpeg'],
                    ['nama' => 'Nadia', 'role' => 'Project Manager', 'foto' => 'nadia.jpeg'],
                    ['nama' => 'Gilang', 'role' => 'Mobile Developer', 'foto' => 'gilang.jpeg'],
                    ['nama' => 'Nurhakiki', 'role' => 'Fullstack Developer', 'foto' => 'nurhakiki.jpeg'],
                    ['nama' => 'Afriza', 'role' => 'Digital Marketing', 'foto' => 'afriza.jpeg'],
                ];
            @endphp

            @foreach($teams as $member)
            <div class="group flex flex-col items-center">
                <div class="relative w-full aspect-[4/5] rounded-[2.5rem] bg-[#F97316] overflow-hidden transition-all duration-500 group-hover:-translate-y-3 shadow-lg shadow-orange-500/10">
                    
                    @php
                        $fallbackUrl = "https://ui-avatars.com/api/?background=F97316&color=fff&name=" . urlencode($member['nama']);
                    @endphp

                    <img src="{{ asset('assets/img/team/' . $member['foto']) }}" 
                         class="h-full w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" 
                         alt="{{ $member['nama'] }}"
                         onerror="this.src='{{ $fallbackUrl }}'; this.onerror=null;">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <div class="mt-6 text-center">
                    <h4 class="text-xl font-bold text-white tracking-tight group-hover:text-[#F97316] transition-colors">{{ $member['nama'] }}</h4>
                    <p class="text-[10px] font-medium text-slate-500 uppercase tracking-widest mt-1">{{ $member['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>