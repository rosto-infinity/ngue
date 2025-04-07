@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-[#1E293B] text-white p-8 rounded-xl shadow-lg mt-12">
    <h1 class="text-3xl font-bold text-center mb-6 text-teal-500">Enregistrer une note</h1>

    <form action="{{ route('exams.results.store') }}" method="POST">
        @csrf

        <div class="form-group mb-5">
            <label for="student_id" class="block text-lg font-semibold mb-2">Sélectionner l'étudiant</label>
            <select name="student_id" class="form-control w-full p-3 bg-[#334155] border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">-- Choisissez un étudiant --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->firstname . ' ' . $student->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-5">
            <label for="exam_id" class="block text-lg font-semibold mb-2">Sélectionner l'examen</label>
            <select name="exam_id" class="form-control w-full p-3 bg-[#334155] border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">-- Choisissez un examen --</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-5">
            <label for="note" class="block text-lg font-semibold mb-2">Note de l'examen</label>
            <input type="number" name="note" placeholder="Entrez la note" class="form-control w-full p-3 bg-[#334155] border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('exams.index') }}" class="btn bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-all duration-300">Annuler</a>
            <button type="submit" class="btn bg-teal-500 text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition-all duration-300">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
