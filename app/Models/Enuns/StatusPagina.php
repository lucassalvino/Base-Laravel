<?php
namespace App\Models\Enuns;

class StatusPagina extends BaseEnum{
    protected $enumeradores = [
        'publicada' => 'Publicada',
        'rascunho' => 'Rascunho',
        'deletada' => 'Deletada'
    ];

    const Publicada = 'publicada';
    const Rascunho = 'rascunho';
    const Deletada = 'Deletada';
}