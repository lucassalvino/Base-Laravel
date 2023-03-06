<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class TipoChavePIX extends BaseEnum{
    protected $enumeradores = [
        'cpf' => 'CPF',
        'cnpj' => 'CNPJ',
        'telefone' => 'Telefone',
        'email' => 'Email',
        'aleatoria' => 'Aleatória'
    ];

    const CPF = 'cpf';
    const CNPJ = 'cnpj';
    const Telefone = 'telefone';
    const Email = 'email';
    const Aleatoria = 'aleatoria';
}