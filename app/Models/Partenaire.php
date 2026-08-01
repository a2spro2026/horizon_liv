<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partenaire extends Model
{
    protected $fillable = [
        'inscription_id',
        'nom_client',
        'cin',
        'telephone',
        'email',
        'ville',
        'magasin',
        'banque',
        'rib',
        'login',
        'password',
    ];

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }
}
