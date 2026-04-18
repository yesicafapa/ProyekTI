@extends('pages.frontend.index') 

@section('content')
<section class="py-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins'] min-h-screen">
    
    {{-- 1. DEKORASI GARIS (SVG) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            <path d="M1880 120 V300 L1820 360 V750 L1880 810 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Header Page --}}
        <div class="mb-20 pt-24">
            <a href="{{ url('/') }}" class="text-orange-500 text-xs font-black uppercase tracking-[0.4em] hover:text-white transition-all duration-300 inline-flex items-center gap-2 group">
                <span class="group-hover:-translate-x-2 transition-transform">←</span> KEMBALI KE BERANDA
            </a>
            <div class="mt-8">
                <h2 class="text-2xl font-black tracking-[0.5em] text-white uppercase mb-4">Daftar Portofolio</h2>
                <div class="h-1.5 w-28 bg-orange-500"></div>
            </div>
        </div>

        {{-- Grid Portofolio --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @forelse($portofolios as $item)
                <div class="group bg-[#1a110a]/40 backdrop-blur-md rounded-[2.5rem] p-8 border border-white/5 shadow-2xl hover:border-orange-500/30 transition-all duration-500">
                    
                    {{-- Thumbnail --}}
                    <div class="block rounded-[2rem] overflow-hidden border border-orange-900/20 mb-6 aspect-video bg-black shadow-lg">
                        @php
                            $imgPath = ($item->gambar && Storage::disk('public')->exists($item->gambar)) 
                                       ? asset('storage/' . $item->gambar) 
                                       : (str_contains($item->gambar, 'http') ? $item->gambar : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015");
                        @endphp
                        <img src="{{ $imgPath }}" 
                             class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700" 
                             alt="{{ $item->judul }}">
                    </div>

                    <div class="px-2 space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Project Showcase</span>
                            <span class="h-px w-12 bg-white/20"></span>
                        </div>

                        <h3 class="text-3xl font-bold text-white group-hover:text-orange-500 transition-colors uppercase tracking-tight">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-slate-400 text-sm leading-relaxed font-medium line-clamp-3">
                            {{ $item->deskripsi }}
                        </p>

                        <div class="pt-4">
                            {{-- FIX: GANTI $item->slug MENJADI $item->id --}}
                            <a href="{{ route('frontend.portofolio.detail', $item->id) }}" class="text-orange-500 text-[10px] font-bold uppercase tracking-widest hover:text-white transition-colors flex items-center gap-2">
                                DETAIL PROJECT <span class="group-hover:translate-x-2 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 opacity-30 uppercase tracking-[0.5em] text-white">
                    Data portofolio belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection