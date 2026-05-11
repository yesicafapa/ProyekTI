<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins']">
    
    {{-- Dekorasi Garis Background --}}
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

    <div class="container mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            {{-- KOLOM KIRI: BLOG  --}}
            <div class="lg:col-span-5 w-full">
                <div class="mb-10">
                    <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Artikel</h2>
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
{{-- KOLOM KANAN: FAQ --}}
<div class="lg:col-span-7" x-data="{ activeFaq: null }">
    <div class="mb-10">
        <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">PERTANYAAN UMUM</h2>
        <div class="h-1.5 w-28 bg-orange-500"></div>
    </div>
    
    <div class="space-y-4">
        {{-- FILTER LANGSUNG DI BLADE: Hanya nampilin status 1 --}}
        @forelse($faqs->where('status', 1) as $item)
        <div class="rounded-[1.5rem] bg-[#1a1305]/30 border border-orange-900/10 overflow-hidden hover:border-orange-500/30 transition-colors backdrop-blur-sm shadow-lg shadow-black/20">
            <button @click="activeFaq = (activeFaq === {{ $item->id }} ? null : {{ $item->id }})" 
                    class="w-full flex items-center justify-between p-6 text-left group outline-none">
                
                <span :class="activeFaq === {{ $item->id }} ? 'text-orange-500' : 'text-white'" 
                      class="text-sm font-bold uppercase tracking-widest transition-colors relative z-10 pr-4">
                    {{ $item->pertanyaan }}
                </span>

                <div class="flex-shrink-0 w-8 h-8 rounded-full border border-orange-500/30 flex items-center justify-center relative z-10 transition-all duration-300"
                     :class="activeFaq === {{ $item->id }} ? 'bg-orange-500 border-orange-500' : ''">
                    <svg :class="activeFaq === {{ $item->id }} ? 'rotate-180 text-black' : 'text-orange-500'" 
                         class="h-4 w-4 transition-all duration-300" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>

            <div x-show="activeFaq === {{ $item->id }}" 
                 x-collapse 
                 x-cloak
                 class="px-6 pb-8">
                <div class="border-t border-orange-900/20 pt-6">
                    <p class="text-slate-400 text-xs font-medium leading-relaxed relative z-10">
                        {{ $item->jawaban }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-10 border border-dashed border-white/10 rounded-[1.5rem]">
            <p class="text-slate-500 italic text-xs uppercase tracking-widest">Belum ada data FAQ tersedia.</p>
        </div>
        @endforelse
    </div>

    {{-- CTA Box --}}
    <div class="mt-12 p-8 rounded-[2rem] bg-gradient-to-r from-orange-500 to-orange-600 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-orange-500/30 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
        <p class="text-black font-black text-xs uppercase tracking-wider relative z-10">Butuh bantuan konsultasi project Anda?</p>
        <a href="{{ route('frontend.contact') }}" class="px-8 py-3 bg-black text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 transition-transform shadow-xl relative z-10">Hubungi Kami</a>
    </div>
</div>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
</style>