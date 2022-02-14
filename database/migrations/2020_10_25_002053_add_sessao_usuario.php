<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessaoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('api_token', 300); // max sha512
            $table->uuid('user_id');
            $table->string('codigo_verificacao_login', 20)->nullable();
            $table->boolean('validado')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('login', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login');
    }
}
