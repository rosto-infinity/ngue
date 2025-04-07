<?php
// app/Http/Controllers/StatsController.php

namespace App\Http\Controllers;

use App\Models\Resultat;
use App\Models\Filiere;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        // Calculer la moyenne des notes par examen
        $examStatistics = Resultat::selectRaw('exam_id, AVG(note) as average_note, COUNT(student_id) as number_of_students')
            ->groupBy('exam_id')
            ->get();

        // Compter le nombre d'étudiants par filière
        $filiereStatistics = Filiere::withCount('students')->get();

        // Répartition des grades (statistiques par grade)
        $gradeStatistics = Resultat::selectRaw('grade, COUNT(*) as count')
            ->groupBy('grade')
            ->get();

        return view('statistics.index', compact('examStatistics', 'filiereStatistics', 'gradeStatistics'));
    }
}
