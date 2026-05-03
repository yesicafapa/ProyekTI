@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 pb-20 sm:px-6 lg:px-8 font-['Poppins']">
    {{-- Header Section --}}
    <div class="mb-12 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-black italic tracking-tighter text-slate-800 uppercase dark:text-white">PENGATURAN PROFIL</h2>
            <p class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Kelola data diri dan keamanan akun administrator</p>
        </div>
        
        <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-orange-500 transition-colors">DASHBOARD</a>
            <span class="text-slate-300 dark:text-slate-700">/</span>
            <span class="text-orange-500 italic">EDIT PROFIL</span>
        </nav>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mx-auto max-w-7xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-10 xl:grid-cols-12">
            {{-- Kiri: Card Foto Profil --}}
            <div class="xl:col-span-4">
                <div class="sticky top-24 overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-10 text-center shadow-xl shadow-slate-200/50 transition-colors dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="relative inline-block group">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                                 class="h-44 w-44 rounded-[2.5rem] object-cover ring-8 ring-slate-50 transition-transform duration-500 group-hover:scale-105 dark:ring-white/5">
                        @else
                            <div class="flex h-44 w-44 items-center justify-center rounded-[2.5rem] bg-gradient-to-br from-orange-400 to-orange-600 text-6xl font-black italic text-white shadow-lg shadow-orange-500/20">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                        @endif
                        
                        <label class="absolute -bottom-2 -right-2 flex h-12 w-12 cursor-pointer items-center justify-center rounded-2xl border-4 border-white bg-slate-900 text-white shadow-xl transition-all hover:bg-orange-500 active:scale-90 dark:border-[#1a1a1a]">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <input type="file" name="foto" class="hidden">
                        </label>
                    </div>
                    
                    @error('foto') <p class="mt-4 text-[10px] font-black uppercase tracking-tighter text-red-500">{{ $message }}</p> @enderror
                    
                    <div class="mt-8">
                        <h4 class="text-2xl font-black italic tracking-tighter text-slate-800 dark:text-white uppercase">{{ Auth::user()->nama }}</h4>
                        <div class="mt-3 flex justify-center">
                            <span class="rounded-xl border border-orange-500/20 bg-orange-500/10 px-4 py-1.5 text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">
                                {{ Auth::user()->level }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form Data --}}
            <div class="space-y-8 xl:col-span-8">
                {{-- Data Pribadi --}}
                <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50 dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="border-b border-slate-50 px-10 py-6 dark:border-white/5">
                        <h3 class="flex items-center gap-3 text-[11px] font-black uppercase tracking-[0.2em] text-slate-800 dark:text-white">
                            <span class="h-4 w-1.5 rounded-full bg-orange-500"></span> Informasi Personal
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 gap-8 p-10 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="ml-1 text-[10px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" 
                                   class="w-full rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white @error('nama') border-red-500 @enderror">
                            @error('nama') <p class="ml-1 text-[10px] font-black uppercase text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="ml-1 text-[10px] font-black uppercase tracking-widest text-slate-400">Email Utama</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                   class="w-full rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white @error('email') border-red-500 @enderror">
                            @error('email') <p class="ml-1 text-[10px] font-black uppercase text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Keamanan --}}
                <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50 dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="border-b border-slate-50 px-10 py-6 dark:border-white/5">
                        <h3 class="flex items-center gap-3 text-[11px] font-black uppercase tracking-[0.2em] text-slate-800 dark:text-white">
                            <span class="h-4 w-1.5 rounded-full bg-red-500"></span> Keamanan & Password
                        </h3>
                    </div>
                    <div class="p-10">
                        <div class="mb-8 rounded-2xl bg-blue-50 p-4 dark:bg-blue-900/10">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                                <i class="mr-2 fas fa-info-circle"></i> Kosongkan password baru jika tidak ingin mengubahnya. Password lama hanya diperlukan untuk konfirmasi perubahan password.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="ml-1 text-[10px] font-black uppercase tracking-widest text-slate-400">Password Baru</label>
                                <input type="password" name="password" id="password_baru" placeholder="Min. 8 karakter"
                                       class="w-full rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                                @error('password') <p class="ml-1 text-[10px] font-black uppercase text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="ml-1 text-[10px] font-black uppercase tracking-widest text-slate-400">Ulangi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi password"
                                       class="w-full rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-800 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>
                        </div>

                        {{-- Password Lama: Muncul/Wajib hanya jika password baru diisi --}}
                        <div class="mt-8 space-y-2" id="old_password_container">
                            <label class="ml-1 text-[10px] font-black uppercase tracking-[0.2em] text-red-500">Konfirmasi Password Saat Ini (Wajib Jika Ganti PW)</label>
                            <input type="password" name="password_lama" id="password_lama" placeholder="••••••••"
                                   class="w-full rounded-2xl border border-red-100 bg-red-50/30 p-4 text-sm font-bold text-slate-800 outline-none focus:border-red-500 transition-all dark:border-red-900/20 dark:bg-red-900/5 dark:text-white @error('password_lama') border-red-500 @enderror">
                            @error('password_lama') <p class="ml-1 text-[10px] font-black uppercase text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-6 pt-4">
                    <button type="button" onclick="history.back()" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 transition-colors hover:text-slate-800 dark:hover:text-white">
                        BATALKAN
                    </button>
                    <button type="submit" class="rounded-2xl bg-orange-500 px-12 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-orange-500/20 transition-all hover:bg-orange-600 active:scale-95">
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- SweetAlert Logic --}}
<div id="status-data" data-success="{{ session('success') }}" data-error="{{ session('error') }}" data-errors='@json($errors->all())' class="hidden"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Logic untuk mewajibkan password lama hanya jika password baru diisi
        const pwBaru = document.getElementById('password_baru');
        const pwLama = document.getElementById('password_lama');
        
        pwBaru.addEventListener('input', function() {
            if (this.value.length > 0) {
                pwLama.setAttribute('required', 'required');
            } else {
                pwLama.removeAttribute('required');
            }
        });

        // SweetAlert
        const dataEl = document.getElementById('status-data');
        const successMsg = dataEl.getAttribute('data-success');
        const errorMsg = dataEl.getAttribute('data-error');
        const vErrors = JSON.parse(dataEl.getAttribute('data-errors'));

        const swalConfig = {
            confirmButtonColor: '#f97316',
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl px-10 py-3 uppercase text-[10px] font-black tracking-widest'
            }
        };

        if (successMsg) {
            Swal.fire({ ...swalConfig, icon: 'success', title: 'BERHASIL!', text: successMsg, showConfirmButton: false, timer: 2000 });
        }
        if (errorMsg) {
            Swal.fire({ ...swalConfig, icon: 'error', title: 'GAGAL!', text: errorMsg });
        }
        if (vErrors.length > 0 && !errorMsg) {
            Swal.fire({ 
                ...swalConfig, 
                icon: 'warning', 
                title: 'CEK INPUTAN', 
                html: `<ul class="text-left text-[10px] font-bold uppercase space-y-1">${vErrors.map(e => `<li>- ${e}</li>`).join('')}</ul>` 
            });
        }
    });
</script>
@endsection