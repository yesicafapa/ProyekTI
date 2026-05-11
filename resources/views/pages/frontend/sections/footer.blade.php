<footer class="bg-[#0a0a0a] pt-24 pb-12 px-6 lg:px-20 relative overflow-hidden font-['Poppins']">
    
    {{-- Dekorasi Garis Background (OPACITY SINKRON DENGAN BLOG/FAQ) --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                {{-- ATAS: Menghubungkan lekukan dari section sebelumnya --}}
                <path d="M0 100 H550 L630 20 H1290 L1370 100 H1920" opacity="0.3"/>
            </g>
        </svg>

        {{-- MOBILE: Opacity disesuaikan agar smooth --}}
        <div class="absolute top-0 left-0 right-0 lg:hidden">
            <svg class="w-full h-[80px]" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                <path d="M0 60 H120 L150 20 H250 L280 60 H400" stroke="#F97316" stroke-width="2" opacity="0.2"/>
            </svg>
        </div>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Grid Utama --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            
            {{-- KOLOM 1: LOGO & DESKRIPSI --}}
            <div class="space-y-6">
                <div class="flex items-center gap-4 group">
                    <img src="{{ asset('assets/img/logo/logo-main.png') }}" 
                         class="h-12 w-auto object-contain drop-shadow-[0_0_15px_rgba(249,115,22,0.2)]" 
                         alt="Logo Seov Detech">
                    
                    <div class="flex flex-col leading-none">
                        <span class="text-xl font-[1000] text-white tracking-tighter uppercase">
                            Seov <span class="text-orange-500">Detech</span>
                        </span>
                        <span class="text-[7px] text-slate-500 font-bold tracking-[0.4em] uppercase mt-1">
                            Innovation & Technology
                        </span>
                    </div>
                </div>
                
                <p class="text-sm text-slate-400 leading-relaxed font-medium max-w-xs">
                    Solusi teknologi inovatif untuk transformasi digital bisnis Anda. Membangun masa depan dengan kode dan kreativitas.
                </p>
            </div>

            {{-- KOLOM 2: NAVIGATION --}}
            <div class="space-y-8 lg:pl-10">
                <h4 class="text-xs font-black text-orange-500 uppercase tracking-[0.3em]">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-white transition-colors font-medium">Beranda</a></li>
                    <li><a href="#services" class="text-sm text-slate-400 hover:text-white transition-colors font-medium">Layanan Kami</a></li>
                    <li><a href="#portfolio" class="text-sm text-slate-400 hover:text-white transition-colors font-medium">Portfolio</a></li>
                    <li><a href="#blog" class="text-sm text-slate-400 hover:text-white transition-colors font-medium">Artikel Terbaru</a></li>
                </ul>
            </div>

            {{-- KOLOM 3: EXPERTISE --}}
            <div class="space-y-8">
                <h4 class="text-xs font-black text-orange-500 uppercase tracking-[0.3em]">Keahlian</h4>
                <ul class="space-y-4 text-sm text-slate-400 font-medium">
                    <li class="hover:text-white transition-colors cursor-default">Web Development</li>
                    <li class="hover:text-white transition-colors cursor-default">Mobile Apps (Android)</li>
                    <li class="hover:text-white transition-colors cursor-default">UI/UX Design</li>
                    <li class="hover:text-white transition-colors cursor-default">IT Consulting</li>
                </ul>
            </div>

            {{-- KOLOM 4: GET IN TOUCH --}}
            <div class="space-y-8">
                <h4 class="text-xs font-black text-orange-500 uppercase tracking-[0.3em]">Hubungi Kami</h4>
                <div class="space-y-5">
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Kantor</p>
                        <p class="text-sm text-slate-400 font-medium">Madiun, Jawa Timur, Indonesia</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Email</p>
                        <p class="text-sm text-white font-black hover:text-orange-500 transition-colors">hello@seovdetech.com</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Kontak</p>
                        <p class="text-xl text-orange-500 font-black tracking-tighter">+62 898-1500-648</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM BAR --}}
        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-center items-center">
            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] text-center">
                &copy; {{ date('Y') }} CV. SEOV KREASI NUSANTARA. ALL RIGHTS RESERVED.
            </p>
        </div>
    </div>
</footer>