<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function customlogin(Request $request)
{
    // Valider les données envoyées dans le formulaire de connexion
    $credentials = $request->only('email', 'password');  // Ici on récupère les informations du formulaire

    // Tenter de connecter l'utilisateur avec les informations d'identification
    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        
        // Vérifie si l'utilisateur est un administrateur
        if ($user->role === 'admin') {
            // Si l'utilisateur est un administrateur, tu peux le rediriger vers une autre page
            return redirect()->route('students.index')->withSuccess("Connexion réussie");
        }

        // Si l'utilisateur n'est pas un administrateur, redirige vers la page des résultats
        return redirect()->route('exams.show_result')->withSuccess("Connexion réussie");
    }

    // Si les informations de connexion sont invalides, redirige vers la page de login avec un message d'erreur
    return redirect('login')->withErrors(['email' => 'Les détails de connexion ne sont pas valides']);
}
    public function registration(){
        
        return view('auth.register');
    }

    //Enregistrement de la peersonne
    public function customRegistration(Request $request){
        
        
        $request->validate([
            "email"=>"required|email",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:8"
        ]);
        $data = $request->all();

        $check = User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "password"=>Hash::make($data["password"])
        ]);
        if($check){
            Auth::attempt(["email"=>$data["email"],"password"=>$data["password"]]);
            return redirect()->route("exams.show_result")->withSuccess("Enregistrement réussi");

        }
        return redirect()->route("register")->withErrors("Erreur lors de l'enregistrement");
    }
    
    public function signOut(){
        Session::flush();
        Auth::logout();
        return redirect("login");
    }

    public function signIn(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8"
        ]);
    
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $user = Auth::user();
    
            if ($user->role === 'admin') {
                return redirect()->route("dashboard");
            } else {
                return redirect()->route("exams.show_result");

            }
        }
    
        return redirect()->back()->withErrors(["email" => "Identifiants incorrects"]);
    }
}
