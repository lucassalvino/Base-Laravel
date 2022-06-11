<?php

namespace Database\Seeders;

use App\Models\Categorizadores\Sexo;
use App\Models\Categorizadores\TipoDocumento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorizadoresSeeder extends Seeder
{
    private function ClassesSeeder(){
        return Array(
        );
    }

    public function run()
    {
        $categorizadores = $this->ClassesSeeder();
        foreach($categorizadores as $class){
            $instancia = new $class;
            $tabela = $instancia->GetTableName();
            $dadosInserir = $class::ObtenhaRegistrosPadrao();
            foreach($dadosInserir as $inserir){
                if(array_key_exists('id', $inserir)){
                    $dbTipo = $class::withTrashed()
                    ->where('id','=', $inserir['id'])
                    ->first();
                    if(!$dbTipo){
                        DB::table($tabela)->insert($inserir);
                    }
                }
            }
        }
    }
}
