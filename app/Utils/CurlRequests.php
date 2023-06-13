<?php 
namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Log;

class CurlRequests{
    public $ch;
    private $headers = [];

    public function __construct($url, $json = true){
        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        if($json){
            $this->headers[] = 'Content-Type: application/json';
        }
    }

    public function SetHTTPDigestAuth($user, $pass) : CurlRequests{
        curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        $this->SetUserPwd($user, $pass);
        return $this;
    }

    public function SetUserPwd($user, $pass) : CurlRequests {
        curl_setopt($this->ch, CURLOPT_USERPWD, $user.':'.$pass);
        return $this;
    }

    public function AdicionaHeader(string $header) : CurlRequests{
        $this->headers[] = $header;
        return $this;
    }

    public function AdicionaHeaders(Array $headers) : CurlRequests{
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function SetPostFields($dadosRequest){
        if(!is_null($dadosRequest)){
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($dadosRequest));
        }
        return $this;
    }

    public function SetPost($dadosRequest) : CurlRequests{
        curl_setopt($this->ch, CURLOPT_POST, 1);
        return $this->SetPostFields($dadosRequest);
    }

    public function SetDelete($dadosRequest = null){
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        if(!is_null($dadosRequest)){
            return $this->SetPostFields($dadosRequest);
        }
        return $this;
    }

    public function Executa($jsonRetorno = true){
        if(count($this->headers) > 0){
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        $result = curl_exec($this->ch);
        $getInfo = curl_getinfo($this->ch);
        $codigo = $getInfo['http_code'];
        if($jsonRetorno){
            if($getInfo['http_code'] == 200){
                $result = json_decode($result, true);
            }else{
                try{
                    $result = json_decode($result, true);
                }catch(Exception $erro){
                    Log::error($erro);
                }
            }
        }
        curl_close($this->ch);
        return Array(
            'retorno' => $result,
            'info' => $getInfo,
            'http_status' => $codigo,
            'sucesso' => ($codigo == 200),
            'realiza_login' => ($codigo == 403)
        );
    }
}
