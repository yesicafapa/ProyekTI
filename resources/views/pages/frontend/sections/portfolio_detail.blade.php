@extends('pages.frontend.index') 

@section('content')
<section class="py-32 px-6 lg:px-20 bg-[#0a0a0a] min-h-screen relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines Decor (High-Tech Frame) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Tombol Kembali - Dibuat lebih besar & turun sedikit (pt-10) agar seragam --}}
        <div class="mb-12 pt-10">
            <a href="{{ route('frontend.portofolio.index') }}" class="inline-flex items-center gap-3 text-orange-500 font-black uppercase text-sm tracking-[0.3em] group hover:text-white transition-all">
                <svg class="w-5 h-5 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Portofolio
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            {{-- KOLOM KIRI: GAMBAR PROYEK --}}
            <div class="lg:col-span-7">
                <div class="relative group rounded-[3rem] overflow-hidden border border-white/10 bg-[#111] shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent opacity-40"></div>
                    
                    {{-- Logika Gambar: Support Link Unsplash (HTTP) & Local Assets --}}
                    <img src="{{ str_contains($portofolio->gambar, 'http') ? $portofolio->gambar : asset($portofolio->gambar) }}" 
                         alt="{{ $portofolio->judul }}" 
                         class="w-full h-auto object-cover">
                </div>
            </div>

            {{-- KOLOM KANAN: INFO DETAIL --}}
            <div class="lg:col-span-5 space-y-10">
                <div>
                    <h4 class="text-orange-500 font-black uppercase tracking-[0.4em] text-[11px] mb-4">Project Detail</h4>
                    <h1 class="text-5xl lg:text-6xl font-black text-white uppercase tracking-tighter leading-none mb-6">
                        {{ $portofolio->judul }}
                    </h1>
                    <div class="h-1.5 w-24 bg-orange-500"></div>
                </div>

                <div class="space-y-6">
                    <h5 class="text-white font-bold uppercase tracking-widest text-sm">Deskripsi Proyek</h5>
                    <p class="text-slate-400 leading-relaxed font-medium text-lg">
                        {{ $portofolio->deskripsi }}
                    </p>
                </div>

                @if($portofolio->link && $portofolio->link != '#')
                <div class="pt-6">
                    <a href="{{ $portofolio->link }}" target="_blank" 
                       class="inline-block bg-orange-500 text-black px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] hover:bg-white hover:scale-105 transition-all shadow-xl shadow-orange-500/20">
                        Kunjungi Website
                    </a>
                </div>
                @endif

                {{-- Info Tambahan --}}
                <div class="grid grid-cols-2 gap-6 pt-10 border-t border-white/5">
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Kategori</p>
                        <p class="text-white font-bold">Web Development</p>
                    </div>
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Tahun</p>
                        <p class="text-white font-bold">
                            {{ isset($portofolio->created_at) ? \Carbon\Carbon::parse($portofolio->created_at)->format('Y') : '2026' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection