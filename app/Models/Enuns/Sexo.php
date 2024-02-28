<?php
namespace App\Models\Enuns;

class Sexo extends BaseEnum
{
    protected $enumeradores = [
        'masculino' => 'Masculino',
        'feminino' => 'Feminino',
        'outro' => 'Outro',
        'naodefinido' => 'Não definido'
    ];

    const Masculino = 'masculino';
    const Feminino = 'feminino';
    const Outro = 'outro';
    const NaoDefinido = 'naodefinido';
}
