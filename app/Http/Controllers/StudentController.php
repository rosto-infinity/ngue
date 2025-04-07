<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //liste dees etudiants et des filieres

    public function index(){
        $students =Student::with("filiere")->get();
        $filieres =Filiere::all();
        return view("students.index",compact("filieres","students"));
    }

    public function create(){

        $filieres = Filiere::all(); // Récupérer toutes les filières
        return view('students.create', compact('filieres'));
    }
    public function store(Request $request){

        $validateData = $request->validate([
            "firstname"=>"required",
            "lastname"=>"required",
            "email"=>"required|email",
            "mobile"=>"required|min:8",
            "filiere_id"=>"required|exists:filieres,id"
        ]);
// die;
        Student::create($validateData);
        return redirect()->route("students.index")->with("success","Etudiant cree avec success");
    } 

    public function edit(Student $student){
        $filieres=Filiere::all();
        return view("students.edit",compact("student","filieres"));
    }

    public function update(Request $request,int $id){
        $validateData = $request->validate([
            "firstname"=>"required",
            "lastname"=>"required",
            "email"=>"required|email",
            "mobile"=>"required|min:8",
            "filiere_id"=>"required|exists:filieres,id"
        ]);
        Student::where("id",$id)->update($validateData);
        return redirect()->route("students.index")->with("success","Apprenant modifier avec success");
    }

    public function destroy(Student $student){
        $result =$student->delete();

        if($result){
            return redirect()->route("students.index")->with("success","Apprenant supprimer avec success");
        }else{
            return redirect()->route("students.index")->with("error","Echec de suppression");
        }
    }

} 
