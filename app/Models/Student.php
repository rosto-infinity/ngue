<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'mobile', 'filiere_id'];

    // Relation avec la table Resultat : un étudiant peut avoir plusieurs résultats
    public function index()
    {
        // Charger les étudiants avec leurs filières et résultats associés
        $students = Student::with(['filiere', 'resultats'])->get();
        $filieres = Filiere::all();  // Récupérer toutes les filières
    
        return view("students.index", compact("filieres", "students"));
    }
    

    public function resultats()
    {
        return $this->hasMany(Resultat::class, 'student_id'); // Assure-toi que 'student_id' est la clé étrangère
    }

    // Relation avec la table Filiere : un étudiant appartient à une filière
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filiere_id'); // Assure-toi que 'filiere_id' est la clé étrangère
    }
}
