<?php
namespace App\Models\Bases;

class BaseModelCategorizadores extends BaseModel{

    public static function ObtenhaRegistrosAtuais(Array $ColunaListar = [], bool $RetornarPadrao = false){
        if(is_null($ColunaListar) || (count($ColunaListar)<=0)){
            $ColunaListar = static::GetColunasListagem();
        }
        $consulta = static::query();
        if(!$RetornarPadrao){
            $consulta = $consulta->where('id', '!=', static::$guidempty);
        }
        return $consulta->get($ColunaListar);
    }
    
    public static function ObtemCategorizadorPorSlug($busca, $camposSlug = 'slug', $operador = 'ilike'){
        return static::query()
        ->where($camposSlug, $operador, $busca)
        ->first();
    }
}
