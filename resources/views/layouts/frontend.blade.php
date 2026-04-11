<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seov Detech - Innovative IT Solutions</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Base Styles agar sesuai nuansa Dark Mode Figma */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000000;
            color: #ffffff;
            scroll-behavior: smooth;
        }

        /* Custom Glow Oranye sesuai desain */
        .glow-orange {
            text-shadow: 0 0 20px rgba(255, 138, 0, 0.5);
        }

        /* Garis Sirkuit Background agar tidak menutupi konten */
        .circuit-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://www.transparenttextures.com/patterns/circuit-board.png');
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
        }

        /* Scrollbar kustom agar lebih estetik */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #FF8A00; border-radius: 10px; }
    </style>
</head>
<body class="overflow-x-hidden">

    @include('pages.frontend.sections.navbar')

    <main>
        @yield('content')
    </main>

    @include('pages.frontend.sections.footer')

    <a href="https://wa.me/628981500648" class="fixed bottom-6 right-6 z-50 bg-green-500 p-3 rounded-full shadow-lg hover:scale-110 transition">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-8 h-8" alt="WhatsApp">
    </a>

</body>
</html>