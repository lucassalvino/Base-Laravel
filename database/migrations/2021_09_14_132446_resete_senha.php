<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReseteSenha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resete_senha', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid('usuario_id');
            $table->string('token_resetar', 300);
            $table->boolean("utilizado")->default(false);
            $table->foreign("usuario_id")->references("id")->on("users");
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
        Schema::dropIfExists('resete_senha');
    }
}
