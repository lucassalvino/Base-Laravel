<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class StatusRecebedor extends BaseEnum{
    protected $enumeradores = [
        'ativo' => 'Ativo',
        'inativo' => 'Inativo',
        'recusado' => 'Recusado'
    ];

    const Ativo = 'ativo';
    const Inativo = 'inativo';
    const Recusado = 'recusado';
}