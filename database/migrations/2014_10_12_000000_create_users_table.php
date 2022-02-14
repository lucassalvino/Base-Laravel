<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sexo', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('descricao', 100);
            $table->string('slug', 100);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tipo_documento', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('descricao', 100);
            $table->string('slug', 100);
            $table->string('funcao_validacao', 200);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('username', 255);
            $table->string('email', 300)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('path_avatar', 300);
            $table->string('password', 300);
            $table->uuid('sexo_id')->nullable();
            $table->foreign('sexo_id')->references('id')->on('sexo');
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
        Schema::dropIfExists('sexo');
        Schema::dropIfExists('tipo_documento');
        Schema::dropIfExists('users');
    }
}
