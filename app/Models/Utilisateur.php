<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom_complet',
        'contact',
        'email',
        'statue',
        'login',
        'password',
        'statut',
    ];

    public function isSuspendu(): bool
    {
        return $this->statut === 'suspendu';
    }

    public function statueLabel(): string
    {
        return match ($this->statue) {
            'admin' => 'Administrateur',
            'client' => 'Client',
            'livreur' => 'Livreur',
            'agence' => 'Agence',
            default => $this->statue ?: '—',
        };
    }
}
