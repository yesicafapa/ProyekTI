<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} | CV Seovdetech</title>

    {{-- FAVICON FIX --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                          (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        })();
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; -webkit-font-smoothing: antialiased; }
        .swal2-container { z-index: 99999 !important; }
        .swal2-backdrop-show { backdrop-filter: blur(8px) !important; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
    </style>
</head>

<body
    x-cloak
    x-data="{ loaded: true }"
    class="bg-gray-50 text-slate-900 dark:bg-[#0a0a0a] dark:text-white transition-colors duration-500">

    {{-- Preloader --}}
    <x-common.preloader/>

    {{-- HIDDEN LOGOUT FORM (CRITICAL FIX) --}}
    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="min-h-screen">
        
        {{-- 1. Sidebar --}}
        @include('layouts.sidebar')

        {{-- 2. Pembungkus Konten Utama --}}
        <div class="flex-1 flex flex-col min-h-screen transition-all duration-300 ease-in-out lg:ml-72">
            
            {{-- App Header --}}
            @include('layouts.app-header')

            {{-- Main Content --}}
            <main class="p-4 mx-auto w-full max-w-screen-2xl md:p-6 lg:p-10 flex-grow">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="p-6 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} CV SEOVDETECH. All rights reserved.
            </footer>
        </div>
    </div>

    {{-- Script SweetAlert & Logout --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.confirmLogout = function() {
            const isDark = document.documentElement.classList.contains('dark');
            
            Swal.fire({
                title: 'Yakin mau keluar?',
                text: "Sesi Anda akan berakhir sekarang.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f97316', 
                cancelButtonColor: isDark ? '#1a1a1a' : '#cbd5e1',
                confirmButtonText: 'YA, KELUAR!',
                cancelButtonText: 'BATAL',
                reverseButtons: true,
                background: isDark ? '#111111' : '#ffffff',
                color: isDark ? '#ffffff' : '#0f172a',
                customClass: {
                    popup: 'rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-2xl',
                    confirmButton: 'rounded-2xl px-8 py-3 font-bold uppercase tracking-widest',
                    cancelButton: 'rounded-2xl px-8 py-3 font-bold uppercase tracking-widest text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const logoutForm = document.getElementById('logout-form-header');
                    if (logoutForm) {
                        logoutForm.submit();
                    } else {
                        console.error("Form logout tidak ditemukan!");
                    }
                }
            });
        }
    </script>
</body>
</html>