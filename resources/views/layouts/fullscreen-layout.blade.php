<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Auth' }} | CV SEOVDETECH</title>

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
    class="h-full font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    {{-- Preloader jika ada --}}
    @if(View::exists('components.common.preloader'))
        <x-common.preloader/>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>