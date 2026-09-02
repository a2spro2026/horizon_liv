<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_cmd')->unique();
            $table->foreignId('partenaire_id')->nullable()->constrained('partenaires')->nullOnDelete();
            $table->string('nom_partenaire');
            $table->string('nom_destinataire');
            $table->string('contact_destinataire');
            $table->string('adresse');
            $table->decimal('montant_total', 12, 2)->default(0);
            $table->string('statue')->default('confirmee');
            $table->string('etat')->default('non_payee');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
