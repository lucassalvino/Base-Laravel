<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class StatusSaque extends BaseEnum{
    protected $enumeradores = [
        'falha' => 'Falha',
        'pendente' => 'Pendente',
        'processando' => 'Processando',
        'concluido' => 'Concluido'
    ];

    const Falha = 'falha';
    const Pendente = 'pendente';
    const Processando = 'processando';
    const Concluido = 'concluido';
}