<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destinataire extends Model
{
    protected $fillable = [
        'nom_complet',
        'contact',
        'ville',
        'activite',
        'latitude',
        'longitude',
        'derniere_position_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'derniere_position_at' => 'datetime',
    ];

    public function historiques(): HasMany
    {
        return $this->hasMany(LivraisonHistorique::class);
    }

    public function hasPosition(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function nbrsCmdConfirmee(): int
    {
        return (int) $this->historiques()
            ->where('etat', 'confirmee')
            ->sum('nombres_cmd');
    }

    public function totalPaiement(): float
    {
        return (float) $this->historiques()
            ->where('etat', 'confirmee')
            ->sum('total_paiement');
    }
}
