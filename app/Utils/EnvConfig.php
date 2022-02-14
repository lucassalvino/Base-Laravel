<?php 
namespace App\Utils;
class EnvConfig{
    
    public static function HashSenha(){
        return env('HASH_SENHA', 'sha512');
    }

    public static function HashTokenApi(){
        return env('HASH_TOKEN_API', 'sha512');
    }

    public static function QtdSessaoPorUsuario(){
        return env('SESSAO_ATIVA_USUARIO', '2');
    }

    public static function ObtemComplementoPathImagem(){
        return env('COMPLEMENTO_PATCH_IMAGEM', 'baselaravel/public');
    }
    
    public static function ObtemIPInterno(){
        return env('IP_INTERNO','192.168.0.106');
    }

    public static function ObtemEmailTipoEnvio(){
        return env('EMAIL_TIPO_ENVIO', 'SMTP');
    }

    public static function ObtemMauticURL(){
        return env('EMAIL_MAUTIC_URL', 'https://serrinha.goiasec.com.br');
    }
}