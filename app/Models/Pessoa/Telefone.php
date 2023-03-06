<?php
namespace App\Models\Pessoa;
use App\Models\Bases\BaseModel;

Class Telefone extends BaseModel{
    protected $table = 'telefone';
    protected $fillable = [
        'id', 'ddd', 'numero', 'padrao', 'usuario_id'
    ];

    public function GetValidadorCadastro($request){
        return [
            'ddd' => 'required|max:20',
            'numero' => 'required|max:100'
        ];
    }

    public static function ObtemTelefonesUsuario($usuarioId){
        return Telefone::query()
        ->where('telefone.usuario_id', '=', $usuarioId)
        ->get([
            'telefone.id',
            'telefone.ddd',
            'telefone.numero'
        ]);
    }
}