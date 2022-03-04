<?php
namespace App\Utils;
class Strings{
    public static function slugify($text, string $divider = '-'){
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public static function SomenteNumeros($texto){
        return preg_replace( '/[^0-9]/is', '', $texto );
    }

    public static function obfuscate_email($email){
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
    }

    public static function isNullOrEmpty($str){
        return ($str === null || trim($str) === '');
    }
}