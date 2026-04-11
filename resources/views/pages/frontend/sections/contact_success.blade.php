@extends('layouts.frontend')

@section('content')
{{-- Section Utama dengan Background Gelap --}}
<section class="pt-32 pb-24 px-6 lg:px-20 bg-[#0a0a0a] min-h-screen relative overflow-hidden font-['Poppins'] flex items-center justify-center">
    
    {{-- 1. BACKGROUND DECOR (Garis Full-Width & Border Zigzag - Sesuai Halaman Lain) --}}
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            {{-- Garis Atas Full-Width --}}
            <path d="M0 60 H800 L860 20 H1060 L1120 60 H1920" stroke="#F97316" stroke-width="2"/>
            
            {{-- Garis Bawah Full-Width --}}
            <path d="M0 1020 H800 L860 1060 H1060 L1120 1020 H1920" stroke="#F97316" stroke-width="2"/>
            
            {{-- Garis Kiri Zigzag (Menghubungkan Atas & Bawah) --}}
            <path d="M60 60 V400 L120 460 V750 L60 810 V1020" stroke="#F97316" stroke-width="2"/>
            
            {{-- Garis Kanan Zigzag (Menghubungkan Atas & Bawah) --}}
            <path d="M1860 60 V400 L1800 460 V750 L1860 810 V1020" stroke="#F97316" stroke-width="2"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        {{-- Card Sukses --}}
        <div class="max-w-xl mx-auto bg-[#111] border border-white/5 p-12 lg:p-16 rounded-[3rem] shadow-2xl relative overflow-hidden text-center group">
            
            {{-- Aksen Cahaya Orange di dalam Card --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-500/10 rounded-full blur-3xl group-hover:bg-orange-500/20 transition-all"></div>
            
            <div class="relative z-10">
                {{-- Icon Check dengan Shadow Glow --}}
                <div class="w-24 h-24 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-10 shadow-[0_0_40px_-10px_rgba(249,115,22,0.5)] transform -rotate-6 group-hover:rotate-0 transition-transform duration-500">
                    <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                {{-- Judul Pesan --}}
                <h2 class="text-3xl lg:text-4xl font-black text-white uppercase tracking-tighter mb-6 leading-tight">
                    Pesan <span class="text-orange-500 font-black italic">Berhasil</span><br>Dikirim!
                </h2>
                
                {{-- Deskripsi --}}
                <p class="text-slate-400 font-medium leading-relaxed mb-12 text-lg">
                    Terima kasih sudah menghubungi kami.<br>
                    Tim kami akan segera membalas melalui email yang Anda daftarkan.
                </p>

                {{-- Tombol Kembali --}}
                <a href="{{ route('home') }}" class="inline-block w-full bg-orange-600 hover:bg-orange-500 text-black font-black uppercase py-5 rounded-2xl transition-all tracking-[0.2em] text-[11px] shadow-xl shadow-orange-600/20 active:scale-95">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>
</section>
@endsection