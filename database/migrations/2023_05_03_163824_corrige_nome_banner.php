<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CorrigeNomeBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function(Blueprint $table){
            $table->renameColumn('patch_descktop', 'path_desktop');
            $table->renameColumn('patch_mobile', 'path_mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function(Blueprint $table){
            $table->renameColumn('path_desktop', 'patch_descktop');
            $table->renameColumn('path_mobile', 'patch_mobile');
        });
    }
}
