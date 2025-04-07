<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;
    protected $fillable =[
        "note",
        "student_id",
        "exam_id",
        "grade"
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function details($id)
{
    $resultat = Resultat::with(['student.filiere', 'exam.course'])->findOrFail($id);
    return view('resultats.details', compact('resultat'));
}

}
