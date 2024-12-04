<?php
namespace App\Email;

use App\Jobs\JobEnvioEmail;

class BaseHtmlEmail{
    protected $email;
    protected $assunto;

    protected $corfonte;
    protected $corfundo;
    protected $corfundofundo;//?????
    protected $tamanhologo;
    protected $backgorundbotao;
    protected $corbotao;

    public function __construct(){
        $this->corfonte = '#262626';
        $this->corfundo = '#ffffff';
        $this->corbotao = '#ffffff';
        $this->corfundofundo = '#EAEAEA';
        $this->backgorundbotao = '#2c3030';
        $this->tamanhologo = '300px';
    }

    protected function ObtemSomenteHtml($texto){
        return trim(preg_replace('/\s\s+/', ' ', $texto));
    }

    public function EnviaEmail($assunto, $email, $logo = null){
        $this->assunto = $assunto;
        $this->email = $email;
        $conteudo = $this->GeraHtmlEnvio();
        $html = $this->ObtemHtmlClearEmail($this->assunto, $conteudo, $logo);
        $dadosEnvio = [
            'email' => $email,
            'assunto_email' => $assunto,
            'html_email_geral' => $html
        ];
        JobEnvioEmail::dispatch(BaseEmail::class, $dadosEnvio);
    }

    protected function GeraHtmlEnvio(){
        return "";
    }

    private function ObtemHtmlClearEmail($assunto, $conteudo, $logo = null){
        $dns           = route('home.site');
        $path_logo     = is_null($logo) ? asset("assets/img/logo-cit.png") : $logo;
        $logo_tamanho  = $this->tamanhologo;
        $corfundofundo = $this->corfundofundo;
        $corfundo      = $this->corfundo;
        $corfonte      = $this->corfonte;

        $retorno = <<<HTML
            <head>
                <title>$assunto</title>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <style type="text/css">
                    table {border-collapse: separate;}
                    p{color: $corfonte;font-family: "Helvetica";font-size: 16px;line-height: 24px;margin:20px 0 0 0;}
                    .text-min p{font-size: 13px;line-height: 18px;}
                    h1{color: $corfonte;font-family: "Helvetica";font-size: 30px;line-height: 40px;margin: 0;}
                    .text-min a{font-size: 13px;line-height: 18px;}
                    a {color: $corfonte!important;font-weight: bold;font-family: "Helvetica";font-size: 16px;line-height: 24px;margin: 0;text-decoration: none;}
                    ul { padding-left: 0; }
                    img {max-width: 100%;height: auto;}
                    h6{margin:0;}
                </style>
            </head>
            <body>
                <table cellpadding="0"
                       cellspacing="0"
                       border="0"
                       width="100%"
                       class="template-email"
                       style="background-color:$corfundofundo;margin: 0;padding:48px 24px;">
                    <tr>
                        <td valign="top" align="center">
                            <table cellpadding="0"
                                   cellspacing="0"
                                   align="center"
                                   width="600px"
                                   style="padding: 48px; box-shadow: 0px 4px 12px rgba(23, 28, 30, 0.1);border-radius: 12px; background-color: $corfundo;">
                                <tr>
                                    <td colspan="6" align="left" valign="top">
                                        <table cellpadding="0"
                                               cellspacing="0"
                                               width="504px"
                                               align="left">
                                            <tr align="center">
                                                <td colspan="3" align="center" valign="center">
                                                    <a href="$dns" target="_blank">
                                                        <img src="$path_logo" width="$logo_tamanho" height="auto">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    $conteudo
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        HTML;
        return $this->ObtemSomenteHtml($retorno);
    }
}