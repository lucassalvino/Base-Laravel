<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menus extends Migration
{
    public function up()
    {
        Schema::create('menus', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('nome', 200);
            $table->string('icone', 200);
            $table->string('path', 200);
            $table->uuid('parent_id')->nullable();
            $table->integer('ordem')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('menus', function(Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('menus');
        });

        Schema::create('grupo_menu', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('grupo_id');
            $table->uuid('menu_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('menu_id')->references('id')->on('menus');
        });

        Schema::create('grupo_menu_historico', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('grupo_id');
            $table->uuid('menu_id');
            $table->uuid('usuario_id');
            $table->string('stamp', 300);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupo_menu_historico');
        Schema::dropIfExists('grupo_menu');
        Schema::dropIfExists('menus');
    }
}
