@extends('layouts.app')

@section('content')
    {{-- Breadcrumb dengan fungsi Back otomatis --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            User Profile
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 hover:text-orange-600" href="{{ url()->previous() }}">
                        Back /
                    </a>
                </li>
                <li class="font-medium text-orange-600">Edit Profile</li>
            </ol>
        </nav>
    </div>
    
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-white/[0.03] lg:p-8">
        <div class="flex items-center justify-between mb-7">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Akun</h3>
            <span class="px-3 py-1 text-xs font-medium bg-orange-100 text-orange-600 rounded-full uppercase">
                {{ Auth::user()->level }}
            </span>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="mb-6 flex w-full border-l-6 border-green-500 bg-green-50 px-7 py-4 shadow-md dark:bg-white/[0.03] md:p-5">
                <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-green-500 text-white">
                    <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 1L5.66667 11L1 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="w-full">
                    <h5 class="mb-1 text-lg font-semibold text-green-900 dark:text-green-500">Berhasil!</h5>
                    <p class="text-base leading-relaxed text-green-800 dark:text-green-400">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Tampilkan Error Validasi --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-600 dark:bg-red-900/20 dark:text-red-400">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Utama --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')

            {{-- Bagian Upload Foto --}}
            <div class="mb-8 p-6 rounded-2xl bg-gray-50 dark:bg-white/[0.02] border border-gray-100 dark:border-gray-800">
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    <div class="relative">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Profile" 
                                 class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl dark:border-gray-800">
                        @else
                            <div class="flex items-center justify-center w-32 h-32 rounded-full bg-orange-600 text-white text-4xl font-bold border-4 border-white shadow-xl dark:border-gray-800">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="text-center sm:text-left flex-1">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Upload Foto Baru</label>
                        <input type="file" name="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-600 file:text-white hover:file:bg-orange-700 transition-all cursor-pointer">
                        <p class="mt-2 text-xs text-gray-400 font-medium italic">*Rekomendasi: Ukuran 1:1, Maksimal 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- Bagian Input Data --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input Nama --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" 
                           class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 dark:border-gray-700 dark:bg-dark-900 dark:text-white" required>
                </div>

                {{-- Input Email --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                           class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 dark:border-gray-700 dark:bg-dark-900 dark:text-white" required>
                </div>

                {{-- Input Password Baru --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ganti" autocomplete="new-password"
                           class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 dark:border-gray-700 dark:bg-dark-900 dark:text-white">
                </div>

                {{-- Konfirmasi Password --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                           class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 dark:border-gray-700 dark:bg-dark-900 dark:text-white">
                </div>
            </div>

            <hr class="border-gray-100 dark:border-gray-800 my-8" />

            {{-- Tombol Aksi --}}
            <div class="flex justify-end items-center gap-4">
                <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-gray-800 dark:hover:text-white transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex justify-center rounded-lg bg-orange-600 px-8 py-3 font-semibold text-white shadow-lg hover:bg-orange-700 transform transition-active active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection