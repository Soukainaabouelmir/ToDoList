<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{

    // la vue
    public function create()
    {
        return view('auth.login');
    }

    //La methode pour se connecter
    public function store(Request $request)
    {
       //pour valider les donnees
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

     // verfier le role l'utilisateur
        if (Auth::attempt($request->only('email', 'password'))) {
        
            $user = Auth::user();

            
            if ($user->role == 'admin') {
              
                return redirect()->route('tasks.index');
            }   
        }

        return back()->withErrors([
            'email' => 'email au mot de pass est incorrecte.',
        ]);
    }


    // La methode pour se deconnecter
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }










// // register



// public function showRegistrationForm()
// {
//     return view('auth.register');
// }

// // Gérer l'inscription
// public function register(Request $request)
// {
//     // Validation des champs du formulaire
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'role_id' => 'required',
//         'email' => 'required|string|email|max:255|unique:users,email',
//         'password' => 'required|string|min:8|confirmed',
//     ]);

//     // Créer un utilisateur avec les données validées en utilisant DB
//     $userId = DB::table('users')->insertGetId([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         'role_id' => $validated['role_id'],
//         'password' => Hash::make($validated['password']),
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     // Récupérer l'utilisateur créé
//     $user = DB::table('users')->where('id', $userId)->first();

//     // Connecter automatiquement l'utilisateur
//     auth()->loginUsingId($user->id);

   
//     return redirect()->route('home')->with('status', 'Inscription réussie!');
// }

}
