<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class TipoConta extends BaseEnum{
    protected $enumeradores = [
        'poupanca' => 'Poupança',
        'corrente' => 'Corrente'
    ];

    const Poupanca = 'poupanca';
    const Corrente = 'corrente';
}