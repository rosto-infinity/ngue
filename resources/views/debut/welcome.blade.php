<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngue Ngan Result - Gestion d'examen en ligne</title>
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
        </div>
        <nav class="space-x-4 hidden md:flex">
            <a href="{{ url('/') }}" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Accueil</a>
            <a href="#about" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">À propos</a>
            <a href="{{ route('showResultat') }}" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Résultats</a>
            <a href="#" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Témoignages</a>
            <a href="#" class="px-4 py-2 bg-teal-600 rounded-lg hover:bg-teal-500 transition">Contact</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative w-full h-screen flex flex-col items-center justify-center text-center px-6 hero-text opacity-0">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight animate-bounce">
            Consultez vos résultats en toute <span class="text-teal-400">sécurité</span> et simplicité !
        </h1>
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-teal-500 rounded-lg hover:bg-teal-400 transition">Connexion</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition">Inscription</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 px-6 opacity-0 translate-y-20">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-teal-400">À propos de nous</h2>
            <p class="text-gray-300 mt-4 leading-relaxed">
                Chez <strong>NgueNganResult</strong>, nous révolutionnons l'éducation numérique en offrant une plateforme fiable,
                sécurisée et facile d'accès. Notre objectif est de garantir une transparence totale dans la gestion des
                examens et des résultats en ligne, tout en assurant une expérience fluide pour les étudiants et les enseignants.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="w-full bg-slate-800 bg-opacity-90 border-t border-gray-700 py-8 scale-90 opacity-0">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logi.jpg') }}" alt="Logo NgueNganResult" class="h-10 w-auto">
                <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span>
            </div>
            <p class="text-gray-400 text-sm mt-2">Une plateforme fiable pour une évaluation en ligne.</p>
            
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="https://facebook.com" target="_blank" class="text-gray-400 hover:text-teal-400 transition">
                    <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="text-gray-400 hover:text-teal-400 transition">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="text-gray-400 hover:text-teal-400 transition">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </div>
        </div>
        <div class="text-center text-gray-500 text-sm mt-4">
            © 2025 NgueNganResult. Tous droits réservés.
        </div>
    </footer>

    <!-- GSAP Animations -->
    <script>
        gsap.to("#navbar", { opacity: 1, duration: 1 });
        gsap.to(".hero-text", { opacity: 1, y: -20, duration: 1.5, delay: 0.5 });
        gsap.to("#about", {
            opacity: 1,
            y: 0,
            duration: 1.5,
            scrollTrigger: { trigger: "#about", start: "top 80%" }
        });
        gsap.to("#footer", {
            scale: 1,
            opacity: 1,
            duration: 1.5,
            scrollTrigger: { trigger: "#footer", start: "top 90%" }
        });
    </script>
</body>

</html>