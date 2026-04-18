@extends('pages.frontend.index') 

@section('content')
<section class="py-32 px-6 lg:px-20 bg-[#0a0a0a] min-h-screen relative overflow-hidden font-['Poppins']">
    
    {{-- Background Lines Decor --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 H500 L580 20 H1340 L1420 100 H1920" stroke="#F97316" stroke-width="3"/>
            <path d="M40 120 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Tombol Kembali --}}
        <div class="mb-12 pt-10">
            <a href="{{ url('/') }}#portfolio" class="inline-flex items-center gap-3 text-orange-500 font-black uppercase text-sm tracking-[0.3em] group hover:text-white transition-all">
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
                    
                    @php
                        $imgPath = ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) 
                                   ? asset('storage/' . $portofolio->gambar) 
                                   : (str_contains($portofolio->gambar, 'http') ? $portofolio->gambar : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015");
                    @endphp
                    
                    <img src="{{ $imgPath }}" 
                         alt="{{ $portofolio->judul }}" 
                         class="w-full h-auto object-cover min-h-[400px]">
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
                    <div class="text-slate-400 leading-relaxed font-medium text-lg">
                        {!! nl2br(e($portofolio->deskripsi)) !!}
                    </div>
                </div>

                {{-- TOMBOL LINK --}}
                @if($portofolio->url)
                <div class="pt-6">
                    <a href="{{ str_contains($portofolio->url, 'http') ? $portofolio->url : 'https://' . $portofolio->url }}" 
                       target="_blank" 
                       class="inline-block bg-orange-500 text-black px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] hover:bg-white hover:scale-105 transition-all shadow-xl shadow-orange-500/20">
                        Kunjungi Website
                    </a>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-6 pt-10 border-t border-white/5">
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Kategori</p>
                        <p class="text-white font-bold uppercase text-sm">IT Solution</p>
                    </div>
                    <div>
                        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Tahun Project</p>
                        <p class="text-white font-bold">
                            {{ $portofolio->created_at ? $portofolio->created_at->format('Y') : '2026' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION: PROJECT LAINNYA --}}
        <div class="mt-32 pt-20 border-t border-white/10">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-xl font-black text-white uppercase tracking-[0.3em]">Project Lainnya</h3>
                <div class="h-px flex-1 bg-white/10 ml-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- FIX: Pastikan parameter ID dimasukkan ke route detail --}}
                @forelse($portofolios->where('id', '!=', $portofolio->id)->take(3) as $other)
                    <article class="group">
                        {{-- DISINI ERROR TADI: Ditambahkan $other->id --}}
                        <a href="{{ route('frontend.portofolio.detail', $other->id) }}" class="block">
                            <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-[#111] border border-white/5 mb-6">
                                @php
                                    $otherImg = ($other->gambar && Storage::disk('public')->exists($other->gambar)) 
                                                ? asset('storage/' . $other->gambar) 
                                                : (str_contains($other->gambar, 'http') ? $other->gambar : "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015");
                                @endphp
                                <img src="{{ $otherImg }}" 
                                     class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700"
                                     alt="{{ $other->judul }}">
                            </div>
                            <div class="space-y-2 px-2">
                                <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Next Project</span>
                                <h4 class="text-white font-bold group-hover:text-orange-500 transition-colors uppercase leading-tight">
                                    {{ $other->judul }}
                                </h4>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full py-20 text-center border-2 border-dashed border-white/5 rounded-[3rem]">
                        <p class="text-slate-500 uppercase tracking-[0.3em] text-xs font-black">Belum ada project lain yang dipublish.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection