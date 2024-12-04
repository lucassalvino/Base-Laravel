<?php
namespace App\Email;

use App\Servicos\IntegracaoMautic;
use App\Servicos\IntregracaoSES;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseEmail extends Mailable{

    use Queueable, SerializesModels;

    public $dadosEnvio = null;

    public $FormularioId = 0;
    public $Assunto = "";
    public $view = "";

    function __construct($dadosEnvio){
        $this->dadosEnvio = $dadosEnvio;
        $this->Assunto = $this->dadosEnvio['assunto_email'];
    }

    public function SubmetMautic(){
        $integracao = new IntegracaoMautic();
        $integracao->SubmeteFormulario($this->dadosEnvio, $this->FormularioId);
    }

    public function SendSES(){
        $integracao = new IntregracaoSES();
        $integracao->SendEmail($this->dadosEnvio['email'], $this->dadosEnvio['assunto_email'], $this->dadosEnvio['html_email_geral']);
    }

    public function build(){
        return $this
        ->subject($this->Assunto)
        ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
        ->html($this->dadosEnvio['html_email_geral']);
    }
}
