@extends('layout')

@section('content')
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white overflow-hidden">
        <!-- Header + Logo -->
        <header class="pt-20 text-center animate__animated animate__fadeInDown">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logi.jpg') }}" alt="Logo" class="h-16 w-16 rounded-full shadow-lg border-2 border-teal-400">
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-white mb-2">
                Modification d'un Cours
            </h1>
            <p class="text-gray-400 text-lg">Mettez à jour les détails de votre cours</p>
        </header>

        <!-- Contenu principal -->
        <main class="flex-grow pt-10 px-6">
            <div class="max-w-4xl mx-auto mt-8">
                <!-- Formulaire de modification -->
                <div class="bg-[#112825]/90 rounded-xl shadow-2xl overflow-hidden border border-gray-800 animate__animated animate__fadeInUp p-6">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nom du cours -->
                        <div class="form-group">
                            <input type="text" name="name" value="{{ $course->name }}" class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                            @error('name')
                                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description du cours -->
                        <div class="form-group">
                            <textarea name="description" class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" rows="6">{{ $course->description }}</textarea>
                            @error('description')
                                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="flex space-x-4">
                            <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-full shadow-md transition-colors">
                                Modifier
                            </button>
                            <a href="{{ route('courses.index') }}" class="w-full bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 rounded-full text-center shadow-md transition-colors">
                                Annuler
                            </a>
                        </div>
                    </form>
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
            gsap.from('form', { 
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
