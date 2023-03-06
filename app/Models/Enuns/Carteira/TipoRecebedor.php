<?php
namespace App\Models\Enuns\Carteira;

use App\Models\Enuns\BaseEnum;

class TipoRecebedor extends BaseEnum{
    protected $enumeradores = [
        'ted' => 'TED',
        'pix' => 'PIX'
    ];

    const TED = 'ted';
    const PIX = 'pix';
}