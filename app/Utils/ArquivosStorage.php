<?php 
namespace App\Utils;
use Illuminate\Support\Str;
class ArquivosStorage{
    public static $BasePath = 'resources'.DIRECTORY_SEPARATOR.'storage';
    public static function Base64ParaImagem($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' );
        fwrite( $ifp, base64_decode( $base64_string ));
        fclose( $ifp );
        return $output_file;
    }

    public static function GetPathFolder($folder, $delete = false){
        if (!file_exists(public_path(self::$BasePath))) {
            mkdir(public_path(self::$BasePath), 0755, true);
        }
        $diretorio = public_path(self::$BasePath. DIRECTORY_SEPARATOR . $folder);
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        return $diretorio;
    }

    public static function GetUrlView($dbUrl, $getUrlFromEnv = false){
        if (strpos($dbUrl, 'http') === false) {
            $url =  str_replace('\\','/', url( ArquivosStorage::$BasePath.DIRECTORY_SEPARATOR.$dbUrl));
            if($getUrlFromEnv){
                $complemento = EnvConfig::ObtemComplementoPathImagem();
                if(strcasecmp($complemento,"") == 0){
                    $url = str_replace('localhost', EnvConfig::ObtemIPInterno() , $url);
                }else{
                    $url = str_replace('localhost', EnvConfig::ObtemIPInterno()."/".$complemento , $url);
                }
            }
            return $url;
        }
        return $dbUrl;
    }
    
    public static function GetRelativePatch($dbUrl){
        return self::$BasePath.DIRECTORY_SEPARATOR.$dbUrl;
    }

    public static function DeletaArquivo($PathRelativo){
        if(strcasecmp("", $PathRelativo) != 0){
            unlink(self::$BasePath. DIRECTORY_SEPARATOR . $PathRelativo);
        }
    }

    public static function GetRelativePath($storageFolder, $tipo){
        return $storageFolder . DIRECTORY_SEPARATOR . str_replace ("-","_", Str::uuid()) .'.'. self::GetExtensao($tipo);
    }

    public static function GetPathImagem($caminhoRelativo, $storageFolder){
        if (!file_exists(public_path(self::$BasePath))) {
            mkdir(public_path(self::$BasePath), 0755, true);
        }
        $diretorio = public_path(self::$BasePath. DIRECTORY_SEPARATOR . $storageFolder);
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        return public_path(self::$BasePath. DIRECTORY_SEPARATOR . $caminhoRelativo);
    }

    public static function GetPathImagemExistente($caminhoRelativo){
        return public_path(self::$BasePath. DIRECTORY_SEPARATOR . $caminhoRelativo);
    }

    public static function GetExtensao($tipo){
        $arrayRetorno = static::GetExtensoesPossiveis();
        if(array_key_exists ($tipo,$arrayRetorno)){
            return $arrayRetorno[$tipo];
        }
        return "txt";
    }
    
    public static function GetTypeByExtensao($extensao){
        $arrayRetorno = static::GetExtensoesPossiveis();
        foreach($arrayRetorno as $key=>$ret){
            if(strcasecmp($ret, $extensao) == 0)
                return $key;
        }
        return "";
    }

    public static function GetExtensoesPossiveis(){
        $arrayRetorno = Array( 
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/bmp' => 'bmp',
            'image/webp' => 'webp',
            'application/pdf' => 'pdf',
            'text/csv' => 'csv',
            'audio/aac' => 'aac',
            'application/x-abiword' => 'abw',
            'application/octet-stream' => 'arc',
            'video/x-msvideo' => 'avi',
            'application/vnd.amazon.ebook' => 'azw',
            'application/octet-stream' => 'bin',
            'application/x-bzip' => 'bz',
            'application/x-bzip2' => 'bz2',
            'application/x-csh' => 'csh',
            'text/css'=> 'css',
            'application/msword' => 'doc',
            'application/vnd.ms-fontobject' => 'eot',
            'application/epub+zip' => 'epub',
            'text/html' => 'html',
            'image/x-icon' => 'ico',
            'text/calendar' => 'ics',
            'application/java-archive' => 'jar',
            'application/javascript' => 'js',
            'application/json' => 'json',
            'audio/midi' => 'midi',
            'video/mpeg' => 'mpeg',
            'application/vnd.apple.installer+xml' => 'mpkg',
            'application/vnd.oasis.opendocument.presentation' => 'odp',
            'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
            'application/vnd.oasis.opendocument.text' => 'odt',
            'audio/ogg' => 'oga',
            'video/ogg' => 'ogv',
            'application/ogg' => 'ogx',
            'font/otf' => 'otf',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/x-rar-compressed' => 'rar',
            'application/rtf' => 'rtf',
            'application/x-sh' => 'sh',
            'image/svg+xml' => 'svg',
            'application/x-shockwave-flash' => 'swf',
            'application/x-tar' => 'tar',
            'image/tiff' => 'tif',
            'application/typescript' => 'ts',
            'font/ttf' => 'ttf',
            'application/vnd.visio' => 'vsd',
            'audio/x-wav' => 'wav',
            'audio/webm' => 'weba',
            'video/webm' => 'webm',
            'image/webp' => 'webp',
            'font/woff' => 'woff',
            'font/woff2' => 'woff2',
            'application/xhtml+xml' => 'xhtml',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/xml' => 'xml',
            'application/vnd.mozilla.xul+xml' => 'xul',
            'application/zip' => 'zip',
            'video/3gpp' => '3gp',
            'audio/3gpp' => '3gp',
            'video/3gpp2' => '3g2',
            'audio/3gpp2' => '3g2',
            'application/x-7z-compressed' => '7z'
        );
        return $arrayRetorno;
    }
    
}