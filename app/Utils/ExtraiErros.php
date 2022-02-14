<?php
namespace App\Utils;
class ExtraiErros{

    public static function extraiError($erros){
        $msg = "";

        foreach($erros as $erro){
            $msg .= $erro." .";
        }
        
        return $msg;
    }

    public static function retornaErro($erros){
        error_log( ExtraiErros::extraiError($erros) );
        return BaseRetornoApi::GetRetornoErro($erros, "Ocorreu um erro ao salvar os dados");
    }
    

}