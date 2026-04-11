<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M0 1000 H700 L780 1060 H1240 L1320 980 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <path d="M1880 120 V300 L1820 360 V750 L1880 810 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 justify-center items-start">
            
            {{-- KOLOM KIRI: PORTOFOLIO --}}
            <div class="lg:w-[500px] flex flex-col">
                <div class="mb-8">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Portofolio</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>

                <div class="bg-[#1a110a] rounded-[2.5rem] p-8 border border-white/5 shadow-2xl h-[650px] flex flex-col">
                    <div class="flex-1 overflow-y-auto pr-4 space-y-10 custom-scrollbar">
                        
                        {{-- Item 1 --}}
                        <div class="group">
                            <a href="{{ route('frontend.portofolio.index') }}" class="block rounded-[2rem] overflow-hidden border border-orange-900/20 mb-4 aspect-video bg-black shadow-lg">
                                <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                            </a>
                            <div class="px-2">
                                <a href="{{ route('frontend.portofolio.index') }}" class="group">
                                    <h3 class="text-white font-bold text-lg group-hover:text-orange-500 transition-colors mb-1 uppercase">Psikotes Gratis</h3>
                                </a>
                                <p class="text-slate-400 text-sm">Sistem informasi untuk pelaksanaan ujian psikotes secara daring dengan hasil instan.</p>
                            </div>
                        </div>

                        {{-- Item 2 --}}
                        <div class="group">
                            <a href="{{ route('frontend.portofolio.index') }}" class="block rounded-[2rem] overflow-hidden border border-orange-900/20 mb-4 aspect-video bg-black shadow-lg">
                                <img src="https://images.unsplash.com/photo-1454165833762-0102b282f06b?q=80&w=2070" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                            </a>
                            <div class="px-2">
                                <a href="{{ route('frontend.portofolio.index') }}" class="group">
                                    <h3 class="text-white font-bold text-lg group-hover:text-orange-500 transition-colors mb-1 uppercase">SIAKAD PNM</h3>
                                </a>
                                <p class="text-slate-400 text-sm">Platform akademik untuk manajemen data mahasiswa, nilai, dan kurikulum.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: TECH STACK --}}
            <div class="lg:w-[550px] flex flex-col">
                <div class="mb-8">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Tech Stack</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>

                <div class="bg-[#1a110a] rounded-[2.5rem] p-10 border border-white/5 shadow-2xl">
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-y-10 gap-x-4">
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
                        {{-- Bungkus dengan <a> untuk membuat link --}}
                        <a href="{{ $tech['url'] }}" target="_blank" class="flex flex-col items-center group cursor-pointer">
                            <div class="w-12 h-12 mb-3 flex items-center justify-center p-2 rounded-xl bg-black/40 group-hover:bg-orange-500/10 group-hover:scale-110 transition-all duration-300">
                                <img src="{{ $tech['img'] }}" class="w-8 h-8 object-contain">
                            </div>
                            <span class="text-[9px] font-bold text-slate-500 group-hover:text-white uppercase tracking-tighter text-center transition-colors">{{ $tech['name'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>