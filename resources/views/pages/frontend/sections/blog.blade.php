@extends('layouts.frontend')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen font-['Poppins'] text-white pt-20">
    {{-- SECTION DENGAN TINGGI LEBIH LUAS --}}
    <section class="relative h-[165vh] py-10 px-6 lg:px-20 overflow-hidden">
        {{-- Dekorasi Garis Background --}}
        <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
            <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                    {{-- GARIS BAGIAN ATAS --}}
                    <path d="M0 100 H550 L630 20 H1290 L1370 100 H1920" opacity="0.6"/>
                    {{-- GARIS BAGIAN KIRI --}}
                    <path d="M15 100 V450 L45 480 V600 L15 630 V980" opacity="0.6" />
                    {{-- GARIS BAGIAN KANAN --}}
                    <path d="M1905 100 V450 L1875 480 V600 L1905 630 V980" opacity="0.6" />
                    {{-- GARIS BAGIAN BAWAH --}}
                    <path d="M0 980 H550 L630 1060 H1290 L1370 980 H1920" opacity="0.6"/>
                </g>
            </svg>
            {{-- MOBILE --}}
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

        <div class="container mx-auto relative z-10 max-w-4xl h-full flex flex-col">
            
            {{-- 2. Container --}}
            <div class="container mx-auto relative z-10 max-w-4xl h-full flex flex-col pt-8"> {{-- Tambah pt-8 di sini --}}
                
                {{-- Header --}}
                <div class="shrink-0 mb-8 mt-6"> 
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-orange-500 hover:text-white transition-colors group mb-6">
                        <span class="text-lg group-hover:-translate-x-2 transition-transform">←</span>
                        <span class="text-[11px] font-black uppercase tracking-[0.3em]">Kembali Ke Beranda</span>
                    </a>
                    <h2 class="text-3xl font-black tracking-[0.2em] text-white uppercase mb-4">Artikel</h2>
                <div class="h-1.5 w-20 bg-orange-500"></div>
            </div>

            {{-- AREA SCROLL  --}}
            <div class="h-[700px] overflow-y-auto pr-4 custom-scrollbar space-y-12 mb-10" style="scrollbar-gutter: stable;">
                
                @forelse($artikels as $artikel)
                <article class="group relative">
                    <a href="{{ route('frontend.blog.detail', $artikel->slug ?? $artikel->id) }}" class="flex flex-col md:flex-row gap-8 items-start">
                        
                        <div class="relative w-full md:w-52 shrink-0 aspect-video md:aspect-square overflow-hidden rounded-3xl bg-[#111] border border-white/5 shadow-xl">
                            @php
                                $img = ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) 
                                        ? asset('storage/' . $artikel->thumbnail) 
                                        : "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070";
                            @endphp
                            <img src="{{ $img }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700 opacity-70 group-hover:opacity-100" 
                                 alt="{{ $artikel->judul }}">
                        </div>

                        <div class="flex-1 space-y-4 pt-2">
                            <div class="flex items-center gap-3 text-[9px] font-bold uppercase tracking-widest text-slate-500">
                                <span class="text-orange-500">Insights</span>
                                <span>/</span>
                                <span>{{ $artikel->created_at ? $artikel->created_at->format('M d, Y') : date('M d, Y') }}</span>
                            </div>
                            
                            <h4 class="text-2xl font-bold text-white leading-tight group-hover:text-orange-500 transition-colors uppercase">
                                {{ $artikel->judul }}
                            </h4>
                            
                            <p class="text-sm text-slate-400 font-medium line-clamp-2 leading-relaxed opacity-80">
                                {{ $artikel->ringkasan ?? Str::limit(strip_tags($artikel->konten), 130) }}
                            </p>
                            
                            <div class="pt-2 flex items-center text-[10px] font-black uppercase text-orange-500 tracking-widest transition-all group-hover:gap-4">
                                Read More <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                            </div>
                        </div>
                    </a>
                </article>
                @empty
                <div class="text-center py-20 opacity-20 uppercase tracking-[0.5em]">Belum ada artikel.</div>
                @endforelse

            </div>
        </div>
    </section>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
</style>
@endsection