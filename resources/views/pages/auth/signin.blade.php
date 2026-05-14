@extends('layouts.fullscreen-layout')

@section('content')
<div class="relative min-h-screen bg-white dark:bg-[#080808] font-['Poppins']">
    <div class="flex min-h-screen w-full flex-col lg:flex-row">
        
        {{-- Sisi Kiri: Form Login --}}
        <div class="flex w-full flex-1 flex-col justify-center px-8 py-12 lg:w-1/2 lg:px-20 xl:px-32 bg-white dark:bg-[#080808]">
            <div class="mx-auto w-full max-w-md">
                {{-- Header Section --}}
                <div class="mb-10 lg:mb-12">
                    {{-- Teks utama dibuat hitam pekat (slate-900) --}}
                    <h1 class="text-4xl font-black italic tracking-tighter text-slate-900 dark:text-white uppercase leading-tight">
                        Selamat Datang
                    </h1>
                    <div class="mt-2 h-1.5 w-16 bg-orange-600 rounded-full text-left"></div>
                    {{-- Sub-teks diperjelas dari slate-400 ke slate-600 --}}
                    <p class="mt-4 text-[12px] font-extrabold uppercase tracking-[0.2em] text-slate-600 dark:text-gray-400">
                        Masuk ke Area Administrasi SEOVDETECH
                    </p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf 
                    
                    {{-- Input Email --}}
                    <div class="space-y-2">
                        {{-- Label sekarang hitam pekat agar terbaca jelas --}}
                        <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-300">Alamat Email</label>
                        <input type="email" name="email" required placeholder="admin@seovdetech.com"
                            class="w-full rounded-2xl border-2 border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 dark:border-white/10 dark:bg-white/5 dark:text-white transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-gray-700">
                    </div>

                    {{-- Input Password --}}
                    <div class="space-y-2" x-data="{ show: false }">
                        <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-300">Kata Sandi</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
                                class="w-full rounded-2xl border-2 border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 dark:border-white/10 dark:bg-white/5 dark:text-white transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-gray-700">
                            <button type="button" @click="show = !show" class="absolute right-5 top-4 text-slate-400 hover:text-orange-600 transition-colors">
                                <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.225 0 2.37.217 3.425.611M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Opsi Login --}}
                    <div class="flex items-center justify-between px-1">
                        <label class="flex cursor-pointer items-center gap-3 group">
                            <div class="relative flex items-center">
                                <input type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-lg border-2 border-slate-300 bg-white checked:bg-orange-600 checked:border-orange-600 focus:outline-none transition-all dark:border-white/10 dark:bg-[#1a1a1a]">
                                <svg class="absolute h-3.5 w-3.5 text-white opacity-0 peer-checked:opacity-100 left-[3px] pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[12px] font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 group-hover:text-orange-600 transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    {{-- Tombol Aksi --}}
                    <button type="submit" class="group relative w-full overflow-hidden rounded-2xl bg-slate-900 py-5 text-[13px] font-black uppercase tracking-[0.3em] text-white shadow-2xl transition-all hover:bg-orange-600 active:scale-95 dark:bg-orange-600 dark:hover:bg-orange-500">
                        <span class="relative z-10">Masuk ke Dashboard</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Sisi Kanan: Visual Branding --}}
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center bg-[#050505] relative overflow-hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[700px] w-[700px] rounded-full bg-orange-600/20 blur-[140px] opacity-70"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-96 w-96 rounded-full bg-orange-500/40 blur-[90px]"></div>
            
            <div class="relative z-10 text-center">
                <div class="relative group inline-block">
                    <h2 class="absolute inset-0 text-[100px] font-black italic text-orange-600/30 blur-2xl uppercase tracking-tighter select-none">
                        SEOVDETECH
                    </h2>
                    <h2 class="relative text-[100px] font-black italic text-white uppercase tracking-tighter drop-shadow-[0_10px_30px_rgba(249,115,22,0.6)]">
                        SEOVDETECH
                    </h2>
                </div>
                
                <div class="mt-2 flex flex-col items-center">
                    <p class="text-[13px] font-black uppercase tracking-[0.7em] text-orange-500">
                        Inovasi Digital Masa Depan
                    </p>
                </div>
            </div>

            <div class="absolute inset-0 opacity-[0.03] [background-image:linear-gradient(rgba(249,115,22,0.3)_1px,transparent_1px),linear-gradient(90deg,rgba(249,115,22,0.3)_1px,transparent_1px)] [background-size:50px_50px]"></div>
        </div>
    </div>
</div>
@endsection