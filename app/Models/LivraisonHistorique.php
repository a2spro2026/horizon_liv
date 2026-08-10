<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LivraisonHistorique extends Model
{
    protected $table = 'livraison_historiques';

    protected $fillable = [
        'destinataire_id',
        'nombres_cmd',
        'etat',
        'total_paiement',
    ];

    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(Destinataire::class);
    }

    public static function etatLabel(string $etat): string
    {
        return match ($etat) {
            'confirmee' => 'Confirmée',
            'annulee' => 'Annulée',
            'retour' => 'Retour',
            'reportee' => 'Reportée',
            default => $etat,
        };
    }
}
