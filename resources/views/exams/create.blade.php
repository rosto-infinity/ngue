@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg bg-[#112825]/90 shadow-2xl rounded-xl p-8 border border-gray-800 transform transition-all hover:scale-105">
        <!-- Titre stylisé -->
        <h1 class="text-3xl md:text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-300 mb-8">
            Ajout d'un Examen
        </h1>

        <!-- Formulaire -->
        <form action="{{ route('exams.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Champ Titre -->
            <div class="form-group">
                <input type="text" name="title" placeholder="Titre de l'examen" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-200 placeholder-gray-500 
                              focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all shadow-sm"
                       value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Date -->
            <div class="form-group">
                <input type="datetime-local" name="date" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-200 
                              focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all shadow-sm"
                       value="{{ old('date') }}" required>
                @error('date')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Cours -->
            <div class="form-group">
                <select name="course_id" 
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-200 
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all shadow-sm" required>
                    <option value="">-- Sélectionner un cours --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button type="submit" 
                        class="w-full sm:w-auto bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-3 rounded-full 
                               shadow-md transition-all hover:scale-105">
                    Ajouter
                </button>
                <a href="{{ route('exams.index') }}" 
                   class="w-full sm:w-auto bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-full 
                          shadow-md transition-all hover:scale-105 text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Ombre légère pour le titre */
    h1 {
        text-shadow: 0 2px 8px rgba(20, 184, 166, 0.4);
    }
    /* Amélioration de l'apparence des champs */
    input, select {
        appearance: none; /* Supprime les styles natifs */
    }
</style>
@endpush