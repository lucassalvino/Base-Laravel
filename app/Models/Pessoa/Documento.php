<?php
namespace App\Models\Pessoa;
use App\Models\Bases\BaseModel;

Class Documento extends BaseModel{
    protected $table = 'documento';
    protected $fillable = [
        'id', 'tipo', 'numero', 'usuario_id'
    ];

    public function GetValidadorCadastro($request){
        return [
            'tipo' => 'required|max:100',
            'numero' => 'required|max:300',
        ];
    }

    public static function ObtemDocumentosUsuario($usuarioId){
        return Documento::query()
        ->where('documento.usuario_id', '=', $usuarioId)
        ->get([
            'documento.id',
            'documento.tipo',
            'documento.numero'
        ]);
    }
}