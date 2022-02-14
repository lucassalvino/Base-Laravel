<?php 
namespace App\Email\Emails;

use App\Email\BaseEmail;


class ResetSenha extends BaseEmail{
    function __construct($dadosEnvio){
        parent::__construct($dadosEnvio);
        $this->Assunto = "Solicitação de alteração de senha";
        $this->view = "Emails.RecuperacaoSenha";
        $this->FormularioId = 1;
    }
}