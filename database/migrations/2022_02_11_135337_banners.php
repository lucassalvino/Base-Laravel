<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('titulo', 255)->nullable();
            $table->string('cortitulo', 20)->default("#000000");
            $table->string('subtitulo', 500)->nullable();
            $table->string('corsubtitulo', 20)->default("#000000");
            $table->string('obs', 255)->nullable();
            $table->string('corobs', 20)->default("#000000");
            $table->string('patch_descktop', 300)->nullable();
            $table->string('patch_mobile', 300)->nullable();
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
        Schema::dropIfExists('banners');
    }
}
