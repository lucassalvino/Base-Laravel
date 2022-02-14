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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $classEmail, $emailDestino, $dados){
        $this->dados = $dados;
        $this->email = $emailDestino;
        $this->classEnvio = $classEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        try{
            $tipo = EnvConfig::ObtemEmailTipoEnvio();
            $objEnvio = new $this->classEnvio($this->dados);
            if(strcasecmp($tipo, 'SMTP') ==  0){
                Mail::to($this->email)->send($objEnvio);
            }elseif(strcasecmp($tipo, 'MAUTIC') == 0){
                $objEnvio->SubmetMautic();
            }else{
                Log::error("O tipo de envio [$tipo] não foi encontrado para envio");
            }
        }
        catch(Exception $erro){
            Log::error($erro);
        }
    }
}
