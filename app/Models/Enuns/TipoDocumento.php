<?php
namespace App\Models\Enuns;

class TipoDocumento extends BaseEnum
{
    protected $enumeradores = [
        'cpf' => 'CPF',
        'cnpj' => 'CNPJ'
    ];

    const CPF = 'cpf';
    const CNPJ = 'cnpj';
}
