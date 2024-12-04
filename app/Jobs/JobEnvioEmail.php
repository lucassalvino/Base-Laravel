<?php

namespace App\Jobs;

use App\Utils\EnvConfig;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobEnvioEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $dados, $classEnvio;
    public function __construct($classEmail, $dados){
        $this->dados = $dados;
        $this->email = $dados['email'];
        $this->classEnvio = $classEmail;
    }

    public function handle(){
        try{
            $tipo = EnvConfig::ObtemEmailTipoEnvio();
            $objEnvio = new $this->classEnvio($this->dados);
            if(strcasecmp($tipo, 'SMTP') ==  0){
                Mail::to($this->email)->send($objEnvio);
            }elseif(strcasecmp($tipo, 'MAUTIC') == 0){
                $objEnvio->SubmetMautic();
            }elseif(strcasecmp($tipo, 'SES') == 0){
                $objEnvio->SendSES();
            }else{
                Log::error("O tipo de envio [$tipo] não foi encontrado para envio");
            }
        }
        catch(Exception $erro){
            Log::error($erro);
        }
    }
}
