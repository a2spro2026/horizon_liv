<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->foreignId('destinataire_id')
                ->nullable()
                ->after('partenaire_id')
                ->constrained('destinataires')
                ->nullOnDelete();
            $table->string('mode_paiement')->default('esp')->after('montant_total');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('destinataire_id');
            $table->dropColumn('mode_paiement');
        });
    }
};
