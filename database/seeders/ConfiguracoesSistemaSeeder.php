<?php

namespace Database\Seeders;

use App\Models\ConfiguracoesSistema;
use Illuminate\Database\Seeder;

class ConfiguracoesSistemaSeeder extends Seeder {
    public function run(){
        ConfiguracoesSistema::create([
            'quantidade_sessoes_permitidas' => 5
        ]);
    }
}