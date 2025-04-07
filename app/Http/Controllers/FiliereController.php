<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Student;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    //la liste filiere

        public function index(){
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }
    //formulaire 

    public function create(){
        $filieres = Filiere::all(); // Récupérer toutes les filières
        return view('filieres.create', compact('filieres'));
    }
    //Enregistrement de la filieres


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>"required"
        ]);

        Filiere::create($validateData);
        return redirect()->route('filieres.index')->with('success',"Filiere enregistrer avec succès");

    }
    public function edit(Filiere $filiere) {

        return view('filieres.edit',compact('filiere'));
}
public function update(Request $request, int $id){

    $validateData = $request->validate([
        'name'=>"required"
    ]);

    Filiere::where('id',$id)->update($validateData);
    return redirect()->route('filieres.index')->with('success',"Filiere modifiée avec succès");
}
public function destroy(Filiere $filiere){
    $result=$filiere->delete();
    if($result){
    return redirect()->route('filieres.index')->with('success',"Filiere supprimée avec succès");
}else{
    return redirect()->route('filieres.index')->with('error',"Echec de suppression");
}
}
   // Définir la relation entre Filiere et Student
   public function students()
   {
       return $this->hasMany(Student::class);
   }

public function statistics()
    {
        // Récupérer les statistiques des filières avec le nombre d'étudiants
        $filiereStatistics = Filiere::withCount('students')->get();

        // Passer les statistiques à la vue
        return view('filieres.statistics', compact('filiereStatistics'));
    }

}


