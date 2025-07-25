<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

       
        if (! $user) {
            throw new AuthenticationException('Utilisateur introuvable.');
        }

        if (! Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            throw new AuthenticationException('Mot de passe incorrect.');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user->load('role')),
            'token' => $token,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $roleParDefaut = Role::firstOrCreate(['nom' => 'user']);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => $request->mot_de_passe,
            'telephone' => $request->telephone,
            'role_id' => $roleParDefaut->id,
            'date_inscription' => now(),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user->load('role')),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
