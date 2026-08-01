<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'statut' => 'required|string',
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        Session::put('auth_user', [
            'login' => $request->input('login'),
            'statut' => $request->input('statut'),
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
