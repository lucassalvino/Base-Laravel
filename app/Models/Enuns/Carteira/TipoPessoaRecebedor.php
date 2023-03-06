<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class TipoPessoaRecebedor extends BaseEnum{
    protected $enumeradores = [
        'pessoa_fisica' => 'Pessoa Física',
        'pessoa_juridica' => 'Perssoa Jurídica'
    ];

    const PessoaJuridica = 'pessoa_juridica';
    const PessoaFisica = 'pessoa_fisica';
}