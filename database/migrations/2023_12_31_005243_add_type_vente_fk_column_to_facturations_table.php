<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('facturations', function (Blueprint $table) {
            $table->integer("type_vente_fk");
            $table->text("date_creation");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturations', function (Blueprint $table) {
            $table->dropColumn('type_vente_fk');
            $table->dropColumn('date_creation');
        });
    }
};
