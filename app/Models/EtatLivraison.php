<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EtatLivraison extends Model
{
    protected $table = 'etat_livraisons';

    protected $fillable = [
        'livreur_id',
        'livreur_nom',
        'ville',
        'nom_client',
        'montant_colis',
        'statue',
    ];

    public function livreur(): BelongsTo
    {
        return $this->belongsTo(Livreur::class);
    }

    public function livreurLabel(): string
    {
        return $this->livreur?->nom_complet ?? $this->livreur_nom ?? '—';
    }

    public static function statueLabel(string $statue): string
    {
        return match ($statue) {
            'confirmee' => 'Confirmée',
            'annulee' => 'Annulée',
            'retour' => 'Retour',
            'reportee' => 'Reportée',
            default => $statue,
        };
    }
}
