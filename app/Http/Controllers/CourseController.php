<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        // Retrieve all courses from the database
        $courses = course::all();

        return view('courses.index', compact('courses'));
    }

    public function create() {
        
       return view('courses.create');
    }

    public function store(Request $request){

        $validateData = $request->validate([
            "name"=>'required',
            "description"=>"required",
        ]);
        Course::create($validateData);
        return redirect()->route('courses.index')->with('succes',"cours enregistrer avec success");
    }

    public function  edit(Course $course){
        return view("courses.edit",compact("course"));
    }

    public function update(Request $request,int $id){
        $validateData = $request->validate([
            "name"=>'required',
            "description"=>"required",
        ]);
        Course:: where('id'.$id)->update($validateData);

        return redirect()->route('courses.index')->with('succes',"cours modifier avec success");
    }

    public function welcome() {
        return view("debut.welcome");
    }
    
}
