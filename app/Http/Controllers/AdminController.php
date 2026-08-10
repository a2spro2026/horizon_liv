<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Partenaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View|RedirectResponse
    {
        return $this->render('dashboard');
    }

    public function section(string $section): View|RedirectResponse
    {
        $allowed = [
            'dashboard',
            'partenaires',
            'fiche-partenaire',
            'balance-partenaire',
            'commandes',
            'paiement',
            'parametres',
            'nvx-insc',
            'livreurs',
            'rapports',
            'configurations',
            'admin',
        ];

        if (! in_array($section, $allowed, true)) {
            abort(404);
        }

        if ($section === 'partenaires') {
            return redirect()->route('admin.section', 'fiche-partenaire');
        }

        return $this->render($section);
    }

    public function updateInscriptionStatut(Request $request, Inscription $inscription): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'statut' => 'required|in:en_attente,valide,refuse',
        ]);

        $inscription->update(['statut' => $validated['statut']]);

        if ($validated['statut'] === 'valide' && ! $inscription->partenaire) {
            Partenaire::create([
                'inscription_id' => $inscription->id,
                'nom_client' => $inscription->nom_complet,
                'cin' => $inscription->cin,
                'telephone' => $inscription->telephone,
                'email' => $inscription->email,
                'ville' => $inscription->ville,
                'statue' => 'Divers',
                'activite' => $inscription->magasin,
                'statut' => 'actif',
                'magasin' => $inscription->magasin,
                'banque' => $inscription->banque,
                'rib' => $inscription->rib,
                'login' => $inscription->email,
                'password' => $inscription->password,
            ]);
        }

        $message = match ($validated['statut']) {
            'valide' => 'Inscription validée. Le partenaire a été créé.',
            'refuse' => 'Inscription refusée.',
            default => 'Statut remis en attente.',
        };

        return redirect()
            ->route('admin.section', 'nvx-insc')
            ->with('admin_success', $message);
    }

    public function storePartenaire(Request $request): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'statue' => 'required|in:Rev,Ste,Divers',
            'ville' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
        ]);

        $email = strtolower(Str::slug($validated['nom_client'], '.')) . '.' . Str::lower(Str::random(4)) . '@horizonpost.local';

        Partenaire::create([
            'nom_client' => $validated['nom_client'],
            'telephone' => $validated['telephone'],
            'statue' => $validated['statue'],
            'ville' => $validated['ville'],
            'activite' => $validated['activite'],
            'statut' => 'actif',
            'cin' => '',
            'email' => $email,
            'magasin' => $validated['nom_client'],
            'banque' => '',
            'rib' => '',
            'login' => $email,
            'password' => Str::password(12),
        ]);

        return redirect()->route('admin.section', 'fiche-partenaire');
    }

    public function updatePartenaire(Request $request, Partenaire $partenaire): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'statue' => 'required|in:Rev,Ste,Divers',
            'ville' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
        ]);

        $partenaire->update($validated);

        return redirect()->route('admin.section', 'fiche-partenaire');
    }

    public function suspendPartenaire(Partenaire $partenaire): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $partenaire->update([
            'statut' => $partenaire->statut === 'suspendu' ? 'actif' : 'suspendu',
        ]);

        return redirect()->route('admin.section', 'fiche-partenaire');
    }

    public function destroyPartenaire(Partenaire $partenaire): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $partenaire->delete();

        return redirect()->route('admin.section', 'fiche-partenaire');
    }

    private function render(string $section): View|RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $nvxCount = Inscription::enAttente()->count();
        $inscriptions = collect();
        $partenaires = collect();

        if ($section === 'nvx-insc') {
            $inscriptions = Inscription::query()
                ->whereIn('statut', ['en_attente', 'refuse'])
                ->latest()
                ->get();
        }

        if (in_array($section, ['fiche-partenaire', 'balance-partenaire'], true)) {
            $partenaires = Partenaire::query()->latest()->get();
        }

        return view('admin.dashboard', [
            'user' => session('auth_user'),
            'section' => $section,
            'nvxCount' => $nvxCount,
            'inscriptions' => $inscriptions,
            'partenaires' => $partenaires,
        ]);
    }
}
