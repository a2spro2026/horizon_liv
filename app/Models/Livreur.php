<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
