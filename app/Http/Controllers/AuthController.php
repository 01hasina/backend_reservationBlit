<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Login API
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        // Trouver l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response()->json(['message' => 'user introuvable'], 401);
        }
        if(! Hash::check($request->mot_de_passe, $user->mot_de_passe)){
            return response()->json(['message' => 'mot de passe incorrect'], 401);
        }

        // Créer un token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Register function
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mot_de_passe' => 'required|string|min:6|confirmed',
            'telephone' => 'nullable|string|max:20',
            'role_id' => 'nullable|integer|exists:roles,id', // ou personnalise selon les rôles que tu autorises
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => $request->mot_de_passe,
            'telephone' => $request->telephone,
            'role_id' => $request->role_id ?? 2, // 2 = par exemple 'user', 1 = admin
            'date_inscription' => now(),
        ]);        

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Logout API (révoque tous les tokens de l’utilisateur)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
