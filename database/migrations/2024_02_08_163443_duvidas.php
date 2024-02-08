<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Duvidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duvidas', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->softDeletes();
            $table->timestamps();
            $table->string('titulo', 255);
            $table->int('ordem');
            $table->text('resposta')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duvidas');
    }
}
