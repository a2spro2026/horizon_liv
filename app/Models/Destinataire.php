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
    ];

    public function historiques(): HasMany
    {
        return $this->hasMany(LivraisonHistorique::class);
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
