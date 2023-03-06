<?php

namespace App\Servicos;

use App\Utils\EnvConfig;
use Illuminate\Support\Facades\Log;

class IntegracaoMautic{
    public $url = "";
    public $urlRetorno = "";

    function __construct($urlRetorno = '') {
        $this->url = EnvConfig::ObtemMauticURL();
        $this->urlRetorno = $urlRetorno;
    }

    private function ObtemIpServidor(&$ip){
        if (!$ip) {
            if(array_key_exists('SERVER_ADDR', $_SERVER)){
                $ip = $_SERVER['SERVER_ADDR'];
            }else{
                $ip = "::1";
            }
        }
    }

    public function SubmeteFormulario($data, $formId, $ip = null){
        $this->ObtemIpServidor($ip);
        $data['formId'] = $formId;
        if (!isset($data['return'])) {
            $data['return'] = $this->urlRetorno;
        }
        $data = array('mauticform' => $data);
        $formUrl =  $this->url.'/form/submit?formId=' . $formId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $formUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Forwarded-For: $ip"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(!$response){
            Log::error(curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }
}