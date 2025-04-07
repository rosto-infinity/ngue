@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-900 pt-20 px-6">
    <div class="max-w-4xl mx-auto mt-8">
        <!-- Titre stylisé -->
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-300 mb-8 text-center opacity-0" id="page-title">
            Liste des Examens
        </h1>

        <!-- Boutons d'action -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('exams.create') }}" class="w-full sm:w-auto bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transition-all transform hover:scale-105">
                Ajouter un examen
            </a>
            <a href="{{ route('exams.store_note') }}" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transition-all transform hover:scale-105">
                Enregistrer les notes
            </a>
        </div>

        <!-- Message de succès -->
        @if (session()->has('success'))
            <div class="bg-teal-500/20 text-teal-300 p-4 rounded-lg mb-6 text-center shadow-md">
                {{ session()->get('success') }}
            </div>
        @endif

        <!-- Tableau stylisé -->
        <div class="bg-[#112825]/90 rounded-xl shadow-xl overflow-hidden border border-gray-800">
            <table class="w-full text-white table-auto">
                <thead>
                    <tr class="bg-gradient-to-r from-teal-600 to-teal-800 text-white uppercase text-sm tracking-wider">
                        <th class="py-4 px-6 text-left font-semibold">#</th>
                        <th class="py-4 px-6 text-left font-semibold">Titre</th>
                        <th class="py-4 px-6 text-left font-semibold">Date</th>
                        <th class="py-4 px-6 text-left font-semibold">Cours</th>
                        <th class="py-4 px-6 text-left font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam)
                        <tr class="border-b border-gray-700 hover:bg-gray-800/50 transition-all duration-300">
                            <td class="py-4 px-6 text-gray-200">{{ $exam->id }}</td>
                            <td class="py-4 px-6 text-gray-200 font-medium">{{ $exam->title }}</td>
                            <td class="py-4 px-6 text-gray-300">{{ $exam->date }}</td>
                            <td class="py-4 px-6 text-gray-300">{{ $exam->course->name }}</td>
                            <td class="py-4 px-6 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="{{ route('exams.edit', $exam->id) }}" class="bg-teal-500 hover:bg-teal-600 text-white font-medium px-4 py-2 rounded-full transition-all transform hover:scale-105 shadow-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/20 hover:bg-red-500/40 text-red-300 font-medium px-4 py-2 rounded-full transition-all transform hover:scale-105 shadow-sm">
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
</div>
@endsection

@push('styles')
<style>
    /* Ombre légère pour le titre */
    #page-title {
        text-shadow: 0 2px 8px rgba(20, 184, 166, 0.4);
    }
    /* Amélioration de la lisibilité du tableau */
    table {
        border-collapse: collapse;
    }
    td, th {
        word-wrap: break-word;
    }
</style>
@endpush

@push('scripts')
<!-- Importation de GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    // Animation du titre
    gsap.fromTo("#page-title", 
        { opacity: 0, y: 50 }, 
        { opacity: 1, y: 0, duration: 1.5, ease: "power3.out", delay: 0.3 }
    );
</script>
@endpush