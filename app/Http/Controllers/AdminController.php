<?php

namespace App\Http\Controllers;

use App\Models\Destinataire;
use App\Models\EtatLivraison;
use App\Models\Inscription;
use App\Models\LivraisonHistorique;
use App\Models\Livreur;
use App\Models\Partenaire;
use App\Models\Utilisateur;
use App\Services\GeocodeService;
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
            'destinataires',
            'fiche-destinataire',
            'historique-livraison',
            'balances-paiement',
            'commandes',
            'paiement',
            'parametres',
            'nvx-insc',
            'livreurs',
            'fiche-livreur',
            'etat-livraison',
            'carte-livreurs',
            'rapports',
            'configurations',
            'utilisateur',
            'admin',
        ];

        if (! in_array($section, $allowed, true)) {
            abort(404);
        }

        if ($section === 'partenaires') {
            return redirect()->route('admin.section', 'fiche-partenaire');
        }

        if ($section === 'destinataires') {
            return redirect()->route('admin.section', 'fiche-destinataire');
        }

        if ($section === 'livreurs') {
            return redirect()->route('admin.section', 'fiche-livreur');
        }

        if ($section === 'configurations') {
            return redirect()->route('admin.section', 'utilisateur');
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

    public function storeDestinataire(Request $request): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'contact' => 'required|string|max:30',
            'ville' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
        ]);

        Destinataire::create([
            ...$validated,
            ...$this->coordsFromVille($validated['ville']),
        ]);

        return redirect()->route('admin.section', 'fiche-destinataire');
    }

    public function storeLivreur(Request $request): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'contact' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'type_paiement' => 'required|in:Salaire,Commission,Pourcentage',
        ]);

        Livreur::create([
            ...$validated,
            'statut' => 'actif',
            ...$this->coordsFromAdresse($validated['adresse'] ?? null, $validated['ville']),
        ]);

        return redirect()->route('admin.section', 'fiche-livreur');
    }

    public function updateLivreur(Request $request, Livreur $livreur): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'contact' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'type_paiement' => 'required|in:Salaire,Commission,Pourcentage',
        ]);

        $payload = $validated;
        $adresseChanged = ($livreur->adresse ?? '') !== ($validated['adresse'] ?? '');
        $villeChanged = $livreur->ville !== $validated['ville'];
        if ($adresseChanged || $villeChanged || ! $livreur->hasPosition()) {
            $payload = [...$payload, ...$this->coordsFromAdresse($validated['adresse'] ?? null, $validated['ville'])];
        }

        $livreur->update($payload);

        return redirect()->route('admin.section', 'fiche-livreur');
    }

    public function suspendLivreur(Livreur $livreur): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $livreur->update([
            'statut' => $livreur->statut === 'suspendu' ? 'actif' : 'suspendu',
        ]);

        return redirect()->route('admin.section', 'fiche-livreur');
    }

    public function storeUtilisateur(Request $request): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'contact' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'statue' => 'required|in:admin,client,livreur,agence',
            'login' => 'required|string|max:255|unique:utilisateurs,login',
            'password' => 'required|string|max:255',
        ]);

        Utilisateur::create([
            ...$validated,
            'statut' => 'actif',
        ]);

        return redirect()->route('admin.section', 'utilisateur');
    }

    public function updateUtilisateur(Request $request, Utilisateur $utilisateur): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'contact' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'statue' => 'required|in:admin,client,livreur,agence',
            'login' => 'required|string|max:255|unique:utilisateurs,login,'.$utilisateur->id,
            'password' => 'required|string|max:255',
        ]);

        $utilisateur->update($validated);

        return redirect()->route('admin.section', 'utilisateur');
    }

    public function suspendUtilisateur(Utilisateur $utilisateur): RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $utilisateur->update([
            'statut' => $utilisateur->statut === 'suspendu' ? 'actif' : 'suspendu',
        ]);

        return redirect()->route('admin.section', 'utilisateur');
    }

    public function updateLivreurPosition(Request $request)
    {
        $validated = $request->validate([
            'contact' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if (empty($validated['contact']) && empty($validated['email'])) {
            return response()->json([
                'ok' => false,
                'message' => 'Contact ou e-mail requis.',
            ], 422);
        }

        $query = Livreur::query()->where('statut', 'actif');

        if (! empty($validated['contact'])) {
            $query->where('contact', $validated['contact']);
        } else {
            $query->where('email', $validated['email']);
        }

        $livreur = $query->first();

        if (! $livreur) {
            return response()->json([
                'ok' => false,
                'message' => 'Livreur introuvable ou suspendu.',
            ], 404);
        }

        $livreur->update([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'derniere_position_at' => now(),
        ]);

        return response()->json([
            'ok' => true,
            'livreur' => [
                'id' => $livreur->id,
                'nom_complet' => $livreur->nom_complet,
                'latitude' => $livreur->latitude,
                'longitude' => $livreur->longitude,
                'derniere_position_at' => $livreur->derniere_position_at?->toIso8601String(),
            ],
        ]);
    }

    public function updateDestinatairePosition(Request $request)
    {
        $validated = $request->validate([
            'contact' => 'required|string|max:30',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $destinataire = Destinataire::query()
            ->where('contact', $validated['contact'])
            ->first();

        if (! $destinataire) {
            return response()->json([
                'ok' => false,
                'message' => 'Destinataire (client) introuvable.',
            ], 404);
        }

        $destinataire->update([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'derniere_position_at' => now(),
        ]);

        return response()->json([
            'ok' => true,
            'destinataire' => [
                'id' => $destinataire->id,
                'nom_complet' => $destinataire->nom_complet,
                'latitude' => $destinataire->latitude,
                'longitude' => $destinataire->longitude,
                'derniere_position_at' => $destinataire->derniere_position_at?->toIso8601String(),
            ],
        ]);
    }

    private function render(string $section): View|RedirectResponse
    {
        if (! session('auth_user')) {
            return redirect()->route('home');
        }

        $nvxCount = Inscription::enAttente()->count();
        $inscriptions = collect();
        $partenaires = collect();
        $destinataires = collect();
        $livraisonHistoriques = collect();
        $livreurs = collect();
        $etatLivraisons = collect();
        $utilisateurs = collect();
        $mapPoints = [];

        if ($section === 'nvx-insc') {
            $inscriptions = Inscription::query()
                ->whereIn('statut', ['en_attente', 'refuse'])
                ->latest()
                ->get();
        }

        if (in_array($section, ['fiche-partenaire', 'balance-partenaire'], true)) {
            $partenaires = Partenaire::query()->latest()->get();
        }

        if (in_array($section, ['fiche-destinataire', 'balances-paiement'], true)) {
            $destinataires = Destinataire::query()
                ->with('historiques')
                ->latest()
                ->get();
        }

        if ($section === 'historique-livraison') {
            $livraisonHistoriques = LivraisonHistorique::query()
                ->with('destinataire')
                ->latest()
                ->get();
        }

        if ($section === 'fiche-livreur') {
            $livreurs = Livreur::query()->latest()->get();
        }

        if ($section === 'utilisateur') {
            $utilisateurs = Utilisateur::query()->latest()->get();
        }

        if (in_array($section, ['dashboard', 'carte-livreurs'], true)) {
            $this->backfillMissingGpsPositions();

            $livreursLocalises = Livreur::query()
                ->where('statut', 'actif')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->orderBy('nom_complet')
                ->get();

            $clientsLocalises = Destinataire::query()
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->orderBy('nom_complet')
                ->get();

            $mapPoints = $livreursLocalises->map(static function (Livreur $l): array {
                return [
                    'type' => 'livreur',
                    'id' => $l->id,
                    'nom' => $l->nom_complet,
                    'contact' => $l->contact,
                    'email' => $l->email,
                    'ville' => $l->ville,
                    'adresse' => $l->adresse,
                    'lat' => (float) $l->latitude,
                    'lng' => (float) $l->longitude,
                    'updated' => $l->derniere_position_at?->format('d/m/Y H:i'),
                ];
            })->concat($clientsLocalises->map(static function (Destinataire $d): array {
                return [
                    'type' => 'client',
                    'id' => $d->id,
                    'nom' => $d->nom_complet,
                    'contact' => $d->contact,
                    'email' => '',
                    'ville' => $d->ville,
                    'activite' => $d->activite,
                    'lat' => (float) $d->latitude,
                    'lng' => (float) $d->longitude,
                    'updated' => $d->derniere_position_at?->format('d/m/Y H:i'),
                ];
            }))->values()->all();

            $livreurs = $livreursLocalises;
        }

        if ($section === 'etat-livraison') {
            $etatLivraisons = EtatLivraison::query()
                ->with('livreur')
                ->latest()
                ->get();
        }

        return view('admin.dashboard', [
            'user' => session('auth_user'),
            'section' => $section,
            'nvxCount' => $nvxCount,
            'inscriptions' => $inscriptions,
            'partenaires' => $partenaires,
            'destinataires' => $destinataires,
            'livraisonHistoriques' => $livraisonHistoriques,
            'livreurs' => $livreurs,
            'etatLivraisons' => $etatLivraisons,
            'utilisateurs' => $utilisateurs,
            'mapPoints' => $mapPoints,
        ]);
    }

    /**
     * @return array{latitude: float, longitude: float, derniere_position_at: \Illuminate\Support\Carbon}|array{}
     */
    private function coordsFromVille(string $ville): array
    {
        return $this->coordsFromAdresse(null, $ville);
    }

    /**
     * @return array{latitude: float, longitude: float, derniere_position_at: \Illuminate\Support\Carbon}|array{}
     */
    private function coordsFromAdresse(?string $adresse, string $ville): array
    {
        $pos = app(GeocodeService::class)->fromAdresse($adresse, $ville);
        if (! $pos) {
            return [];
        }

        return [
            'latitude' => $pos['lat'],
            'longitude' => $pos['lng'],
            'derniere_position_at' => now(),
        ];
    }

    private function backfillMissingGpsPositions(): void
    {
        $geo = app(GeocodeService::class);

        Livreur::query()
            ->where(function ($q) {
                $q->whereNull('latitude')->orWhereNull('longitude');
            })
            ->get()
            ->each(function (Livreur $livreur) use ($geo) {
                $pos = $geo->fromAdresse($livreur->adresse, $livreur->ville);
                if ($pos) {
                    $livreur->update([
                        'latitude' => $pos['lat'],
                        'longitude' => $pos['lng'],
                        'derniere_position_at' => now(),
                    ]);
                }
            });

        Destinataire::query()
            ->where(function ($q) {
                $q->whereNull('latitude')->orWhereNull('longitude');
            })
            ->get()
            ->each(function (Destinataire $destinataire) use ($geo) {
                $pos = $geo->fromVille($destinataire->ville);
                if ($pos) {
                    $destinataire->update([
                        'latitude' => $pos['lat'],
                        'longitude' => $pos['lng'],
                        'derniere_position_at' => now(),
                    ]);
                }
            });
    }
}
