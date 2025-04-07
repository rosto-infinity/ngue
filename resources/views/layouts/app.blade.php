<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Ngue Ngan Result - Gestion d'examen en ligne")</title>
    <link rel="shortcut icon" href="{{ asset('images/logi.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Importation de GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Importation de Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Superposition sombre semi-transparente */
            z-index: -1;
        }
    </style>
</head>
<body class="bg-[#0E151B] text-white font-sans bg-cover bg-center" style="background-image: url('/images/plan.jpg');">
    <!-- Navbar -->
    <header id="navbar" class="w-full bg-slate-800 bg-opacity-90 px-6 py-4 shadow-md fixed top-0 left-0 z-50 flex items-center justify-between opacity-0">
        <a href="{{ url('/') }}" class="hover:text-gray-300 transition-colors flex items-center">
            <!-- Logo -->
            <img src="{{ asset('images/logi.jpg') }}" alt="Logo NgueNganResult" class="h-12 w-auto mr-3">
            <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span>
        </a>
        <nav class="space-x-4 hidden md:flex">
            <a href="{{ url('/') }}" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Accueil</a>
            <a href="#about" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">À propos</a>
            <a href="{{ route('showResultat') }}" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Résultats</a>
            <a href="#" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Témoignages</a>
            <a href="#" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Contact</a>
        </nav>
    </header>

    <!-- Contenu principal -->
    <div class="pt-24">
        @yield('content')
    </div>
</body>
</html>
