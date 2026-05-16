@extends('pages.frontend.index') 

@section('content')
<section class="pt-64 pb-24 px-6 lg:px-20 bg-[#0a0a0a] relative overflow-hidden font-['Poppins'] min-h-screen flex flex-col">
    
    {{-- BACKGROUND FRAME --}}
     {{-- DEKORASI GARIS BACKGROUND --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30 flex flex-col">
        
        {{-- 1. BAGIAN ATAS --}}
        <div class="w-full h-[800px] shrink-0 pt-20"> 
            <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 800" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                    <path d="M0 100 H550 L630 20 H1290 L1370 100 H1920" opacity="0.6"/>
                    <path d="M15 100 V450 L45 480 V600 L15 630 V800" opacity="0.6" />
                    <path d="M1905 100 V450 L1875 480 V600 L1905 630 V800" opacity="0.6" />
                </g>
            </svg>
            <div class="lg:hidden w-full h-[80px] pt-5">
                <svg class="w-full h-full" viewBox="0 0 400 80" preserveAspectRatio="none" fill="none">
                    <path d="M0 60 H120 L150 20 H250 L280 60 H400" stroke="#F97316" stroke-width="2" opacity="0.5"/>
                </svg>
            </div>
        </div>

        {{-- 2. BAGIAN TENGAH --}}
        <div class="w-full flex-1">
            <svg class="w-full h-full" viewBox="0 0 1920 100" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                    <path d="M15 0 V100" opacity="0.6" class="hidden lg:block"/>
                    <path d="M1905 0 V100" opacity="0.6" class="hidden lg:block"/>
                    {{-- Garis samping tipis untuk mobile agar tetap ada bingkainya --}}
                    <path d="M5 0 V100" stroke-width="1" opacity="0.3" class="lg:hidden"/>
                    <path d="M395 0 V100" stroke-width="1" opacity="0.3" class="lg:hidden"/>
                </g>
            </svg>
        </div>

        {{-- 3. BAGIAN BAWAH --}}
        <div class="w-full h-[200px] shrink-0">
            {{-- Desktop --}}
            <svg class="hidden lg:block w-full h-full" viewBox="0 0 1920 200" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g stroke="#F97316" stroke-width="2" vector-effect="non-scaling-stroke">
                    <path d="M15 0 V50" opacity="0.6" />
                    <path d="M1905 0 V50" opacity="0.6" />
                    <path d="M0 50 H550 L630 130 H1290 L1370 50 H1920" opacity="0.6"/>
                </g>
            </svg>
            {{-- PERBAIKAN: Mobile Bawah --}}
            <div class="lg:hidden w-full h-[100px]">
                <svg class="w-full h-full" viewBox="0 0 400 100" preserveAspectRatio="none" fill="none">
                    <g stroke="#F97316" stroke-width="2" opacity="0.5">
                        <path d="M5 0 V40" />
                        <path d="M395 0 V40" />
                        <path d="M0 40 H120 L150 80 H250 L280 40 H400" />
                    </g>
                </svg>
            </div>
        </div>
    </div>

    <div class="container mx-auto relative z-10 flex-grow">
        {{-- Tombol Kembali --}}
        <div class="mb-16">
            <a href="{{ url('/frontend/portofolio') }}" class="inline-flex items-center gap-3 text-orange-500 font-black uppercase text-xs tracking-[0.4em] group hover:text-white transition-all">
                <span class="group-hover:-translate-x-2 transition-transform">←</span> KEMBALI KE DAFTAR PORTOFOLIO
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