@extends('layout')

@section('content')
<!-- Navbar -->
<header id="navbar" class="w-full bg-slate-800 bg-opacity-90 px-6 py-4 shadow-md fixed top-0 left-0 z-50 flex items-center justify-between">
    <div class="text-2xl font-bold flex items-center">
        <a href="{{ url('/') }}" class="hover:text-gray-300 transition-colors flex items-center">
            <!-- Logo -->
            <img src="{{ asset('images/logi.jpg') }}" alt="Logo NgueNganResult" class="h-12 w-auto mr-3">
            <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span>
        </a>
    </div>
</header>

<!-- Main Content -->
<main class="w-full min-h-screen bg-cover bg-center flex flex-col items-center justify-center relative" 
      style="background-image: url('{{ asset('') }}');">
    <!-- Superposition sombre -->
    <div class="absolute inset-0 bg-opacity-50 z-0"></div>
    
    <!-- Message de bienvenue animé -->
    <div id="welcome-message" class="absolute top-20 text-center text-white z-10 opacity-0">
        <h1 class="text-4xl font-bold">Bienvenue chez NgueNganResult !</h1>
        <p class="text-lg mt-2">Connectez-vous pour accéder à vos résultats d'examens en toute sécurité et gérer votre progression académique.</p>
    </div>

    <div class="w-full max-w-md p-6 relative z-10 mt-20">
        <!-- Logo au-dessus du formulaire -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logi.jpg') }}" alt="NgueNganResult Logo" class="h-20 w-auto mb-3">
            <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span></h2>
        </div>

        <!-- Formulaire stylisé -->
        <div class="bg-white shadow-2xl rounded-xl p-8 border border-gray-200 bg-opacity-95 transform transition-all hover:scale-105">
            <h2 class="text-2xl font-bold text-center text-teal-600 mb-8">Créer un compte</h2>
            
            <form action="{{ route('register.user') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <input type="text" name="name" placeholder="Nom d'utilisateur" autofocus 
                           class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 
                                  placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent 
                                  transition-all shadow-sm" required>
                    @if($errors->has('name'))
                        <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email d'utilisateur" 
                           class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 
                                  placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent 
                                  transition-all shadow-sm" required>
                    @if($errors->has('email'))
                        <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <input type="password" name="password" placeholder="Mot de passe" 
                           class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 
                                  placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent 
                                  transition-all shadow-sm" required>
                    @if($errors->has('password'))
                        <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                           class="h-4 w-4 text-teal-500 focus:ring-teal-400 border-gray-300 rounded shadow-sm">
                    <label for="remember" class="ml-2 text-gray-700 font-medium">Se souvenir de moi</label>
                </div>
                <div>
                    <button type="submit" 
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-lg 
                                   shadow-md transition-all hover:shadow-lg">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <footer id="footer" class="w-full bg-slate-800 bg-opacity-90 border-t border-gray-700 py-8 scale-90 opacity-0">
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
    </footer> --}}
</main>
@endsection

@push('styles')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    main {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    #welcome-message {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        z-index: 100;
    }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
    gsap.to("#navbar", { opacity: 1, duration: 1 });
    gsap.fromTo("#welcome-message", 
        { opacity: 0, y: -50 }, 
        { opacity: 1, y: 0, duration: 1.5, ease: "power2.out", delay: 0.5 }
    );
    gsap.to("#welcome-message", 
        { opacity: 0, duration: 1, delay: 3, ease: "power2.in" }
    );
    gsap.to("#footer", {
        opacity: 1,
        duration: 1.5,
        scrollTrigger: { trigger: "#footer", start: "top 90%" }
    });
</script>
@endpush
