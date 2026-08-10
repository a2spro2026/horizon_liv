<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partenaires', function (Blueprint $table) {
            $table->string('type_partenaire')->nullable()->after('ville');
            $table->string('mode_paiement')->nullable()->after('type_partenaire');
            $table->string('statut')->default('actif')->after('mode_paiement');
        });
    }

    public function down(): void
    {
        Schema::table('partenaires', function (Blueprint $table) {
            $table->dropColumn(['type_partenaire', 'mode_paiement', 'statut']);
        });
    }
};
