@extends('layout')

@section('content')
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white overflow-hidden">
        <!-- Header + Logo -->
        <header class="pt-20 text-center animate__animated animate__fadeInDown">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logi.jpg') }}" alt="Logo" class="h-16 w-16 rounded-full shadow-lg border-2 border-white-400">
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-500 mb-2">
                Liste des Cours
            </h1>
            <p class="text-gray-400 text-lg">Gérez et modifiez vos cours facilement</p>
        </header>

        <!-- Contenu principal -->
        <main class="flex-grow pt-10 px-6">
            <div class="max-w-5xl mx-auto mt-8">
                <!-- Message de succès -->
                @if (session()->has('success'))
                    <div class="bg-teal-500/20 text-teal-400 p-4 rounded-lg mb-6 text-center animate__animated animate__fadeIn">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <!-- Bouton Ajouter -->
                <div class="text-right mb-6">
                    <a href="{{ route('courses.create') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-all animate__animated animate__fadeInLeft">
                        Ajouter un cours
                    </a>
                </div>

                <!-- Tableau -->
                <div class="bg-[#112825]/90 rounded-xl shadow-2xl overflow-hidden border border-gray-800 animate__animated animate__fadeInUp">
                    <table class="w-full text-white">
                        <thead>
                            <tr class="bg-gradient-to-r from-teal-600 to-teal-800 text-white uppercase text-sm tracking-wide">
                                <th class="py-4 px-6 text-left">#</th>
                                <th class="py-4 px-6 text-left">Nom</th>
                                <th class="py-4 px-6 text-left">Description</th>
                                <th class="py-4 px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="border-b border-gray-700 hover:bg-gray-900/80 transition-all duration-300">
                                    <td class="py-4 px-6">{{ $course->id }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-200">{{ $course->name }}</td>
                                    <td class="py-4 px-6 text-gray-300">{{ $course->description }}</td>
                                    <td class="py-4 px-6 flex space-x-2">
                                        <a href="{{ route('courses.edit', $course->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-full transition-colors shadow">
                                            Modifier
                                        </a>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/20 hover:bg-red-500/50 text-red-400 px-4 py-2 rounded-full transition-colors">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center space-y-4 animate__animated animate__fadeInUp">
            <div class="flex justify-center space-x-4">
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="text-gray-500 text-sm">&copy; 2025 Ngue Ngan Result. Tous droits réservés.</p>
        </footer>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script>
            gsap.from('table', { 
                opacity: 0, 
                y: 60, 
                duration: 1, 
                delay: 0.4 
            });
            gsap.from('footer', {
                opacity: 0,
                y: 30,
                duration: 1,
                delay: 0.6
            });
        </script>
    @endpush
@endsection
