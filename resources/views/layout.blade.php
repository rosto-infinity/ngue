<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ngue Ngan Exam')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <link rel="shortcut icon" href="{{ asset('images/logi.jpg') }}" type="image/x-icon">
</head>
<body class="bg-[#0E152B] text-white font-sans min-h-screen">
    <nav class="w-full bg-opacity-50 bg-black backdrop-blur-md px-6 py-4 shadow-md fixed top-0 z-20 flex items-center justify-between">
        <div class="text-2xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-300 transition-colors flex items-center">
                <img src="{{ asset('images/logi.jpg') }}" alt="Logo NgueNganResult" class="h-12 w-auto mr-3">
                <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span>
            </a>
        </div>
        
        @if (Route::has('login'))
            @auth
                <div class="hidden md:flex space-x-4 items-center">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('students.index') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Étudiants</a>
                        <a href="{{ route('filieres.index') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Filières</a>
                        <a href="{{ route('courses.index') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Cours</a>
                        <a href="{{ route('exams.index') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Examens</a>
                        <a href="{{ route('statistics.index') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Statistiques</a>
                    @else
                        <a href="{{ route('showResultat') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Résultats</a>
                    @endif
                </div>
            @else
                <div class="hidden md:flex space-x-4 items-center">
                    <a href="{{ route('login') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-teal-500 px-4 py-2 rounded-full hover:bg-teal-600 transition-colors">Inscription</a>
                    @endif
                </div>
            @endauth
        @endif

        @auth
            <div class="relative flex items-center space-x-4">
                <div class="group">
                    <button class="flex items-center focus:outline-none">
                        <i class="fas fa-user-circle text-2xl text-gray-300 hover:text-teal-300 transition-colors"></i>
                    </button>
                    <ul class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg hidden group-hover:block">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-700 transition-colors">Mon profil</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-700 transition-colors">Paramètres</a>
                        </li>
                        <li>
                            <a href="{{ route('signout') }}" class="block px-4 py-2 hover:bg-gray-700 transition-colors">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
    </nav>

    <div class="container mx-auto pt-20 px-6">
        @yield('content')
    </div>

    <script>
        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
    