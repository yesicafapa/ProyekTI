@extends('layouts.frontend')

@section('content')
{{-- Section Utama --}}
<section class="pt-32 pb-24 px-6 lg:px-20 bg-[#0a0a0a] min-h-screen relative overflow-hidden font-['Poppins']">
    
    {{-- 1. BACKGROUND DECOR --}}
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 1920 1080" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60 H800 L860 20 H1060 L1120 60 H1920" stroke="#F97316" stroke-width="2"/>
            <path d="M0 1020 H800 L860 1060 H1060 L1120 1020 H1920" stroke="#F97316" stroke-width="2"/>
            <path d="M60 60 V400 L120 460 V750 L60 810 V1020" stroke="#F97316" stroke-width="2"/>
            <path d="M1860 60 V400 L1800 460 V750 L1860 810 V1020" stroke="#F97316" stroke-width="2"/>
        </svg>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
            
            {{-- Header Section --}}
            <div class="text-center mb-16">
                <h2 class="text-base font-black tracking-[0.5em] text-white uppercase mb-4">Contact Us</h2>
                <div class="h-1.5 w-28 bg-orange-500 mx-auto mb-6"></div>
                <h1 class="text-4xl lg:text-6xl font-black text-white uppercase tracking-tighter leading-tight">
                    Mari Mulai Project <span class="text-orange-500">Hebat</span> Anda.
                </h1>
            </div>

            {{-- Form Card --}}
            <div class="bg-[#111] border border-white/5 p-8 lg:p-16 rounded-[3rem] shadow-2xl relative z-20">
                {{-- Pastikan Route Sesuai --}}
                <form action="{{ route('frontend.contact.send') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    {{-- Input Nama & Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-orange-500 text-[10px] font-black uppercase tracking-widest ml-4">Full Name</label>
                            {{-- FIX: name="name" diganti jadi name="nama" --}}
                            <input type="text" name="nama" required placeholder="Masukkan nama anda..." 
                                class="w-full bg-[#0a0a0a] border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-orange-500 transition-all font-medium placeholder:text-white/20">
                        </div>
                        <div class="space-y-3">
                            <label class="text-orange-500 text-[10px] font-black uppercase tracking-widest ml-4">Email Address</label>
                            <input type="email" name="email" required placeholder="example@mail.com" 
                                class="w-full bg-[#0a0a0a] border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-orange-500 transition-all font-medium placeholder:text-white/20">
                        </div>
                    </div>

                    {{-- Input Telepon & Alamat --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-orange-500 text-[10px] font-black uppercase tracking-widest ml-4">Phone Number / WA</label>
                            {{-- FIX: name="phone" diganti jadi name="telepon" --}}
                            <input type="text" name="telepon" required placeholder="0812xxxxxxx" 
                                class="w-full bg-[#0a0a0a] border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-orange-500 transition-all font-medium placeholder:text-white/20">
                        </div>
                        <div class="space-y-3">
                            <label class="text-orange-500 text-[10px] font-black uppercase tracking-widest ml-4">Your Address / City</label>
                            {{-- FIX: name="address" diganti jadi name="alamat" --}}
                            <input type="text" name="alamat" required placeholder="Kota atau alamat lengkap anda..." 
                                class="w-full bg-[#0a0a0a] border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-orange-500 transition-all font-medium placeholder:text-white/20">
                        </div>
                    </div>

                    {{-- Input Pesan --}}
                    <div class="space-y-3">
                        <label class="text-orange-500 text-[10px] font-black uppercase tracking-widest ml-4">Message Details</label>
                        {{-- FIX: name="message" diganti jadi name="pesan" --}}
                        <textarea name="pesan" rows="5" required placeholder="Tuliskan detail project anda disini..." 
                            class="w-full bg-[#0a0a0a] border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:outline-none focus:border-orange-500 transition-all font-medium placeholder:text-white/20"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-500 text-black font-black uppercase py-5 rounded-2xl tracking-[0.2em] text-xs transition-all shadow-xl shadow-orange-600/20 active:scale-95">
                            Send Message Now
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
@endsection