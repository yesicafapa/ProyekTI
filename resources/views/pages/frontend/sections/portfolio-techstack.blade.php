<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M0 1000 H700 L780 1060 H1240 L1320 980 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <path d="M1880 120 V300 L1820 360 V750 L1880 810 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 justify-center items-stretch">
            
            {{-- KOLOM KIRI: PORTOFOLIO --}}
            <div class="lg:w-1/2 flex flex-col">
                <div class="mb-8">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Portofolio</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>

                <div class="bg-[#1a110a] rounded-[2.5rem] p-8 border border-white/5 shadow-2xl h-[650px] flex flex-col">
                    <div class="flex-1 overflow-y-auto pr-4 space-y-10 custom-scrollbar">
                        @forelse($portofolios->where('status', 1) as $portofolio)
                        <div class="group">
                            <a href="{{ route('frontend.portofolio.detail', $portofolio->id) }}" class="block rounded-[2rem] overflow-hidden border border-orange-900/20 mb-4 aspect-video bg-black shadow-lg">
                                @php
                                    $imgPath = ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) 
                                               ? asset('storage/' . $portofolio->gambar) 
                                               : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015";
                                @endphp
                                <img src="{{ $imgPath }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500" alt="{{ $portofolio->judul }}">
                            </a>
                            <div class="px-2">
                                <h3 class="text-white font-bold text-lg group-hover:text-orange-500 transition-colors mb-1 uppercase leading-tight">{{ $portofolio->judul }}</h3>
                                <p class="text-slate-400 text-sm line-clamp-2 italic">{{ $portofolio->deskripsi }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="flex flex-col items-center justify-center h-full opacity-30 italic">
                            <p class="text-white text-xs tracking-widest uppercase">Belum ada project.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: TECH STACK --}}
            <div class="lg:w-1/2 flex flex-col">
                <div class="mb-8">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Tech Stack</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>

                <div class="bg-[#1a110a] rounded-[2.5rem] p-8 border border-white/5 shadow-2xl h-[650px] flex flex-col">
                    {{-- flex-1 + overflow-y-auto tanpa items-center agar tidak kepotong --}}
                    <div class="flex-1 overflow-y-auto pr-4 custom-scrollbar">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-12 gap-x-8 w-full py-10 px-4">
                            @php
                                $techStack = [
                                    ['name' => 'Laravel', 'url' => 'https://laravel.com', 'img' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg'], 
                                    ['name' => 'React', 'url' => 'https://react.dev', 'img' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/react/react-original.svg'], 
                                    ['name' => 'Flutter', 'url' => 'https://flutter.dev', 'img' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/flutter/flutter-original.svg'], 
                                    ['name' => 'Golang', 'url' => 'https://go.dev', 'img' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/go/go-original.svg'],
                                    ['name' => 'Tailwind', 'url' => 'https://tailwindcss.com', 'img' => 'https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg'], 
                                    ['name' => 'Figma', 'url' => 'https://www.figma.com', 'img' => 'https://www.vectorlogo.zone/logos/figma/figma-icon.svg'], 
                                    ['name' => 'Sketch', 'url' => 'https://www.sketch.com', 'img' => 'https://www.vectorlogo.zone/logos/sketchapp/sketchapp-icon.svg'], 
                                    ['name' => 'Webflow', 'url' => 'https://webflow.com', 'img' => 'https://www.vectorlogo.zone/logos/webflow/webflow-icon.svg'],
                                    ['name' => 'Illustrator', 'url' => 'https://www.adobe.com/products/illustrator.html', 'img' => 'https://www.vectorlogo.zone/logos/adobe_illustrator/adobe_illustrator-icon.svg'],
                                    ['name' => 'Framer', 'url' => 'https://www.framer.com', 'img' => 'https://www.vectorlogo.zone/logos/framer/framer-icon.svg']
                                ];
                            @endphp
                            
                            @foreach($techStack as $tech)
                            <a href="{{ $tech['url'] }}" target="_blank" class="flex flex-col items-center group cursor-pointer">
                                <div class="w-24 h-24 mb-4 flex items-center justify-center p-5 rounded-[2rem] bg-black shadow-2xl border border-white/5 group-hover:border-orange-500 group-hover:scale-110 transition-all duration-500 overflow-hidden">
                                    <img src="{{ $tech['img'] }}" class="w-full h-full object-contain filter brightness-90 group-hover:brightness-125">
                                </div>
                                <span class="text-xs font-black text-slate-500 group-hover:text-white uppercase tracking-[0.2em] text-center transition-colors">
                                    {{ $tech['name'] }}
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { 
        background: linear-gradient(to bottom, transparent, #F97316, transparent);
        border-radius: 10px; 
    }
</style>