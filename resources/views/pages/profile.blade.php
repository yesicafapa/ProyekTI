@extends('layouts.app')

@section('content')
{{-- Tambahan CSS untuk memastikan tidak ada sisa filter blur dari library lain --}}
<style>
    .swal2-container.swal2-backdrop-show {
        background: rgba(0, 0, 0, 0) !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }
    .swal2-popup.swal2-toast {
        box-shadow: none !important;
        filter: none !important;
    }
</style>

<div class="min-h-screen px-4 pb-20 sm:px-6 lg:px-8 font-['Poppins']">
    {{-- Header Section --}}
    <div class="mb-12 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-black italic tracking-tighter text-slate-900 uppercase dark:text-white">PENGATURAN PROFIL</h2>
            <div class="mt-2 h-1.5 w-20 bg-orange-500 rounded-full"></div>
            <p class="mt-4 text-[11px] font-extrabold uppercase tracking-[0.2em] text-slate-500 dark:text-gray-400">Kelola kredensial dan identitas visual administrator</p>
        </div>
        
        <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-orange-500 transition-colors">DASHBOARD</a>
            <span class="text-slate-300 dark:text-slate-700">/</span>
            <span class="text-orange-500 italic">KEAMANAN AKUN</span>
        </nav>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mx-auto max-w-7xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-10 xl:grid-cols-12">
            {{-- Kiri: Card Foto Profil --}}
            <div class="xl:col-span-4">
                <div class="sticky top-24 overflow-hidden rounded-[2.5rem] border-2 border-slate-100 bg-white p-10 text-center shadow-2xl shadow-slate-200/50 transition-all dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="relative inline-block group">
                        <div id="photo-container">
                            <img id="preview-foto" 
                                 src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '#' }}" 
                                 class="{{ Auth::user()->foto ? '' : 'hidden' }} h-48 w-48 rounded-[2.5rem] object-cover ring-8 ring-slate-50 transition-transform duration-500 group-hover:scale-105 dark:ring-white/5 shadow-inner">
                            
                            @if(!Auth::user()->foto)
                                <div id="placeholder-initial" class="flex h-48 w-48 items-center justify-center rounded-[2.5rem] bg-gradient-to-br from-slate-800 to-slate-900 text-6xl font-black italic text-white shadow-2xl">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <label class="absolute -bottom-2 -right-2 flex h-14 w-14 cursor-pointer items-center justify-center rounded-2xl border-4 border-white bg-orange-500 text-white shadow-xl transition-all hover:bg-slate-900 active:scale-90 dark:border-[#1a1a1a]">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <input type="file" name="foto" id="input-foto" class="hidden" accept="image/*">
                        </label>
                    </div>
                    
                    @error('foto') <p class="mt-4 text-[10px] font-black uppercase text-red-500">{{ $message }}</p> @enderror

                    <div class="mt-10">
                        <h4 class="text-2xl font-black italic tracking-tighter text-slate-900 dark:text-white uppercase">{{ Auth::user()->nama }}</h4>
                        <div class="mt-4 flex justify-center">
                            <span class="rounded-xl bg-orange-500 px-5 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-orange-500/30">
                                {{ Auth::user()->level }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form Data --}}
            <div class="space-y-8 xl:col-span-8">
                <div class="overflow-hidden rounded-[2.5rem] border-2 border-slate-100 bg-white shadow-2xl shadow-slate-200/50 dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="border-b-2 border-slate-50 px-10 py-8 dark:border-white/5">
                        <h3 class="flex items-center gap-4 text-[12px] font-black uppercase tracking-[0.2em] text-slate-900 dark:text-white">
                            <span class="h-5 w-2 rounded-full bg-orange-500"></span> Identitas Pengelola
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 gap-8 p-10 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-400">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" 
                                   class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white @error('nama') border-red-500 @enderror">
                        </div>
                        <div class="space-y-2">
                            <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-400">Email Utama</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                   class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white @error('email') border-red-500 @enderror">
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-[2.5rem] border-2 border-slate-100 bg-white shadow-2xl shadow-slate-200/50 dark:border-white/5 dark:bg-[#1a1a1a] dark:shadow-none">
                    <div class="border-b-2 border-slate-50 px-10 py-8 dark:border-white/5">
                        <h3 class="flex items-center gap-4 text-[12px] font-black uppercase tracking-[0.2em] text-slate-900 dark:text-white">
                            <span class="h-5 w-2 rounded-full bg-red-600"></span> Proteksi Akun
                        </h3>
                    </div>
                    
                    <div class="p-10">
                        <div class="mb-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-red-600">Password Saat Ini</label>
                                <span class="text-[9px] font-bold text-red-500/60 uppercase italic">Wajib jika ingin ganti password</span>
                            </div>
                            <input type="password" name="password_lama" id="password_lama" placeholder="Konfirmasi password lama Anda"
                                   class="w-full rounded-2xl border-2 border-red-100 bg-red-50/20 p-5 text-sm font-bold text-slate-900 outline-none focus:border-red-500 transition-all dark:border-red-900/20 dark:bg-red-900/5 dark:text-white @error('password_lama') border-red-500 @enderror">
                            @error('password_lama') <p class="ml-1 text-[10px] font-black uppercase text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="h-px w-full bg-slate-100 dark:bg-white/5 mb-10"></div>

                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-400">Password Baru</label>
                                <input type="password" name="password" id="password_baru" placeholder="Min. 8 karakter"
                                       class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>
                            <div class="space-y-2">
                                <label class="ml-1 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-gray-400">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                                       class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-sm font-bold text-slate-900 outline-none focus:border-orange-500 transition-all dark:border-white/10 dark:bg-white/5 dark:text-white">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-6 pt-4">
                    <button type="button" onclick="history.back()" class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 transition-colors hover:text-red-600">
                        BATALKAN
                    </button>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-14 py-5 text-[11px] font-black uppercase tracking-[0.3em] text-white shadow-2xl transition-all hover:bg-orange-600 active:scale-95 dark:bg-orange-600 dark:hover:bg-orange-500">
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="status-data" data-success="{{ session('success') }}" data-error="{{ session('error') }}" data-errors='@json($errors->all())' class="hidden"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. LIVE PREVIEW FOTO ---
        const inputFoto = document.getElementById('input-foto');
        const previewFoto = document.getElementById('preview-foto');
        const placeholderInitial = document.getElementById('placeholder-initial');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewFoto.src = e.target.result;
                    previewFoto.classList.remove('hidden');
                    if (placeholderInitial) placeholderInitial.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // --- 2. LOGIKA PASSWORD REQUIRED ---
        const pwBaru = document.getElementById('password_baru');
        const pwLama = document.getElementById('password_lama');
        
        pwBaru.addEventListener('input', function() {
            if (this.value.length > 0) {
                pwLama.setAttribute('required', 'required');
            } else {
                pwLama.removeAttribute('required');
            }
        });

        // --- 3. SWEETALERT LOGIC (ADAPTIVE LIGHT/DARK MODE) ---
        const dataEl = document.getElementById('status-data');
        const successMsg = dataEl.getAttribute('data-success');
        const errorMsg = dataEl.getAttribute('data-error');
        const vErrors = JSON.parse(dataEl.getAttribute('data-errors'));

        // Deteksi apakah sedang Mode Gelap atau Terang
        const isDark = document.documentElement.classList.contains('dark');

        const toastConfig = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            // Jika dark mode pakai #1a1a1a, jika light mode pakai Putih (#ffffff)
            background: isDark ? '#1a1a1a' : '#ffffff',
            // Jika dark mode teks putih, jika light mode teks gelap (#0f172a)
            color: isDark ? '#ffffff' : '#0f172a',
            backdrop: false, 
            showClass: {
                popup: 'animate__animated animate__fadeInRight animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutRight animate__faster'
            },
            customClass: {
                // Tambahkan border tipis saat light mode agar toast tidak "hilang" di background putih
                popup: `rounded-2xl border ${isDark ? 'border-white/20' : 'border-slate-200'} shadow-none !important`, 
                title: 'text-[10px] font-black uppercase tracking-widest',
                timerProgressBar: 'bg-orange-500'
            }
        });

        const dialogConfig = {
            background: isDark ? '#1a1a1a' : '#ffffff',
            color: isDark ? '#ffffff' : '#0f172a',
            confirmButtonColor: '#f97316',
            backdrop: isDark ? `rgba(0,0,0,0.7)` : `rgba(15, 23, 42, 0.5)`,
            customClass: {
                popup: `rounded-[2.5rem] border ${isDark ? 'border-white/10' : 'border-slate-100'} p-10 shadow-2xl`,
                title: 'text-2xl font-black italic tracking-tighter uppercase',
                htmlContainer: `text-[10px] font-bold uppercase tracking-widest ${isDark ? 'text-slate-400' : 'text-slate-500'}`,
                confirmButton: 'rounded-2xl px-14 py-4 text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-orange-500/20'
            }
        };

        if (successMsg) {
            toastConfig.fire({ icon: 'success', iconColor: '#f97316', title: 'PROFIL BERHASIL DIPERBARUI' });
        }

        if (errorMsg) {
            Swal.fire({ ...dialogConfig, icon: 'error', iconColor: '#ef4444', title: 'UPDATE GAGAL!', text: errorMsg });
        }

        if (vErrors.length > 0 && !errorMsg) {
            Swal.fire({
                ...dialogConfig,
                icon: 'warning',
                iconColor: '#f97316',
                title: 'PERIKSA KEMBALI',
                html: `
                    <div class="mt-6 space-y-2 text-left">
                        ${vErrors.map(e => `
                            <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3 border border-white/5">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-300">${e}</span>
                            </div>
                        `).join('')}
                    </div>
                `
            });
        }
    });
</script>
@endsection