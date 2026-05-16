@extends('pages.frontend.index') 

@section('content')
<section class="pt-64 pb-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins'] min-h-screen flex flex-col">
    
    {{-- BACKGROUND FRAME --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
        {{-- Desktop Version --}}
        <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                {{-- Garis Atas --}}
                <path d="M0 200 H550 L630 120 H1290 L1370 200 H1920" opacity="0.6"/>
                
                {{-- Garis Samping --}}
                <path d="M15 200 V450 L45 480 V600 L15 630 V1000" opacity="0.6" />
                <path d="M1905 200 V450 L1875 480 V600 L1905 630 V1000" opacity="0.6" />

                {{-- Garis Bawah --}}
                <path d="M0 1000 H550 L630 1060 H1290 L1370 1000 H1920" opacity="0.6"/>
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

    <div class="container mx-auto relative z-10 flex-grow">
        {{-- Tombol Kembali --}}
        <div class="mb-16">
            <a href="{{ route('frontend.portofolio.index') }}" class="inline-flex items-center gap-3 text-orange-500 font-black uppercase text-xs tracking-[0.4em] group hover:text-white transition-all">
                <span class="group-hover:-translate-x-2 transition-transform">←</span> KEMBALI KE PORTOFOLIO
            </a>
            <div class="mt-8">
                <h2 class="text-2xl font-black tracking-[0.5em] text-white uppercase mb-4">Project Detail</h2>
                <div class="h-1.5 w-28 bg-orange-500"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start pb-20">
            {{-- KOLOM KIRI: GAMBAR --}}
            <div class="lg:col-span-7">
                <div class="relative group rounded-[2.5rem] overflow-hidden border border-white/5 bg-[#1a110a]/40 backdrop-blur-md p-4 shadow-2xl">
                    <div class="rounded-[2rem] overflow-hidden border border-orange-900/20 bg-black">
                        @php
                            $imgPath = ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) 
                                        ? asset('storage/' . $portofolio->gambar) 
                                        : (str_contains($portofolio->gambar, 'http') ? $portofolio->gambar : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015");
                        @endphp
                        <img src="{{ $imgPath }}" alt="{{ $portofolio->judul }}" class="w-full h-auto object-cover opacity-90">
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: INFO --}}
            <div class="lg:col-span-5 space-y-10">
                <div class="px-2">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Digital Solutions</span>
                        <span class="h-px w-12 bg-white/20"></span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-black text-white uppercase tracking-tighter leading-tight">
                        {{ $portofolio->judul }}
                    </h1>
                </div>

                <div class="px-2 space-y-6">
                    <h5 class="text-white font-bold uppercase tracking-widest text-sm">Deskripsi Proyek</h5>
                    <div class="text-slate-400 leading-relaxed font-medium text-lg">
                        {!! nl2br(e($portofolio->deskripsi)) !!}
                    </div>
                </div>

                {{-- Link Website --}}
                @if($portofolio->url)
                <div class="pt-6 px-2">
                    <a href="{{ str_contains($portofolio->url, 'http') ? $portofolio->url : 'https://' . $portofolio->url }}" 
                       target="_blank" 
                       class="inline-block bg-orange-500 text-black px-12 py-5 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] hover:bg-white hover:scale-105 transition-all shadow-xl shadow-orange-500/20">
                        Kunjungi Website
                    </a>
                </div>
                @endif

                {{-- Detail Meta --}}
                <div class="grid grid-cols-2 gap-6 pt-10 px-2 border-t border-white/5">
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Category</p>
                        <p class="text-white font-bold uppercase text-sm tracking-wider">IT Project</p>
                    </div>
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Year</p>
                        <p class="text-white font-bold">{{ $portofolio->created_at ? $portofolio->created_at->format('Y') : '2026' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Custom Scrollbar untuk Browser --}}
<style>
    body::-webkit-scrollbar { width: 8px; }
    body::-webkit-scrollbar-track { background: #0a0a0a; }
    body::-webkit-scrollbar-thumb { background: #F97316; border-radius: 10px; }
    body { scrollbar-width: thin; scrollbar-color: #F97316 #0a0a0a; }
</style>
@endsection