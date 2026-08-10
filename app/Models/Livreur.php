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
        'latitude',
        'longitude',
        'derniere_position_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'derniere_position_at' => 'datetime',
    ];

    public function isSuspendu(): bool
    {
        return $this->statut === 'suspendu';
    }

    public function hasPosition(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function etatLivraisons(): HasMany
    {
        return $this->hasMany(EtatLivraison::class);
    }
}
