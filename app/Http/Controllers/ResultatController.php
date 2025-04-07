<?php
namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Resultat;  // Modèle Resultat
use Illuminate\Http\Request;

class ResultatController extends Controller
{
    // Méthode pour afficher tous les résultats
    public function index()
    {
        $results = Resultat::all();
        return view('resultats.index', compact('results'));
    }

    // Méthode pour rechercher les résultats par nom d'étudiant
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Resultat::whereHas('student', function($queryBuilder) use ($query) {
                            $queryBuilder->where('firstname', 'like', "%$query%")
                                         ->orWhere('lastname', 'like', "%$query%");
                        })
                        ->get();
                        return view('exams.show_result', compact('results'));
    }
    public function details($id)
{
    // Récupérer les informations du résultat en fonction de l'ID
    $resultat = Resultat::findOrFail($id);

    // Passer les données à la vue pour afficher les détails
    return view('exams.details', compact('resultat'));
}
public function statistics()
{
    // Statistiques par filière
    $filiereStatistics = Filiere::withCount('students')
        ->with(['students' => function($query) {
            $query->with('resultats'); // Récupérer les résultats des étudiants
        }])
        ->get()->map(function ($filiere) {
            // Calculer la moyenne des résultats pour chaque filière
            $totalResults = $filiere->students->flatMap(function ($student) {
                return $student->resultats;
            });
            
            $averageResult = $totalResults->avg('note'); // Calculer la moyenne des notes

            return [
                'name' => $filiere->name,
                'student_count' => $filiere->students_count,
                'average_result' => round($averageResult, 2)
            ];
        });

    // Statistiques globales
    $globalResults = Resultat::all();
    $globalAverage = $globalResults->avg('note'); // Calculer la moyenne globale des résultats

    // Nombre total d'étudiants
    $totalStudents = $globalResults->count();

    return view('resultats.statistics', compact('filiereStatistics', 'globalAverage', 'totalStudents'));
}


}
