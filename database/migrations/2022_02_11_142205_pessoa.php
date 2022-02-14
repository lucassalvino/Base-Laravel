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
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('documento', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid("tipo_id");
            $table->string("numero", 300);
            $table->foreign('tipo_id')->references('id')->on('tipo_documento');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('telefone', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string("ddd", 20);
            $table->string("numero", 100);
            $table->boolean("padrao")->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users_endereco', function(Blueprint $table){
            $table->uuid('usuario_id');
            $table->uuid('endereco_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->primary(['endereco_id', 'usuario_id']);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users_documento', function(Blueprint $table){
            $table->uuid('usuario_id');
            $table->uuid('documento_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('documento_id')->references('id')->on('documento');
            $table->primary(['documento_id', 'usuario_id']);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users_telefone', function(Blueprint $table){
            $table->uuid('usuario_id');
            $table->uuid('telefone_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('telefone_id')->references('id')->on('telefone');
            $table->primary(['telefone_id', 'usuario_id']);
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
        Schema::dropIfExists('users_endereco');
        Schema::dropIfExists('users_documento');
        Schema::dropIfExists('users_telefone');
    }
}
