<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Resultat;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCache\ResultCache;
use PHPUnit\TextUI\XmlConfiguration\ValidationResult;

class ExamController extends Controller
{
    public function index(){
    
        $courses = Course::with('exams')->get();
        $exams = Exam::with("course")->get();
        return view('exams.index', compact('courses','exams'));
    }
    public function create(){
        $courses = course::all();
        return view("exams.create",compact("courses"));
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'title'=>"required",
            'date'=>"required|date",
            'course_id'=>"required|exists:courses,id",
           
        ]);
        Exam::create($validateData);
        return redirect()->route('exams.index')->with('success',"Examens creer avec succès");
    
    }

    public function edit(Exam $exam)
    {
        // Récupérer tous les cours disponibles
        $courses = Course::all();
    
        // Passer l'examen et les cours à la vue
        return view('exams.edit', compact('exam', 'courses'));
    }
    

    public function update(Request $request, int $id){

        $validateData = $request->validate([
            'title'=>"required",
            'date'=>"required|date",
            'course_id'=>"required|exists:courses,id",
        ]);
    
        Exam::where('id',$id)->update($validateData);
        return redirect()->route('exams.index')->with('success',"Examen modifiée avec succès");
    }
    public function show(Exam $exam) {
        $examDetails = Exam::with('course', 'resultats.student')->find($exam->id);
        return view('exams.show', compact('examDetails'));
    }
    // Dans le contrôleur ExamsController.php


    

    public function destroy(Exam $exam){
        $result=$exam->delete();
        if($result){
        return redirect()->route('exams.index')->with('success',"Filiere supprimée avec succès");
    }else{
        return redirect()->route('exams.index')->with('error',"Echec de suppression");
    }
    }
    public function createNote(){
        $students=Student::all();
        $exams= Exam::all();
        return view('exams.store_note',compact('students','exams'));
    }
    public function storeResultat(Request $request){
        $validateData = $request->validate([
           'student_id'=>"required|exists:students,id",
            'exam_id'=>"required|exists:exams,id",
            'note'=>"required",
        ]);
        $note = $request->note;
        $grade="nulle";

        if($note<=5){
            $grade = "nulle";
        }elseif($note<=7){
            $grade = "faible";
    }elseif($note<=9){
        $grade="insuffisante";    
} elseif($note<=11){
    $grade="passable";    
}elseif($note<=13){
    $grade="assez bien";
}elseif($note<15){
    $grade="bien";
}elseif($note<17){
    $grade="tres bien";
}elseif($note<=19){
    $grade= "excellente";
        }elseif($note<=20){
            $grade="honorable";
    }
     
    Resultat::create([
        "note"=>$validateData['note'],
        "student_id"=>$validateData['student_id'],
        "exam_id"=>$validateData['exam_id'],
        "grade"=>$grade
    ]);
    
    return redirect()->route('exams.index')->with('success',"Note enregistrée avec succès");
    }
    // public function showresult(){
    //     $results = Resultat::with('student')->get();
    //     return view("exams.show_result",compact("results"));
    // }
    // Exemple de méthode dans le contrôleur
    public function showResult()
    {
        $resultats = Resultat::with(['student', 'exam'])->get();
        return view('exams.show_result', compact('resultats'));
    }
    
    
// App\Http\Controllers\ExamController.php


    // Votre méthode showResultDetails
  // Importez le modèle Resultat
    
    
    
  public function showResultDetails($id)
  {
      $resultat = Resultat::with(['student', 'exam'])->findOrFail($id);
      return view('exams.result_details', compact('resultat'));
  }
  
    }
    




