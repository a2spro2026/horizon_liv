<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->nullable()->constrained('inscriptions')->nullOnDelete();
            $table->string('nom_client');
            $table->string('cin');
            $table->string('telephone');
            $table->string('email');
            $table->string('ville');
            $table->string('magasin');
            $table->string('banque');
            $table->string('rib');
            $table->string('login');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
