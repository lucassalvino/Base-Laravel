<?php 
namespace App\Utils;

use Carbon\Carbon;
class AuxCarbon{
    public static function ObtenhaDataTimeFIltro($data){
        $data = new Carbon($data);
        $data->timezone('America/Sao_Paulo');
        $data = $data->toDateTimeString();
        return $data;
    }

    public static function ObtenhaTimeFiltro($time){
        $data = new Carbon($time);
        $data->timezone('America/Sao_Paulo');
        $data = $data->toTimeString();
        return $data;
    }
}