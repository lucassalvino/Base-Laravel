<?php

use App\Models\Enuns\Carteira\StatusRecebedor;
use App\Models\Enuns\Carteira\TipoRecebedor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarteiraUsuario extends Migration{
    public function up(){
        Schema::create('usuario_carteira', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->bigInteger('saldo_disponivel')->default(0);
            $table->bigInteger('saldo_a_receber')->default(0);
            $table->bigInteger('saldo_bloqueado')->default(0);
            $table->dateTime('ultima_atualizacao_saldos')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('usuario_carteira_movimentacao', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('usuario_carteira_id');
            $table->bigInteger('saldo_antes_movimentacao')->default(0);
            $table->bigInteger('saldo_depois_movimentacao')->default(0);
            $table->bigInteger('valor_movimentacao')->default(0);
            $table->string("descricao_curta", 200);
            $table->text("descricao")->nullable();
            $table->json("dados_movimentacao")->nullable();
            $table->string('status', 50);
            $table->string('tipo_movimentacao', 50);
            $table->dateTime('data_disponivel');
            $table->text('hash', 255)->nullable();

            $table->uuid('usuario_id')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->foreign('usuario_carteira_id')->references('id')->on('usuario_carteira');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('usuario_carteira_movimentacao', function(Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('usuario_carteira_movimentacao');
        });

        Schema::create('usuario_recebedor', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('usuario_id');
            $table->string('tipo_recebedor', 50)->default(TipoRecebedor::TED);
            $table->string('status', 50)->default(StatusRecebedor::Ativo);
            $table->integer('principal')->default(1);

            // caso recebedor seja do tipo pix
            $table->string('chave_pix', 300)->nullable();
            $table->string('tipo_chave_pix', 50)->nullable();

            //caso recebedor seja do tipo TED
            $table->string('nome_titular', 128)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('descricao', 256)->nullable();
            $table->string('documento', 16)->nullable();
            $table->string('tipo_pessoa_recebedor', 50)->nullable();
            $table->string('banco', 3)->nullable();
            $table->string('agencia', 4)->nullable();
            $table->string('digito_verificador_agencia', 1)->nullable();
            $table->string('numero_conta', 20)->nullable();
            $table->string('digito_verificador_conta', 2)->nullable();
            $table->string('tipo_conta', 50)->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->index('tipo_recebedor');
            $table->index('status');
        });

        Schema::create('usuario_carteira_saque', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('usuario_recebedor_id');
            $table->uuid('usuario_id');
            $table->uuid('usuario_carteira_id');
            $table->bigInteger('valor_solicitado');
            $table->string('status', 50);
            $table->json('requisicao')->nullable();
            $table->json('response')->nullable();

            $table->foreign('usuario_recebedor_id')->references('id')->on('usuario_recebedor');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('usuario_carteira_id')->references('id')->on('usuario_carteira');
            $table->softDeletes();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_carteira_movimentacao');
        Schema::dropIfExists('usuario_carteira');
        Schema::dropIfExists('usuario_carteira_saque');
        Schema::dropIfExists('usuario_recebedor');
    }
}
