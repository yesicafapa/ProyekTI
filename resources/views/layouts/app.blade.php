<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} | CV Seovdetech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body
    x-cloak
    x-data="{ loaded: true }"
    class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    {{-- preloader --}}
    <x-common.preloader/>

    <div class="min-h-screen xl:flex">
        @include('layouts.backdrop')
        @include('layouts.sidebar')

        <div class="flex-1 transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            
            @include('layouts.app-header')

            <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi ini sekarang bersifat GLOBAL
        window.confirmLogout = function() {
            Swal.fire({
                title: 'Yakin mau keluar?',
                text: "Sesi Anda akan berakhir sekarang.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f97316', // Orange branding Seovdetech
                cancelButtonColor: '#334155',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal',
                borderRadius: '24px',
                // Opsional: Efek blur jika kamu punya ID main-content
                didOpen: () => {
                    const main = document.querySelector('main') || document.querySelector('.flex-1');
                    if (main) main.style.filter = 'blur(4px)';
                },
                willClose: () => {
                    const main = document.querySelector('main') || document.querySelector('.flex-1');
                    if (main) main.style.filter = 'none';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form yang ada di header
                    document.getElementById('logout-form-header').submit();
                }
            });
        }
    </script>
</body>
</html>
</body>
</html>