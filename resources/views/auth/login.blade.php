@extends('layout')
@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<header id="navbar" class="w-full bg-opacity-50 bg-gray-900 backdrop-blur-md px-6 py-4 shadow-md fixed top-0 z-20 flex items-center justify-between opacity-0">
    <div class="text-2xl font-bold">
        <a href="{{ url('/') }}" class="hover:text-teal-300 transition-colors">
            Exam<span class="text-teal-400">Master</span>
        </a>
    </div>
    <nav class="space-x-6 hidden md:flex items-center">
        <a href="{{ url('/') }}" class="hover:text-teal-300 transition-colors">Accueil</a>
        <a href="#about" class="hover:text-teal-300 transition-colors">À propos</a>
        <a href="{{ route('showResultat') }}" class="hover:text-teal-300 transition-colors">Résultats</a>
        <a href="#" class="hover:text-teal-300 transition-colors">Témoignages</a>
        <a href="#" class="hover:text-teal-300 transition-colors">Contact</a>
        <a href="{{ route('login') }}" class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-full transition-transform transform hover:scale-105">Connexion</a>
        <a href="{{ route('register') }}" class="bg-white text-teal-500 hover:bg-gray-200 px-4 py-2 rounded-full transition-transform transform hover:scale-105">Inscrire</a>
    </nav>
    <button class="md:hidden text-white focus:outline-none" id="menu-toggle">
        <i class="fas fa-bars text-2xl"></i>
    </button>
</header>

<div id="mobile-menu" class="hidden md:hidden bg-gray-900 w-full absolute top-16 left-0 p-6 space-y-4 z-10">
    <a href="{{ url('/') }}" class="block hover:text-teal-300">Accueil</a>
    <a href="#about" class="block hover:text-teal-300">À propos</a>
    <a href="{{ route('showResultat') }}" class="block hover:text-teal-300">Résultats</a>
    <a href="#" class="block hover:text-teal-300">Témoignages</a>
    <a href="#" class="block hover:text-teal-300">Contact</a>
    <a href="{{ route('login') }}" class="block bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-full">Connexion</a>
    <a href="{{ route('register') }}" class="block bg-white text-teal-500 hover:bg-gray-200 px-4 py-2 rounded-full">Inscrire</a>
</div>

<main class="pt-24 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-6">
        <div class="bg-[#112825]/90 backdrop-blur-md rounded-xl shadow-xl p-6 border border-gray-800">
            <h2 class="text-3xl font-bold text-center text-teal-400 mb-6 opacity-0" id="login-title">Connexion</h2>
            
            <form action="{{ route('login.user') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <input type="email" name="email" placeholder="Email" autofocus class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                    @if($errors->has('email'))
                        <span class="text-red-400 text-sm mt-1 block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <input type="password" name="password" placeholder="Mot de passe" class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                    @if($errors->has('password'))
                        <span class="text-red-400 text-sm mt-1 block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-teal-500 focus:ring-teal-500 border-gray-700 rounded bg-gray-900">
                    <label for="remember" class="ml-2 text-gray-300">Se souvenir de moi</label>
                </div>
                <div>
                    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-full shadow-md transition-transform transform hover:scale-105">
                        Se connecter
                    </button>
                </div>
                <div>
                    <a href="{{ url('/') }}" class="block text-center mt-4 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-full transition-transform transform hover:scale-105">Retour à l'accueil</a>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script>
    gsap.to("#navbar", { opacity: 1, duration: 1, y: -10 });
    gsap.to("#login-title", { opacity: 1, y: -20, duration: 1.5, delay: 0.5, ease: "back.out(1.7)" });
    gsap.from("form", { opacity: 0, y: 20, duration: 1, delay: 0.8, ease: "power2.out" });

    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        gsap.fromTo(menu, { opacity: 0, y: -10 }, { opacity: 1, y: 0, duration: 0.5 });
    });
</script>
@endsection
