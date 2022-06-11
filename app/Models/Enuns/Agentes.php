<?php
namespace App\Models\Enuns;

class Agentes extends BaseEnum
{
    protected $enumeradores = [
        'recorrencia' => 'Recorrencia' ,
        'webhook_pagarme' => 'WebHook Pagarme',
        'servico_aplicacao' => 'Servico Aplicação',
        'usuario' => 'Usuário'
    ];

    const Recorrencia = 'recorrencia';
    const WebHookPagarme = 'webhook_pagarme';
    const ServicoAplicacao = 'servico_aplicacao';
    const Usuario = 'usuario';
}