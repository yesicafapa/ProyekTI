<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Dekorasi Garis Background --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <path d="M1880 120 V300 L1820 360 V750 L1880 810 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            {{-- KOLOM KIRI: BLOG  --}}
            <div class="lg:col-span-5 w-full">
                <div class="mb-10">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Blog</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>
                
                {{-- Container Scroll Blog --}}
                <div class="h-[650px] overflow-y-auto pr-4 custom-scrollbar space-y-10" style="scrollbar-gutter: stable;">
                    
                    @forelse($artikels as $artikel)
                    <article class="group">
                        <a href="{{ route('frontend.blog.detail', $artikel->slug ?? $artikel->id) }}" class="block">
                            <div class="relative aspect-video w-full overflow-hidden rounded-[2.5rem] bg-[#111] border border-white/5 shadow-2xl">
                                @php
                                    $default_img = "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070"; 
                                    $thumbnail_exists = $artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail);
                                    $img_path = $thumbnail_exists ? asset('storage/' . $artikel->thumbnail) : $default_img;
                                @endphp

                                <img src="{{ $img_path }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700" 
                                     alt="{{ $artikel->judul }}">
                                
                                <div class="absolute top-5 left-5">
                                    <span class="bg-orange-500 text-black text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                                        Insight
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3">
                                <div class="flex items-center gap-3 text-[10px] font-bold uppercase tracking-widest">
                                    <span class="text-orange-500">Tech Update</span>
                                    <span class="text-slate-600">/</span>
                                    <span class="text-slate-500">{{ $artikel->created_at ? (is_string($artikel->created_at) ? date('M d, Y', strtotime($artikel->created_at)) : $artikel->created_at->format('M d, Y')) : date('M d, Y') }}</span>
                                </div>
                                <h4 class="text-xl font-bold text-white leading-tight group-hover:text-orange-500 transition-colors uppercase">
                                    {{ $artikel->judul }}
                                </h4>
                                <p class="text-xs text-slate-400 font-medium line-clamp-2 leading-relaxed">
                                    {{ $artikel->ringkasan ?? Str::limit(strip_tags($artikel->konten), 100) }}
                                </p>
                            </div>
                        </a>
                    </article>
                    @empty
                    @endforelse

                </div>
            </div>

            {{-- KOLOM KANAN: FAQ --}}
            <div class="lg:col-span-7" x-data="{ activeFaq: null }">
                <div class="mb-10">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">FAQ</h2>
                    <div class="h-1.5 w-28 bg-orange-500"></div>
                </div>
                
                <div class="space-y-4">
                    @php
                        $faq_items = [
                            ['id' => 1, 'p' => 'Apa itu Seov Detech?', 'j' => 'Seov Detech adalah mitra inovasi digital yang berfokus pada solusi teknologi mutakhir untuk membantu bisnis berkembang lebih cepat.'],
                            ['id' => 2, 'p' => 'Layanan apa saja yang tersedia?', 'j' => 'Website Development, Mobile App, UI/UX Design, serta Maintenance Sistem.'],
                            ['id' => 3, 'p' => 'Berapa lama proses pembuatan?', 'j' => 'Landing page 1-2 minggu, sistem kustom 4-8 minggu.'],
                            ['id' => 4, 'p' => 'Apakah website bisa dibuka di HP?', 'j' => 'Tentu! Semua produk kami menggunakan Responsive Design yang optimal di semua layar.'],
                            ['id' => 5, 'p' => 'Bagaimana cara memesan?', 'j' => 'Klik tombol Hubungi Kami di bawah untuk konsultasi gratis melalui formulir kami.']
                        ];
                    @endphp

                    @foreach($faq_items as $item)
                    <div class="rounded-[1.5rem] bg-[#1a1305]/30 border border-orange-900/10 overflow-hidden hover:border-orange-500/30 transition-colors backdrop-blur-sm shadow-lg shadow-black/20">
                        <button @click="activeFaq = activeFaq === {{ $item['id'] }} ? null : {{ $item['id'] }}" 
                                class="w-full flex items-center justify-between p-6 text-left group">
                            <span class="text-sm font-bold text-white uppercase tracking-widest group-hover:text-orange-500 transition-colors relative z-10">
                                {{ $item['p'] }}
                            </span>
                            <div class="flex-shrink-0 w-8 h-8 rounded-full border border-orange-500/30 flex items-center justify-center relative z-10">
                                <svg :class="{'rotate-180 bg-orange-500 text-black': activeFaq === {{ $item['id'] }}}" 
                                     class="h-4 w-4 text-orange-500 transition-all duration-300 rounded-full" 
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        <div x-show="activeFaq === {{ $item['id'] }}" x-collapse class="px-6 pb-8">
                            <p class="text-slate-400 text-xs font-medium leading-relaxed border-t border-orange-900/20 pt-6 relative z-10">{{ $item['j'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA Box --}}
                <div class="mt-12 p-8 rounded-[2rem] bg-gradient-to-r from-orange-500 to-orange-600 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-orange-500/30 relative overflow-hidden CTA-box">
                    <div class="absolute -right-10 -top-10 w-24 h-24 bg-white/10 rounded-full blur-2xl CTA-decor"></div>
                    <p class="text-black font-black text-xs uppercase tracking-wider relative z-10 CTA-text">Butuh bantuan konsultasi project Anda?</p>
                    
                    {{-- PERBAIKAN: Sekarang mengarah ke route contact --}}
                    <a href="{{ route('frontend.contact') }}" class="px-8 py-3 bg-black text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 transition-transform shadow-xl relative z-10 CTA-button">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
</style>