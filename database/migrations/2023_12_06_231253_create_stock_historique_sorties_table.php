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
        Schema::create('stock_historique_sorties', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_fk');
            $table->integer("quantite");
            $table->integer("prixUnitaire");
            $table->integer("prixTotal");
            $table->timestamps();
        });
    }

    /**
     *    
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_historique_sorties');
    }
};
