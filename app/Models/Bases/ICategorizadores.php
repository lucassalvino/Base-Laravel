<?php 
namespace App\Models\Bases;

interface ICategorizadores {
    public static function ObtenhaRegistrosPadrao();
    public static function ObtenhaRegistrosAtuais(Array $ColunaListar, bool $RetornarPadrao = false);
}