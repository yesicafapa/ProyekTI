<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 100 H400 L480 20 H1440 L1520 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 130 V300 L90 350 V600 L40 650 V950" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Header Section --}}
        <div class="mb-16">
            <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Team Kami</h2>
            <div class="h-1.5 w-28 bg-orange-500"></div>
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
                <div class="relative w-full aspect-[4/5] rounded-[2.5rem] bg-orange-500 overflow-hidden transition-all duration-500 group-hover:-translate-y-3 shadow-lg shadow-orange-500/10">
                    
                    @php
                        // Memindahkan logika URL ke PHP agar JavaScript di 'onerror' terlihat bersih bagi VS Code
                        $fallbackUrl = "https://ui-avatars.com/api/?background=F97316&color=fff&name=" . urlencode($member['nama']);
                    @endphp

                    <img src="{{ asset('assets/img/team/' . $member['foto']) }}" 
                         class="h-full w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" 
                         alt="{{ $member['nama'] }}"
                         onerror="this.src='{{ $fallbackUrl }}'; this.onerror=null;">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <div class="mt-6 text-center">
                    <h4 class="text-xl font-bold text-white tracking-tight group-hover:text-orange-500 transition-colors">{{ $member['nama'] }}</h4>
                    <p class="text-[10px] font-medium text-slate-500 uppercase tracking-widest mt-1">{{ $member['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>