<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('nome', 255);
            $table->string('slug', 100);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('usuario_grupo', function(Blueprint $table){
            $table->uuid('usuario_id');
            $table->uuid('grupo_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('usuario_grupo', function(Blueprint $table){
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->primary(['grupo_id', 'usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_grupo');
        Schema::dropIfExists('grupo');
    }
}
