@extends('layout')

@section('content')
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white overflow-hidden">
        <!-- Titre + Logo -->
        <header class="pt-20 text-center animate__animated animate__fadeInDown">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logi.jpg') }}" alt="Logo" class="w-24 h-24 rounded-full shadow-lg border-2 border-white-400">
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-white mb-2">
                Modification 
            </h1>
            <p class="text-gray-400 text-lg">Mettez à jour les informations de l'étudiant</p>
        </header>

        <!-- Formulaire -->
        <main class="flex-grow flex items-center justify-center px-6">
            <div class="max-w-md w-full bg-[#0f172a]/80 backdrop-blur-md border border-gray-700 shadow-2xl rounded-2xl p-8 animate__animated animate__fadeInUp">
                <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Prénom -->
                    <div class="relative">
                        <label for="firstname" class="text-gray-300">Prénom</label>
                        <input type="text" name="firstname" value="{{ $student->firstname }}" class="w-full mt-1 px-4 py-3 bg-gray-900/60 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                        @error('firstname')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div class="relative">
                        <label for="lastname" class="text-gray-300">Nom</label>
                        <input type="text" name="lastname" value="{{ $student->lastname }}" class="w-full mt-1 px-4 py-3 bg-gray-900/60 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                        @error('lastname')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <label for="email" class="text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ $student->email }}" class="w-full mt-1 px-4 py-3 bg-gray-900/60 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                        @error('email')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div class="relative">
                        <label for="mobile" class="text-gray-300">Mobile</label>
                        <input type="text" name="mobile" value="{{ $student->mobile }}" class="w-full mt-1 px-4 py-3 bg-gray-900/60 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                        @error('mobile')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Filière -->
                    <div class="relative">
                        <label for="filiere_id" class="text-gray-300">Filière</label>
                        <select name="filiere_id" class="w-full mt-1 px-4 py-3 bg-gray-900/60 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                            <option value="">-- Sélectionner une filière --</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ $filiere->id == $student->filiere_id ? 'selected' : '' }}>
                                    {{ $filiere->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('filiere_id')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="flex space-x-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3 rounded-full shadow-lg transition-all duration-300">
                            Modifier
                        </button>
                        <a href="{{ route('students.index') }}" class="w-full bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 rounded-full text-center shadow-md transition-colors">
                            Annuler
                        </a>
                    </div>
                </form>
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
