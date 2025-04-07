@extends('layout')

@section('content')
    <div class="wrapper w-full md:w-3/4 lg:w-2/3 xl:w-1/2 shadow-lg rounded-xl bg-slate-800 p-6 mx-auto mt-10">
        <!-- Titre avec animation -->
        <h1 class="text-3xl font-semibold text-teal-600 mb-8 text-center opacity-0 animate__animated animate__fadeIn animate__delay-1s">
            Modification d'un examen
        </h1>

        <!-- Formulaire de modification -->
        <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Champ Titre -->
            <div class="form-group mb-3">
                <label for="title" class="text-lg font-medium text-gray-200">Titre de l'examen</label>
                <input type="text" name="title" id="title" value="{{ $exam->title }}" class="form-control w-full p-3 border-2 border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition-all">
                @error('title')
                    <div class="text-danger text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Champ Date -->
            <div class="form-group mb-3">
                <label for="date" class="text-lg font-medium text-slate-200">Date de l'examen</label>
                <input type="datetime-local" name="date" id="date" value="{{ $exam->date }}" class="form-control w-full p-3 border-2 border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition-all">
                @error('date')
                    <div class="text-danger text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sélecteur de Cours -->
            <div class="form-group mb-3">
                <label for="course_id" class="text-lg font-medium text-gray-200">Sélectionner un cours</label>
                <select name="course_id" id="course_id" class="form-control w-full p-3 border-2 border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition-all">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @if ($course->id == $exam->course_id) selected @endif>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="text-danger text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Boutons de soumission -->
            <div class="flex justify-between">
                <button type="submit" class="btn btn-success w-full md:w-auto bg-teal-500 hover:bg-teal-600 text-white py-2 px-6 rounded-full shadow-md transition-all hover:scale-105 focus:outline-none">Modifier</button>
                <a href="{{ route('exams.index') }}" class="btn btn-info w-full md:w-auto bg-gray-500 hover:bg-gray-600 text-gray-100 py-2 px-6 rounded-full shadow-md transition-all hover:scale-105 focus:outline-none">Annuler</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Animation du titre
        setTimeout(() => {
            document.querySelector('h1').classList.remove('opacity-0');
            document.querySelector('h1').classList.add('opacity-100');
        }, 500);
    </script>
@endsection
