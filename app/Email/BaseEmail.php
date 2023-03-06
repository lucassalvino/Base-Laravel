<?php 
namespace App\Email;

use App\Servicos\IntegracaoMautic;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseEmail extends Mailable{

    use Queueable, SerializesModels;

    public $dadosEnvio = null;

    /**
     * ID do formulário no mautic. Deve ser numero inteiro
     */
    public $FormularioId = 0;

    /**
     * Este assunto somente sera utilizado quando o tipo de envio for SMTP
     */
    public $Assunto = "";

    /**
     * Esta é a view que sera utilizada para envio quando o tipo de envio for SMTP
     */
    public $view = "";

    function __construct($dadosEnvio){
        $this->dadosEnvio = $dadosEnvio;
    }

    public function SubmetMautic(){
        $integracao = new IntegracaoMautic();
        $integracao->SubmeteFormulario($this->dadosEnvio, $this->FormularioId);
    }

    public function build(){
        return $this
        ->subject($this->Assunto)
        ->view( $this->view , $this->dadosEnvio);
    }
}