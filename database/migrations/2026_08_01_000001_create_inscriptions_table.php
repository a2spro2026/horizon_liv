<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('telephone');
            $table->string('email');
            $table->string('ville');
            $table->string('password');
            $table->string('magasin');
            $table->string('cin');
            $table->string('banque');
            $table->string('rib');
            $table->string('statut')->default('en_attente');
            $table->timestamp('lu_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
