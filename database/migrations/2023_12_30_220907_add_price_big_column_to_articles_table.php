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
        Schema::table('articles', function (Blueprint $table) {
            $table->float("price_big",8,2)->default("0.0")->nullable();
            $table->float("price_usd_short",8,2)->default("0.0")->nullable();
            $table->float("price_usd_big",8,2)->default("0.0")->nullable();
            $table->integer('type_article_fk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('price_big');
            $table->dropColumn('price_usd_short');
            $table->dropColumn('price_usd_big');
            $table->dropColumn('type_article_fk');
        });
    }
};
