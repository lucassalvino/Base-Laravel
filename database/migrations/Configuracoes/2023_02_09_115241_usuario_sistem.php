<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioSistem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracoes_sistema', function (Blueprint $table) {
            $table->uuid('usuario_sistema_id')->nullable();
            $table->foreign('usuario_sistema_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracoes_sistema', function (Blueprint $table) {
            $table->dropColumn('usuario_sistema_id');
        });
    }
}
