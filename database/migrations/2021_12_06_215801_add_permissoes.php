<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('nome', 255);
            $table->string('entidade', 255);
            $table->string('nivel', 255);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('grupo_permissoes', function(Blueprint $table){
            $table->uuid('permissoes_id');
            $table->uuid('grupo_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('grupo_permissoes', function(Blueprint $table){
            $table->foreign('permissoes_id')->references('id')->on('permissoes');
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->primary(['permissoes_id', 'grupo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes');
        Schema::dropIfExists('grupo_permissoes');
    }
}
