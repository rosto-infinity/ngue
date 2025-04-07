@extends('layouts.app')

@section('title', 'Détails de la Matière')

@section('content')
<!-- Logo centré au-dessus du formulaire -->
<div class="flex justify-center items-center space-x-3 mb-6">
    <img src="{{ asset('images/logi.jpg') }}" alt="Logo NgueNganResult" class="h-10 w-auto">
    <span class="text-3xl font-extrabold">NgueNgan<span class="text-teal-400">Result</span></span>
</div>

<!-- Formulaire des Détails de la Matière -->
<div class="max-w-2xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold text-white mb-4 animate__animated animate__fadeIn animate__delay-0.5s">📄 Détails de la Matière</h2>

    <!-- Vérification des relations -->
    @if($resultat && $resultat->student)
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-1s"><strong>👤 Étudiant :</strong> {{ $resultat->student->firstname }} {{ $resultat->student->lastname }}</p>
    @else
        <p class="text-lg text-red-500 mb-2">👤 Étudiant non trouvé.</p>
    @endif

    @if($resultat && $resultat->student && $resultat->student->filiere)
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-1.5s"><strong>🎓 Filière :</strong> {{ $resultat->student->filiere->name }}</p>
    @else
        <p class="text-lg text-red-500 mb-2">🎓 Filière non trouvée.</p>
    @endif

    <hr class="my-4 border-gray-600">

    @if($resultat && $resultat->exam && $resultat->exam->course)
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-2s"><strong>✅ Matière :</strong> {{ $resultat->exam->course->name }}</p>
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-2.5s"><strong>📝 Description :</strong> {{ $resultat->exam->course->descriptions }}</p>
    @else
        <p class="text-lg text-red-500 mb-2">✅ Matière ou description non trouvée.</p>
    @endif

    @if($resultat && $resultat->exam)
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-3s"><strong>📌 Examen :</strong> {{ $resultat->exam->title }}</p>
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-3.5s"><strong>📅 Date :</strong> {{ $resultat->exam->date }}</p>
    @else
        <p class="text-lg text-red-500 mb-2">📌 Examen ou date non trouvée.</p>
    @endif

    @if($resultat)
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-4s"><strong>🎯 Note :</strong> {{ $resultat->note }} / 20</p>
        <p class="text-lg text-white mb-2 animate__animated animate__fadeIn animate__delay-4.5s"><strong>🏆 Mention :</strong> {{ $resultat->grade }}</p>
    @else
        <p class="text-lg text-red-500 mb-2">🎯 Note ou mention non trouvée.</p>
    @endif

    <a href="{{ route('exams.show_result') }}" class="mt-6 inline-block bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600 transition duration-300">
        ⬅ Retour
    </a>
</div>

<!-- Footer explicatif -->
<footer class="bg-gray-800 text-white p-4 mt-10 text-center animate__animated animate__fadeIn animate__delay-5s">
    <p class="text-lg">Cette page affiche les détails relatifs à une matière d'examen pour un étudiant particulier. Vous pouvez voir des informations sur l'examen, la matière, la note obtenue, ainsi que la mention reçue. Utilisez le bouton ci-dessus pour revenir à la liste des examens.</p>
</footer>

@endsection
