<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('livreurs', 'adresse')) {
            return;
        }

        Schema::table('livreurs', function (Blueprint $table) {
            $table->string('adresse')->nullable()->after('ville');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('livreurs', 'adresse')) {
            return;
        }

        Schema::table('livreurs', function (Blueprint $table) {
            $table->dropColumn('adresse');
        });
    }
};
