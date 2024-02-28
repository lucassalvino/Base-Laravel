<?php
namespace App\Models\Enuns;
class BaseEnum
{
    protected $enumeradores = [];
    public static function ExisteEnum($tipo){
        $obj = new static;
        return array_key_exists($tipo, $obj->enumeradores);
    }

    public static function GetString($opcao): string{
        $obj = new static;
        if(array_key_exists($opcao, $obj->enumeradores)){
            return $obj->enumeradores[$opcao];
        }else{
            return "Opção não encontrada";
        }
    }

    public static function GetAllEnum():array{
        $obj = new static;
        return $obj->enumeradores;
    }
}
