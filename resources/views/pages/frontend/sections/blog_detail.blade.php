@extends('layouts.frontend')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen pt-20">
    <section class="relative py-24 px-6 lg:px-20 overflow-hidden font-['Poppins']">
        
        {{-- DEKORASI BACKGROUND (Tetap) --}}
        <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
            <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none">
                <path d="M0 40 H500 L580 10 H1340 L1420 70 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
                <path d="M40 80 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            </svg>
        </div>

        <div class="container mx-auto relative z-10">
            
            {{-- 1. TOMBOL KEMBALI --}}
            <div class="mb-12">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-orange-500 hover:text-white transition-colors group">
                    <span class="text-lg group-hover:-translate-x-2 transition-transform">←</span>
                    <span class="text-[11px] font-black uppercase tracking-[0.3em]">Kembali Ke Beranda</span>
                </a>
            </div>

            {{-- 2. HEADER: DETAIL ARTIKEL --}}
            <div class="mb-16">
                <h2 class="text-4xl font-black tracking-[0.2em] text-white uppercase mb-4">Detail Artikel</h2>
                <div class="h-1.5 w-32 bg-orange-500"></div>
            </div>

            {{-- PEMBATAS LEBAR KONTEN (max-w-3xl adalah standar emas untuk keterbacaan artikel) --}}
            <div class="max-w-3xl mx-auto">
                
                <div class="mb-24">
                    {{-- Badge & Date --}}
                    <div class="flex items-center gap-4 text-[10px] font-bold uppercase tracking-[0.2em] mb-8">
                        <span class="bg-orange-500 text-black px-3 py-1 rounded-sm">Tech Insight</span>
                        <span class="text-slate-500">{{ $artikel->created_at->format('M d, Y') }}</span>
                    </div>

                    {{-- Judul Artikel: Dibuat lebih solid --}}
                    <h1 class="text-3xl md:text-5xl font-black text-white uppercase leading-tight mb-12 tracking-tight">
                        {{ $artikel->judul }}
                    </h1>

                    {{-- Gambar Utama: Aspect Ratio Cinematic (21:9) agar tidak memakan terlalu banyak ruang vertikal --}}
                    <div class="relative aspect-[21/9] w-full overflow-hidden rounded-3xl bg-[#111] border border-white/5 shadow-2xl mb-12">
                        @php
                            $mainImg = ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) 
                                    ? asset('storage/' . $artikel->thumbnail) 
                                    : "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070";
                        @endphp
                        <img src="{{ $mainImg }}" 
                             class="w-full h-full object-cover opacity-90" 
                             alt="{{ $artikel->judul }}">
                    </div>

                    {{-- Isi Artikel: Optimasi Tipografi --}}
                    <div class="prose prose-invert prose-orange max-w-none 
                            text-slate-300 text-base md:text-lg leading-relaxed 
                            font-medium mb-16 break-words
                            {{-- TAMBAHKAN CLASS DI BAWAH INI --}}
                            prose-p:mb-6 prose-p:leading-relaxed
                            prose-ul:list-disc prose-ul:ml-6 prose-ul:mb-6
                            prose-ol:list-decimal prose-ol:ml-6 prose-ol:mb-6
                            prose-li:mb-2
                            whitespace-pre-line"> {{-- Menjaga spasi/enter manual --}}
                        {!! $artikel->isi !!}
                    </div>

                    {{-- Border Dekoratif Bawah --}}
                    <div class="border-l-4 border-orange-500 pl-8 py-2 bg-white/5 rounded-r-xl">
                        <p class="text-slate-400 italic text-sm leading-relaxed">
                            Artikel ini diterbitkan oleh <span class="text-orange-500 font-bold uppercase">Seov Detech Team</span>. 
                            Dapatkan informasi teknologi terupdate setiap minggunya.
                        </p>
                    </div>
                </div>

                {{-- 3. ARTIKEL TERKAIT (Tetap di grid, tapi disesuaikan ukurannya agar tidak terlalu besar) --}}
                <div class="pt-20 border-t border-white/10">
                    <div class="flex items-center justify-between mb-12">
                        <h3 class="text-lg font-black text-white uppercase tracking-[0.3em]">More Insights</h3>
                        <div class="h-px flex-1 bg-white/10 ml-8"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($artikels->take(3) as $related)
                            <article class="group">
                                <a href="{{ route('frontend.blog.detail', $related->id) }}" class="block">
                                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-[#111] border border-white/5 mb-4">
                                        @php
                                            $relImg = ($related->thumbnail && Storage::disk('public')->exists($related->thumbnail)) 
                                                    ? asset('storage/' . $related->thumbnail) 
                                                    : "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070";
                                        @endphp
                                        <img src="{{ $relImg }}" 
                                             class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700"
                                             alt="{{ $related->judul }}">
                                    </div>
                                    <div class="px-1">
                                        <h4 class="text-xs font-bold text-white group-hover:text-orange-500 transition-colors uppercase leading-tight line-clamp-2">
                                            {{ $related->judul }}
                                        </h4>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <div class="text-slate-600 text-[10px] uppercase tracking-widest">No related posts.</div>
                        @endforelse
                    </div>
                </div>
            </div> {{-- End of max-w-3xl --}}
        </div>
    </section>
</div>
@endsection