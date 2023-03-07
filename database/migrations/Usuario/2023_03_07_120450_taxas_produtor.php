<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaxasProdutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_taxa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id')->unique();
            $table->json('taxas');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('usuario_taxa_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_taxa_id');
            $table->uuid('usuario_id');
            $table->json('alteracoes');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('usuario_taxa_id')->references('id')->on('usuario_taxa');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('usuario_taxa');
        Schema::dropIfExists('usuario_taxa_log');
    }
}
