<?php 
namespace App\Email\Emails;

use App\Email\BaseHtmlEmail;

class EmailSenhaAlterada extends BaseHtmlEmail{
    public $nomeUsuario;
    public $userAgent;
    public $ipalteracao;

    protected function GeraHtmlEnvio(){
        $nomeusuario = $this->nomeUsuario;
        $corfonte = $this->corfonte;
        $userAgent = $this->userAgent;
        $ipalteracao = $this->ipalteracao;
        
        $retorno = <<<HTML
            <tr>
                <td style="padding-top: 30px; color: $corfonte; text-align: center;font-size: 22px; line-height: 26px;">
                    <strong>CIT - Notificação de redefinição de senha</strong>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 30px; color: $corfonte; text-align: center; font-size: 16px; line-height: 20px;">
                    Olá $nomeusuario! <br> Sua senha acabou de ser redefinida.
                </td>
            </tr>
            <tr>
                <td style="padding-top: 15px; color: $corfonte; text-align: center; font-size: 16px; line-height: 20px;">
                    Segue dados de acesso que realizou a alteração<br><br>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px; color: $corfonte; text-align: center; font-size: 16px; line-height: 20px;">
                    <b>Dados dispositivo:</b> $userAgent
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px; color: $corfonte; text-align: center; font-size: 16px; line-height: 20px;">
                    <b>IP requisição:</b> $ipalteracao
                </td>
            </tr>

        HTML;
        return $this->ObtemSomenteHtml($retorno);
    }
}