<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string("cep", 40);
            $table->string("logradouro", 300);
            $table->string("numero", 15);
            $table->string("bairro", 250);
            $table->string("complemento", 250);
            $table->string("cidade", 250);
            $table->string("estado", 100);
            $table->boolean("padrao")->default(false);
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->uuid('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('documento', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string("numero", 300);
            $table->string("tipo", 100);
            $table->uuid('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('telefone', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string("ddd", 20);
            $table->string("numero", 100);
            $table->boolean("padrao")->default(false);
            $table->uuid('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco');
        Schema::dropIfExists('documento');
        Schema::dropIfExists('telefone');
    }
}
