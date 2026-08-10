<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livreur extends Model
{
    protected $fillable = [
        'nom_complet',
        'contact',
        'email',
        'ville',
        'type_paiement',
        'statut',
    ];

    public function isSuspendu(): bool
    {
        return $this->statut === 'suspendu';
    }

    public function etatLivraisons(): HasMany
    {
        return $this->hasMany(EtatLivraison::class);
    }
}
