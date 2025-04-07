<?php
namespace App\Http\Controllers;

use App\Models\Result; // Modèle Result
use App\Models\Student; // Modèle Student
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Méthode pour afficher tous les résultats
    public function index()
    {
        // Récupérer tous les résultats
        $results = Result::all();

        // Retourne la vue avec les résultats
        return view('exams.show_result', compact('results'));
    }

    // Méthode pour rechercher les résultats par nom d'étudiant
    public function search(Request $request)
    {
        // Récupère le terme de recherche (nom de l'étudiant)
        $query = $request->input('query');
        
        // Recherche les résultats dont le nom de l'étudiant correspond à la recherche
        $results = Result::whereHas('student', function($queryBuilder) use ($query) {
                            $queryBuilder->where('firstname', 'like', "%$query%")
                                         ->orWhere('lastname', 'like', "%$query%");
                        })
                        ->get();

        // Renvoie la vue avec les résultats trouvés
        return view('exams.show_result', compact('results'));
    }
}
