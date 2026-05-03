@extends('layouts.frontend')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen font-['Poppins'] text-white pt-20">
    <section class="relative py-24 px-6 lg:px-20 overflow-hidden">
        
        {{-- Dekorasi Garis Background --}}
        <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
            <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none">
                <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
                <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            </svg>
        </div>

        {{-- Container dikecilkan ke max-w-3xl agar lebih proporsional --}}
        <div class="container mx-auto relative z-10 max-w-3xl">
            
            {{-- TOMBOL KEMBALI --}}
            <div class="mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-orange-500 hover:text-white transition-colors group">
                    <span class="text-lg group-hover:-translate-x-2 transition-transform">←</span>
                    <span class="text-[11px] font-black uppercase tracking-[0.3em]">Kembali Ke Beranda</span>
                </a>
            </div>

            {{-- Judul ARTIKEL (Berubah dari Blog) --}}
            <div class="mb-12">
                <h2 class="text-3xl font-black tracking-[0.2em] text-white uppercase mb-4">Artikel</h2>
                <div class="h-1.5 w-20 bg-orange-500"></div>
            </div>

            {{-- Container Scroll --}}
            <div class="h-[700px] overflow-y-auto pr-4 custom-scrollbar space-y-10" style="scrollbar-gutter: stable;">
                
                @forelse($artikels as $artikel)
                <article class="group relative">
                    <a href="{{ route('frontend.blog.detail', $artikel->slug ?? $artikel->id) }}" class="flex flex-col md:flex-row gap-6 items-start">
                        
                        {{-- Frame Gambar (Dikecilkan ukurannya) --}}
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

                        {{-- Teks Konten --}}
                        <div class="flex-1 space-y-3 pt-2">
                            <div class="flex items-center gap-3 text-[9px] font-bold uppercase tracking-widest">
                                <span class="text-orange-500">Tech Update</span>
                                <span class="text-slate-600">/</span>
                                <span class="text-slate-500">{{ $artikel->created_at ? $artikel->created_at->format('M d, Y') : date('M d, Y') }}</span>
                            </div>
                            
                            <h4 class="text-xl font-bold text-white leading-tight group-hover:text-orange-500 transition-colors uppercase">
                                {{ $artikel->judul }}
                            </h4>
                            
                            <p class="text-sm text-slate-400 font-medium line-clamp-2 leading-relaxed opacity-80">
                                {{ $artikel->ringkasan ?? Str::limit(strip_tags($artikel->konten), 120) }}
                            </p>
                            
                            <div class="pt-2 flex items-center text-[9px] font-black uppercase text-orange-500 tracking-widest transition-all group-hover:gap-4">
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
    /* Scrollbar Oranye Tipis */
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
</style>
@endsection