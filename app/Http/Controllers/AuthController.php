<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'statut' => 'required|in:admin,client,livreur,agence',
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $utilisateur = Utilisateur::query()
            ->where('login', $validated['login'])
            ->where('statue', $validated['statut'])
            ->where('password', $validated['password'])
            ->where('statut', 'actif')
            ->first();

        if (! $utilisateur) {
            return back()
                ->withInput($request->only('statut', 'login'))
                ->withErrors(['login' => 'Identifiants incorrects ou compte suspendu.']);
        }

        Session::put('auth_user', [
            'id' => $utilisateur->id,
            'login' => $utilisateur->login,
            'nom_complet' => $utilisateur->nom_complet,
            'statut' => $utilisateur->statue,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'telephone' => ['required', 'string', 'regex:/^00212\d+$/'],
            'email' => 'required|email|max:255',
            'ville' => 'required|string|max:255',
            'password' => 'required|string|min:10|confirmed',
            'magasin' => 'required|string|max:255',
            'cin' => 'required|string|max:50',
            'banque' => 'required|string|max:255',
            'rib' => 'required|string|max:64',
        ], [
            'telephone.regex' => 'Le téléphone doit commencer par 00212.',
            'password.min' => 'Le mot de passe doit contenir au moins 10 chiffres, lettres ou signes.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        Inscription::create([
            ...$validated,
            'statut' => 'en_attente',
        ]);

        return redirect()
            ->route('home')
            ->with('register_success', 'Merci pour votre confiance. Nous vous contacterons dès que la confirmation sera effectuée.');
    }

    public function logout()
    {
        Session::forget('auth_user');

        return redirect()->route('home');
    }
}
