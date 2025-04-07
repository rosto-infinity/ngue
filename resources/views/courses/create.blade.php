@extends('layout')

@section('content')
    <!-- Contenu principal -->
    <div class="pt-20 px-6 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-auto">
            <!-- Titre -->
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-6 text-center">Ajout d'un Cours</h1>

            <!-- Formulaire -->
            <div class="bg-[#112825]/90 backdrop-blur-md rounded-xl shadow-xl p-6 border border-gray-800">
                <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nom du cours -->
                    <div>
                        <input type="text" name="name" placeholder="Nom du cours" class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all" required>
                        @error('name')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description du cours -->
                    <div>
                        <textarea name="description" placeholder="Description du cours" class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all min-h-[100px]"></textarea>
                        @error('description')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="flex space-x-4">
                        <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-full shadow-md transition-colors">
                            Ajouter
                        </button>
                        <a href="{{ route('courses.index') }}" class="w-full bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 rounded-full text-center shadow-md transition-colors">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection