<?php

// app/Models/Filiere.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    
    protected $fillable = ["name"];

    // Corriger la méthode 'student' pour la relation avec 'Student'
    public function students()  // Le nom de la méthode doit être 'students' pour refléter la relation
    {
        return $this->hasMany(Student::class, 'filiere_id');  // Utilise le bon nom de la classe et la clé étrangère
    }
}
