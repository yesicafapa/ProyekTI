@extends('pages.frontend.index') 

@section('content')
<section class="pt-56 pb-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins'] min-h-screen">
    
    {{-- BACKGROUND FRAME --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
        {{-- Desktop Version --}}
        <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                <path d="M0 180 H550 L630 100 H1290 L1370 180 H1920" opacity="0.6"/>
                <path d="M15 180 V450 L45 480 V600 L15 630 V980" opacity="0.6" />
                <path d="M1905 180 V450 L1875 480 V600 L1905 630 V980" opacity="0.6" />
                <path d="M0 980 H550 L630 1060 H1290 L1370 980 H1920" opacity="0.6"/>
            </g>
        </svg>

        {{-- Mobile Version --}}
        {{-- ATAS --}}
        <div class="absolute top-28 left-0 right-0 lg:hidden z-10">
            <svg class="w-full h-[80px]" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                <path d="M0 60 H120 L150 20 H250 L280 60 H400" stroke="#F97316" stroke-width="2" opacity="0.5"/>
            </svg>
        </div>

        {{-- BAWAH --}}
        <div class="absolute bottom-10 left-0 right-0 lg:hidden z-10">
            <svg class="w-full h-[80px]" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                <path d="M0 20 H120 L150 60 H250 L280 20 H400" stroke="#F97316" stroke-width="2" opacity="0.5"/>
            </svg>
        </div>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="mb-20">
            <a href="{{ url('/') }}" class="text-orange-500 text-xs font-black uppercase tracking-[0.4em] hover:text-white transition-all duration-300 inline-flex items-center gap-2 group">
                <span class="group-hover:-translate-x-2 transition-transform">←</span> KEMBALI KE BERANDA
            </a>
            <div class="mt-8">
                <h2 class="text-2xl font-black tracking-[0.5em] text-white uppercase mb-4">Daftar Portofolio</h2>
                <div class="h-1.5 w-28 bg-orange-500"></div>
            </div>
        </div>

        {{-- Scroll Area --}}
        <div class="flex flex-nowrap overflow-x-auto gap-8 pb-12 mb-12 snap-x snap-mandatory scrollbar-custom">
            @forelse($portofolios->where('status', 1) as $item)
                <div class="group flex-none w-[85%] md:w-[45%] lg:w-[31%] snap-center bg-[#1a110a]/40 backdrop-blur-md rounded-[2.5rem] p-8 border border-white/5 shadow-2xl hover:border-orange-500/30 transition-all duration-500">
                    
                    {{-- 1. LINK PADA GAMBAR --}}
                    <a href="{{ route('frontend.portofolio.detail', $item->id) }}" class="block mb-6 overflow-hidden rounded-[2rem] border border-orange-900/20 bg-black shadow-lg">
                        @php
                            $imgPath = ($item->gambar && Storage::disk('public')->exists($item->gambar)) 
                                        ? asset('storage/' . $item->gambar) 
                                        : (str_contains($item->gambar, 'http') ? $item->gambar : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015");
                        @endphp
                        <img src="{{ $imgPath }}" class="w-full h-full aspect-video object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700" alt="{{ $item->judul }}">
                    </a>

                    <div class="px-2 space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Project Showcase</span>
                            <span class="h-px w-12 bg-white/20"></span>
                        </div>

                        {{-- 2. LINK PADA JUDUL --}}
                        <a href="{{ route('frontend.portofolio.detail', $item->id) }}" class="block">
                            <h3 class="text-2xl font-bold text-white group-hover:text-orange-500 transition-colors uppercase tracking-tight line-clamp-1">
                                {{ $item->judul }}
                            </h3>
                        </a>

                        <p class="text-slate-400 text-sm leading-relaxed font-medium line-clamp-3">
                            {{ $item->deskripsi }}
                        </p>

                        <div class="pt-4">
                            <a href="{{ route('frontend.portofolio.detail', $item->id) }}" class="text-orange-500 text-[10px] font-bold uppercase tracking-widest hover:text-white transition-colors flex items-center gap-2">
                                DETAIL PROJECT <span class="group-hover:translate-x-2 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-20 opacity-30 uppercase tracking-[0.5em] text-white">Data portofolio belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .scrollbar-custom::-webkit-scrollbar { height: 6px; }
    .scrollbar-custom::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.05); border-radius: 10px; margin-inline: 10%; }
    .scrollbar-custom::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
    .scrollbar-custom { scrollbar-width: thin; scrollbar-color: #F97316 rgba(255, 255, 255, 0.05); }
</style>
@endsection