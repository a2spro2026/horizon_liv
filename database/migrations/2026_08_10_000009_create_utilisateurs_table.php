<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('contact');
            $table->string('email');
            $table->string('statue'); // admin, client, livreur, agence
            $table->string('login')->unique();
            $table->string('password');
            $table->string('statut')->default('actif'); // actif, suspendu
            $table->timestamps();
        });

        DB::table('utilisateurs')->insert([
            'nom_complet' => 'Administrateur',
            'contact' => '00212000000000',
            'email' => 'admin@horizonliv.com',
            'statue' => 'admin',
            'login' => 'admin@horizonliv.com',
            'password' => 'password',
            'statut' => 'actif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
