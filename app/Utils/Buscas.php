<?php
namespace App\Utils;
class Buscas{
    public static function Binaria($dados, $busca, $chave = 'id') : int{
        if (count($dados) === 0) return -1;
        $baixo = 0; 
        $alto = count($dados) - 1;
        while ($baixo <= $alto) { 
            $meio = floor(($baixo + $alto) / 2); 
            if(strcasecmp ($dados[$meio]->{$chave}, $busca) === 0) {
                return $meio;
            }
            if (strcasecmp ($busca, $dados[$meio]->{$chave}) < 0) { 
                $alto = $meio -1; 
            }
            else { 
                $baixo = $meio + 1; 
            }
        }
        return -1;
    }
}