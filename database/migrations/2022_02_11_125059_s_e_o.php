<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SEO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('descricao', 500)->default("baselaravel");
            $table->string('titulo', 120)->default("baselaravel");
            $table->string('url', 255)->default("http://localhost/");
            $table->string('palavras_chave', 500)->default("baselaravel");
            $table->text("script_tracking")->default("");
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
        Schema::dropIfExists('seo');
    }
}
