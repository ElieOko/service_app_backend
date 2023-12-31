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
        Schema::create('dettes', function (Blueprint $table) {
            $table->id();
            $table->integer("code_fk");
            $table->integer("stock_fk");
            $table->integer("type_vente_fk");
            $table->integer("marketeur_fk")->nullable();
            $table->integer("quantite_emprunter");
            $table->integer("quantite_restante")->default("0.0");
            $table->integer("quantite_vendu")->default("0.0");
            $table->float("montant_final",8,2)->default("0.0");
            $table->float("montant_restant",8,2)->default("0.0");
            $table->float("montant_payer",8,2)->default("0.0");
            $table->integer("status_fk")->default("1");
            $table->text("note")->default("")->nullable();
            $table->text("observation")->default("")->nullable();
            $table->text("date_creation");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dettes');
    }
};
