<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoricoAlteraçãoSenha extends Migration
{
    public function up()
    {
        Schema::create('historico_alteracao_senha', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('usuario_id');
            $table->uuid('usuario_acao_id')->nullable();
            $table->string('user_agent', 400);
            $table->string('endereco_ip_request', 40);
            $table->string('endereco_ip_real', 40)->nullable();
            $table->string('host_request', 150)->nullable();
            $table->smallInteger('sucesso_alteracao')->default(0);
            $table->string('stamp', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('usuario_acao_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historico_alteracao_senha');
    }
}
