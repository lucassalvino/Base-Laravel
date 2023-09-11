<?php
namespace App\Models\Enuns;

class TipoWhiteList extends BaseEnum{
    protected $enumeradores = [
        'ip' => 'IP',
        'dominio' => 'Domínio'
    ];

    const IP = 'ip';
    const Dominio = 'dominio';
}
