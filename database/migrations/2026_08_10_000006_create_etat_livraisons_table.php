<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etat_livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livreur_id')->nullable()->constrained('livreurs')->nullOnDelete();
            $table->string('livreur_nom')->nullable();
            $table->string('ville');
            $table->string('nom_client');
            $table->decimal('montant_colis', 12, 2)->default(0);
            $table->string('statue'); // confirmee, annulee, retour, reportee
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etat_livraisons');
    }
};
