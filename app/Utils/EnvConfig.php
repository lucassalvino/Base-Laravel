<?php 
namespace App\Utils;
class EnvConfig{
    
    public static function HashSenha(){
        return env('HASH_SENHA', 'sha512');
    }

    public static function HashTokenApi(){
        return env('HASH_TOKEN_API', 'sha512');
    }

    public static function ObtemComplementoPathImagem(){
        return env('COMPLEMENTO_PATCH_IMAGEM', 'baselaravel/public');
    }
    
    public static function ObtemEmailTipoEnvio(){
        return env('EMAIL_TIPO_ENVIO', 'SMTP');
    }

    public static function ObtemMauticURL(){
        return env('EMAIL_MAUTIC_URL', 'https://mautic.com.br');
    }

    public static function ObtemTipoStorage(){
        return env('STORAGE', "local");
    }

    public static function UrlBaseStorage(){
        return env('URL_STORAGE', 'https://files.com.br');
    }
}