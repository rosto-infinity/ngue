<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model  // Remarquez que le nom de la classe commence par une majuscule
{
    use HasFactory;

    protected $fillable = [
        "name",
        "descriptions",
    ];

    // Relation avec les examens (un cours peut avoir plusieurs examens)
    public function exams()
    {
        return $this->hasMany(Exam::class);  // Relation one-to-many avec le modèle Exam
    }
}

