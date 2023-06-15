<?php

use App\Models\Enuns\StatusPagina;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaginasSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('titulo', 300);
            $table->string('slug', 300)->unique();
            $table->string('status', 50)->default(StatusPagina::Publicada);
            $table->text('conteudo');
            $table->text('resumo')->nullable();
            $table->json('meta')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->uuid('usuario_id');
            $table->string('thumbnail', 300)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->index('slug');
        });

        Schema::table('pagina', function(Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('pagina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('pagina');
    }
}
