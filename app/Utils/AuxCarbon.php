<?php 
namespace App\Utils;

use Carbon\Carbon;
use Exception;

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

    public static function ObtenhaDataTimeBanco($data, $format = 'd/m/Y H:i:s'){
        try{
            if(is_null($format)){
                $data = new Carbon($data);
            }else{
                $data = Carbon::createFromFormat($format, $data);
            }
            $data->timezone('America/Sao_Paulo');
            $data = $data->toDateTimeString();
            return $data;
        }catch(Exception $erro){
            return '';
        }
    }

    public static function ObtenhaDataBanco($data, $format = 'd/m/Y'){
        try{
            if(is_null($format)){
                $data = new Carbon($data);
            }else{
                $data = Carbon::createFromFormat($format, $data);
            }
            $data->timezone('America/Sao_Paulo');
            $data = $data->toDateString();
            return $data;
        }catch(Exception $erro){
            return '';
        }
    }
}