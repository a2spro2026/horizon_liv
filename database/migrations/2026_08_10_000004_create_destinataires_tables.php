<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinataires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('contact');
            $table->string('ville');
            $table->string('activite');
            $table->timestamps();
        });

        Schema::create('livraison_historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinataire_id')->constrained('destinataires')->cascadeOnDelete();
            $table->unsignedInteger('nombres_cmd')->default(0);
            $table->string('etat'); // confirmee, annulee, retour, reportee
            $table->decimal('total_paiement', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livraison_historiques');
        Schema::dropIfExists('destinataires');
    }
};
