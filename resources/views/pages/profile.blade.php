@extends('layouts.app')

@section('content')
<div class="min-h-screen pb-20 px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Pengaturan Profil</h2>
            <p class="text-base text-gray-500 dark:text-gray-400 mt-1">Kelola data diri dan keamanan akun CV Seovdetech Anda.</p>
        </div>
        
        <nav class="flex text-sm font-medium">
            {{-- FIX: Link Dashboard diarahkan ke management dashboard --}}
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-orange-500 transition-colors">Dashboard</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-orange-600">Edit Profil</span>
        </nav>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="max-w-7xl mx-auto">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            {{-- Kiri: Card Foto Profil - Dibuat lebih slim & profesional --}}
            <div class="xl:col-span-4">
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 p-8 text-center sticky top-24">
                    <div class="relative inline-block">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                                 class="w-40 h-40 rounded-[2rem] object-cover ring-4 ring-orange-500/10 shadow-lg">
                        @else
                            <div class="w-40 h-40 rounded-[2rem] bg-orange-600 flex items-center justify-center text-5xl font-black text-white shadow-lg">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                        @endif
                        
                        <label class="absolute -bottom-2 -right-2 bg-orange-600 p-2.5 rounded-xl shadow-lg border-4 border-white dark:border-gray-900 cursor-pointer hover:bg-orange-700 transition-all">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <input type="file" name="foto" class="hidden">
                        </label>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->nama }}</h4>
                        <div class="mt-2">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black bg-orange-500/10 text-orange-500 uppercase tracking-widest border border-orange-500/20">
                                {{ Auth::user()->level }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form Data Card --}}
            <div class="xl:col-span-8 space-y-6">
                {{-- Data Pribadi --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-50 dark:border-gray-800">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-4 bg-orange-500 rounded-full"></span> Informasi Personal
                        </h3>
                    </div>
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 ml-1">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" 
                                   class="w-full rounded-xl border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900 p-3.5 text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all dark:text-white">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 ml-1">Email Utama</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                   class="w-full rounded-xl border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900 p-3.5 text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all dark:text-white">
                        </div>
                    </div>
                </div>

                {{-- Keamanan --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-50 dark:border-gray-800">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-4 bg-red-500 rounded-full"></span> Keamanan Akun
                        </h3>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-red-500 ml-1 uppercase tracking-widest">Konfirmasi Password Saat Ini *</label>
                            <input type="password" name="current_password" required placeholder="Masukkan password lama"
                                   class="w-full rounded-xl border-red-100 dark:border-red-900/30 bg-red-50/30 dark:bg-red-900/10 p-3.5 text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all dark:text-white">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 ml-1">Password Baru (Opsional)</label>
                                <input type="password" name="password" placeholder="Min. 8 karakter"
                                       class="w-full rounded-xl border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900 p-3.5 text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all dark:text-white">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-gray-500 dark:text-gray-400 ml-1">Ulangi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="Harus sama"
                                       class="w-full rounded-xl border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900 p-3.5 text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all dark:text-white">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-4 pt-4">
                    <button type="button" onclick="history.back()" class="text-sm font-bold text-gray-400 hover:text-gray-600 dark:hover:text-white transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-3.5 rounded-xl font-bold text-white bg-orange-600 shadow-lg shadow-orange-600/20 hover:bg-orange-700 active:scale-95 transition-all text-sm uppercase tracking-widest">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Script SweetAlert tetep sama --}}
<div id="status-data" data-success="{{ session('success') }}" data-error="{{ session('error') }}" data-errors='@json($errors->all())' class="hidden"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dataEl = document.getElementById('status-data');
        const successMsg = dataEl.getAttribute('data-success');
        const errorMsg = dataEl.getAttribute('data-error');
        const vErrors = JSON.parse(dataEl.getAttribute('data-errors'));

        const swalConfig = {
            confirmButtonColor: '#ea580c',
            borderRadius: '1.25rem'
        };

        if (successMsg) {
            Swal.fire({ ...swalConfig, icon: 'success', title: 'Berhasil!', text: successMsg, showConfirmButton: false, timer: 2000 });
        }
        if (errorMsg) {
            Swal.fire({ ...swalConfig, icon: 'error', title: 'Gagal!', text: errorMsg });
        }
        if (vErrors.length > 0) {
            Swal.fire({ ...swalConfig, icon: 'warning', title: 'Cek Inputan', html: `<ul class="text-left text-xs">${vErrors.map(e => `<li>- ${e}</li>`).join('')}</ul>` });
        }
    });
</script>
@endsection