<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} | CV SEOVDETECH</title>

    {{-- TAMBAHKAN BARIS INI --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Fonts: Menggunakan Poppins agar sesuai dengan branding profesional --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Script Pencegah Flicker --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.backgroundColor = '#0d0d0d';
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.style.backgroundColor = '#ffffff';
            }
        })();
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* 1. Paksa warna seleksi teks jadi Orange */
        ::selection {
            background-color: #f97316 !important;
            color: white !important;
        }

        /* 2. Hilangkan outline biru default browser pada semua elemen */
        *:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2) !important;
        }

        /* 3. Perbaiki warna scrollbar agar senada dengan tema dark */
        .dark::-webkit-scrollbar {
            width: 8px;
        }
        .dark::-webkit-scrollbar-track {
            background: #0d0d0d;
        }
        .dark::-webkit-scrollbar-thumb {
            background: #2d2d2d;
            border-radius: 10px;
        }
        .dark::-webkit-scrollbar-thumb:hover {
            background: #f97316;
        }

        /* 4. Smooth Transition untuk perpindahan konten */
        main {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="h-full font-sans antialiased bg-white dark:bg-[#0d0d0d] text-slate-800 dark:text-gray-100 transition-colors duration-300">

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(el => {
                el.style.accentColor = '#f97316';
            });
        });
    </script>
</body>
</html>