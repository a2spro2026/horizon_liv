<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inscription extends Model
{
    protected $fillable = [
        'nom_complet',
        'telephone',
        'email',
        'ville',
        'password',
        'magasin',
        'cin',
        'banque',
        'rib',
        'statut',
        'lu_at',
    ];

    protected function casts(): array
    {
        return [
            'lu_at' => 'datetime',
        ];
    }

    public function partenaire(): HasOne
    {
        return $this->hasOne(Partenaire::class);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
}
