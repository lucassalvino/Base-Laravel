<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WhitelistIps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('white_list', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('tipo', 50);
            $table->string('valor', 300)->unique();
            $table->text('descricao')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('white_list');
    }
}
