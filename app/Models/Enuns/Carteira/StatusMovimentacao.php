<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class StatusMovimentacao extends BaseEnum{
    protected $enumeradores = [
        'novo' => 'Novo',
        'estornado' => 'Estornado',
        'sacado' => 'Sacado'
    ];

    const Novo = 'novo';
    const Estornado = 'estornado';
    const Sacado = 'sacado';
}