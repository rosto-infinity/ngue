<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StatsController;  
use App\Http\Controllers\ResultController; 
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome'); 
// });

Route::get('/', [CourseController::class, 'welcome'])->name("debut.welcome");
Route::get('login', [AuthController::class, "index"])->name('login');
Route::post('login', [AuthController::class, "Customlogin"])->name('login.user');
Route::get('register', [AuthController::class, "registration"])->name('register');
// Route::get('register', [AuthController::class, "registration"])->name('register')->middleware('auth');
Route::post('register', [AuthController::class, "customRegistration"])->name('register.user');
Route::post('signout', [AuthController::class, "signout"])->name('signout');

// Routes réservées à l'admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('filieres', [FiliereController::class, 'index'])->name('filieres.index');
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('statistics', [StatsController::class, 'index'])->name('statistics.index');
});

// Route d'authentification
Route::post('/signin', [AuthController::class, 'signIn'])->name('signin');

// Routes protégées par rôle
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/student', [StudentController::class, 'index'])->name('student');
// });

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/exams/show_result', [ResultController::class, 'index'])->name('exams.show_result');
});

// Déconnexion
Route::post('/signout', [AuthController::class, 'signOut'])->name('signout');


Route::get("/exams/resultats/show", [ExamController::class, "showresult"])->name("showResultat");
// Définir la route pour afficher les résultats avec la nouvelle méthode
Route::get('/exams/show_result', [ExamController::class, 'showResultDetails'])->name('exams.show_result');
Route::get('/exams/show_result', [ExamController::class, 'showResult'])->name('exams.show_result');


Route::get('/exams/{id}/details', [ExamController::class, 'showResultDetails'])->name('exams.details');



Route::get('/resultats/search', [ResultatController::class, 'search'])->name('resultats.search');


// Route::middleware("auth")->group(function () {

    Route::prefix("filieres")->group(function () {

        Route::get("/", [FiliereController::class, 'index'])->name("filieres.index");
        Route::get('/create', [FiliereController::class, 'create'])->name("filieres.create");
        Route::post('/', [FiliereController::class, 'store'])->name("filieres.store");
        Route::get('/{filiere}', [FiliereController::class, "edit"])->name("filieres.edit");
        Route::put('/{id}', [FiliereController::class, 'update'])->name('filieres.update');
        Route::delete('/{filiere}', [FiliereController::class, 'destroy'])->name('filieres.destroy');
    });
// });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name("courses.index");
        Route::get('/create', [CourseController::class, 'create'])->name("courses.create");
        Route::post('/', [CourseController::class, 'store'])->name("courses.store");
        Route::get('/{course}', [CourseController::class, "edit"])->name("courses.edit");
        Route::put('/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create'); // Retiré /students
        Route::post('/', [StudentController::class, 'store'])->name('students.store'); // Retiré /students
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('students.edit'); // Ajusté pour cohérence
        Route::put('/{student}', [StudentController::class, 'update'])->name('students.update'); // Uniformisé {student}
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });
    Route::prefix('exams')->group(function () {
        Route::get('/exams/resultats/create', [ExamController::class, 'create'])->name('exams.results.create');
        Route::get('/exams/store_note', [ExamController::class, 'createNote'])->name('exams.store_note');
Route::post('/exams/store_note', [ExamController::class, 'showresult'])->name('exams.store_note');

        Route::post("resultats", [ExamController::class, "storeResultat"])->name("exams.results.store");
        Route::get('/', [ExamController::class, 'index'])->name("exams.index");
        Route::get('/create', [ExamController::class, 'create'])->name("exams.create");
        Route::post('/', [ExamController::class, 'store'])->name("exams.store");
        Route::get('/{exam}', [ExamController::class, "edit"])->name("exams.edit");
        Route::put('/{id}', [ExamController::class, 'update'])->name('exams.update');
        Route::delete('/{course}', [ExamController::class, 'destroy'])->name('exams.destroy');
    });





// Route pour afficher tous les résultats
Route::get('resultats', [ResultatController::class, 'index'])->name('resultats.index');

// Route pour rechercher des résultats par nom d'étudiant
Route::get('resultats/search', [ResultatController::class, 'search'])->name('resultats.search');

Route::get('/resultats/{id}/details', [ResultatController::class, 'details'])->name('exams.details');



// Route::get('/statistiques', [StatsController::class, 'index'])->name('stats.index');
// routes/web.php


Route::get('/resultats/statistics', [ResultatController::class, 'statistics'])->name('resultats.statistics');
// routes/web.php



Route::get('/statistics', [StatsController::class, 'index'])->name('statistics.index');


// Page de connexion
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'Customlogin'])->name('login.custom');

// Déconnexion
Route::post('signout', [AuthController::class, 'signOut'])->name('signout');

// Page des résultats (accessible uniquement aux utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::get('resultats', [ResultController::class, 'index'])->name('showResultat');
});


