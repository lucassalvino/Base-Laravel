<?php
namespace App\Models\Pessoa;
use App\Models\Bases\BaseModel;

Class Documento extends BaseModel{
    protected $table = 'documento';
    protected $fillable = [
        'id', 'tipo_id', 'numero'
    ];

    public function GetLikeFields(){
        return [
            'tipo_id' => 'required|exists:tipo_documento,id',
            'numero' => 'required|max:300',
        ];
    }

    public static function ObtemDocumentosUsuario($usuarioId){
        return Documento::query()
        ->join('users_documento', 'users_documento.documento_id', '=', 'documento.id')
        ->join('tipo_documento', 'tipo_documento.id', '=', 'documento.tipo_id')
        ->where('users_documento.usuario_id', '=', $usuarioId)
        ->get([
            'documento.id',
            'documento.tipo_id',
            'tipo_documento.descricao as tipo_documento',
            'tipo_documento.slug as slug_tipo_documento',
            'documento.numero'
        ]);
    }
}