@extends('layouts.frontend')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen pt-20">
    <section class="relative py-24 px-6 lg:px-20 overflow-hidden font-['Poppins']">
        
        
        <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
            <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none">
                {{-- Garis Utama - Nilai Y diubah dari 80 ke 40 agar lebih naik --}}
                <path d="M0 40 H500 L580 10 H1340 L1420 70 H1920" stroke="#F97316" stroke-width="3" opacity="0.4"/>
                {{-- Garis dekorasi samping --}}
                <path d="M40 80 V400 L100 460 V700 L40 760 V960" stroke="#F97316" stroke-width="2.5" opacity="0.3"/>
            </svg>
        </div>

        <div class="container mx-auto relative z-10">
            
            {{-- TOMBOL KEMBALI --}}
            <div class="mb-12">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-orange-500 hover:text-white transition-colors group">
                    <span class="text-lg group-hover:-translate-x-2 transition-transform">←</span>
                    <span class="text-[11px] font-black uppercase tracking-[0.3em]">Kembali Ke Beranda</span>
                </a>
            </div>

            {{-- 2. HEADER: DETAIL BLOG --}}
            <div class="mb-16">
                <h2 class="text-4xl font-black tracking-[0.2em] text-white uppercase mb-4">Detail Blog</h2>
                <div class="h-1.5 w-32 bg-orange-500"></div>
            </div>

            <div class="max-w-5xl mx-auto">
                {{-- KONTEN UTAMA ARTIKEL --}}
                <div class="mb-24">
                    <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.3em] text-orange-500 mb-6">
                        <span>News</span>
                        <span class="text-white/20">/</span>
                        <span class="text-slate-400">{{ $artikel->created_at->format('M d, Y') }}</span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-black text-white uppercase leading-[1.1] mb-10 tracking-tighter">
                        {{ $artikel->judul }}
                    </h1>

                    {{-- Gambar Utama --}}
                    <div class="relative aspect-video w-full overflow-hidden rounded-[3rem] bg-[#111] border border-white/5 shadow-2xl mb-12">
                        @php
                            $mainImg = ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) 
                                    ? asset('storage/' . $artikel->thumbnail) 
                                    : "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070";
                        @endphp
                        <img src="{{ $mainImg }}" 
                             class="w-full h-full object-cover" 
                             alt="{{ $artikel->judul }}">
                    </div>

                    {{-- Isi Artikel Utama --}}
                    <div class="prose prose-invert prose-orange max-w-none text-slate-300 text-lg leading-relaxed font-medium mb-12">
                        {!! $artikel->konten !!}
                    </div>

                    
                    <div class="space-y-8 text-slate-400 text-lg leading-relaxed border-l-2 border-orange-500/30 pl-8">
                        <p>
                            Dalam era transformasi digital yang berkembang pesat, pemahaman mendalam mengenai integrasi teknologi bukan lagi sekadar pilihan, melainkan kebutuhan fundamental bagi setiap bisnis. Implementasi strategi yang tepat dalam pengembangan ekosistem digital dapat memberikan keunggulan kompetitif yang signifikan, memungkinkan skalabilitas yang lebih efisien serta pengalaman pengguna yang lebih intuitif dan responsif terhadap perubahan pasar global.
                        </p>
                        <p>
                            Lebih lanjut, sinergi antara inovasi kreatif dan stabilitas infrastruktur teknologi menjadi kunci utama dalam membangun solusi berkelanjutan. Kami percaya bahwa setiap detail dalam pengembangan, mulai dari optimasi performa hingga keamanan data, berkontribusi pada kesuksesan jangka panjang. Melalui analisis yang komprehensif dan dedikasi terhadap standar kualitas tinggi, Seov Detech berkomitmen untuk terus menghadirkan wawasan yang relevan bagi kemajuan industri teknologi di Indonesia.
                        </p>
                    </div>
                </div>

                {{-- 3. ARTIKEL TERKAIT --}}
                <div class="pt-20 border-t border-white/10">
                    <div class="flex items-center justify-between mb-12">
                        <h3 class="text-xl font-black text-white uppercase tracking-[0.3em]">More Insights</h3>
                        <div class="h-px flex-1 bg-white/10 ml-8"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @if(isset($artikels) && $artikels->count() > 0)
                            @foreach($artikels as $related)
                            <article class="group">
                                <a href="{{ route('frontend.blog.detail', $related->slug) }}" class="block">
                                    <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-[#111] border border-white/5 mb-6">
                                        @php
                                            $relImg = ($related->thumbnail && Storage::disk('public')->exists($related->thumbnail)) 
                                                    ? asset('storage/' . $related->thumbnail) 
                                                    : "https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070";
                                        @endphp
                                        <img src="{{ $relImg }}" 
                                             class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700">
                                    </div>
                                    <div class="space-y-2 px-2">
                                        <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Related Post</span>
                                        <h4 class="text-white font-bold group-hover:text-orange-500 transition-colors uppercase leading-tight">
                                            {{ $related->judul }}
                                        </h4>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        @else
                            @for($i = 1; $i <= 3; $i++)
                            <div class="opacity-20">
                                <div class="aspect-video bg-white/5 rounded-[2rem] mb-4"></div>
                                <div class="h-4 w-3/4 bg-white/10 rounded"></div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection