<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    protected $fillable = [
        'numero_cmd',
        'partenaire_id',
        'nom_partenaire',
        'nom_destinataire',
        'contact_destinataire',
        'adresse',
        'montant_total',
        'statue',
        'etat',
    ];

    protected $casts = [
        'montant_total' => 'float',
    ];

    public function partenaire(): BelongsTo
    {
        return $this->belongsTo(Partenaire::class);
    }

    public static function statueLabel(string $statue): string
    {
        return match ($statue) {
            'confirmee' => 'Confirmée',
            'retour' => 'Retour',
            'reportee' => 'Reportée',
            'annulee' => 'Annulée',
            default => $statue,
        };
    }

    public static function etatLabel(string $etat): string
    {
        return match ($etat) {
            'payee' => 'Payée',
            'non_payee' => 'Non Payée',
            default => $etat,
        };
    }

    public static function generateNumero(): string
    {
        $prefix = 'CMD-' . now()->format('Ymd') . '-';
        $last = static::query()
            ->where('numero_cmd', 'like', $prefix . '%')
            ->orderByDesc('id')
            ->value('numero_cmd');

        $seq = 1;
        if ($last && preg_match('/-(\d+)$/', $last, $matches)) {
            $seq = ((int) $matches[1]) + 1;
        }

        return $prefix . str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
    }
}
