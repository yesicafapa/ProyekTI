@extends('layouts.frontend')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen font-['Poppins'] text-white relative flex flex-col">
    
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

    {{-- KONTEN UTAMA --}}
    <div class="container mx-auto relative z-10 max-w-4xl px-8 lg:px-0 pt-48 pb-32">
        <div class="mb-12">
            <a href="{{ route('frontend.blog.index') }}" class="inline-flex items-center gap-3 text-orange-500 hover:text-white transition-all group mb-8">
                <span class="group-hover:-translate-x-2 transition-transform text-lg">←</span>
                <span class="text-[11px] font-black uppercase tracking-[0.3em]">Kembali Ke Artikel</span>
            </a>
            <h2 class="text-4xl md:text-5xl font-black tracking-[0.1em] text-white uppercase mb-4">Detail Artikel</h2>
            <div class="h-1.5 w-24 bg-orange-500"></div>
        </div>

        <div class="mb-10">
            <div class="flex items-center gap-4 text-[10px] font-bold uppercase tracking-[0.2em] mb-8">
                <span class="bg-orange-500 text-black px-3 py-1 rounded-sm italic font-black">Tech Insight</span>
                <span class="text-slate-500">{{ $artikel->created_at->format('M d, Y') }}</span>
            </div>

            <h1 class="text-3xl md:text-6xl font-black text-white uppercase leading-tight mb-12 tracking-tight">
                {{ $artikel->judul }}
            </h1>

            <div class="relative aspect-video w-full overflow-hidden rounded-[2rem] bg-[#111] border border-white/5 shadow-2xl mb-16">
                <img src="{{ ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) ? asset('storage/' . $artikel->thumbnail) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070' }}" 
                     class="w-full h-full object-cover opacity-90" alt="{{ $artikel->judul }}">
            </div>

            <div class="prose prose-invert prose-orange max-w-none text-slate-300 text-lg leading-relaxed mb-20 whitespace-pre-line">
                {!! $artikel->isi !!}
            </div>

            {{-- Related --}}
            <div class="pt-16 border-t border-white/10">
                <h3 class="text-xl font-black text-white uppercase tracking-widest mb-10">More Insights</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-10">
                    @foreach($artikels->where('id', '!=', $artikel->id)->take(2) as $related)
                    <a href="{{ route('frontend.blog.detail', $related->id) }}" class="group block">
                        <div class="relative aspect-video rounded-2xl overflow-hidden bg-zinc-900 mb-4 border border-white/5">
                            <img src="{{ asset('storage/'.$related->thumbnail) }}" class="w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-all duration-500">
                        </div>
                        <h4 class="text-sm font-bold uppercase text-white group-hover:text-orange-500 transition-colors">{{ $related->judul }}</h4>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection