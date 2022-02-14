<?php 
namespace App\Servicos;

use App\Models\Login;

class LoginServico{
    function __construct() {
    }

    public static function ObtemSessao($token){
        return Login::query()
            ->where('api_token', '=', $token)
            ->first();
    }
}