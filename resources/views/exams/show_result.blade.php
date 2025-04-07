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
    <a href="{{ url('/') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-full transition-transform transform hover:scale-105">Retour</a>
</header>

<main class="pt-24 min-h-screen flex flex-col items-center justify-center">
    <div class="max-w-6xl w-full mx-6">
        <div class="bg-[#112825]/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-gray-800">
            <h2 class="text-4xl font-bold text-center text-teal-400 mb-8 opacity-0" id="login-title">Résultats des Examens</h2>
            
            <!-- Search Bar -->
            <form action="{{ route('resultats.search') }}" method="GET" class="mb-8 flex items-center space-x-4">
                <input type="text" name="query" placeholder="Rechercher un étudiant..." value="{{ request('query') }}" class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-teal-500 shadow-xl">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white px-5 py-3 rounded-xl shadow-xl flex items-center space-x-2">
                    <i class="fas fa-search"></i>
                    <span>Rechercher</span>
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse border border-gray-700 rounded-xl shadow-xl text-lg">
                    <thead class="bg-teal-600 text-white uppercase tracking-wide">
                        <tr>
                            <th class="py-4 px-6">#</th>
                            <th class="py-4 px-6">Étudiant</th>
                            <th class="py-4 px-6">Examen</th>
                            <th class="py-4 px-6">Mention</th>
                            <th class="py-4 px-6">Décision</th>
                            <th class="py-4 px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 text-gray-300 text-lg">
                        @foreach ($resultats as $resultat)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                            <td class="py-4 px-6">{{ $resultat->id }}</td>
                            <td class="py-4 px-6">{{ $resultat->student->firstname }} {{ $resultat->student->lastname }}</td>
                            <td class="py-4 px-6">{{ $resultat->exam->title }}</td>
                            <td class="py-4 px-6">{{ $resultat->grade }}</td>
                            <td class="py-4 px-6">{{ $resultat->decision ?? 'N/A' }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('exams.details', ['id' => $resultat->id]) }}" class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-3 rounded-lg transition shadow-lg">
                                    Voir détails
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script>
    gsap.to("#navbar", { opacity: 1, duration: 1, y: -10 });
    gsap.to("#login-title", { opacity: 1, y: -20, duration: 1.5, delay: 0.5, ease: "back.out(1.7)" });
</script>
@endsection
