<?php
namespace App\Models\Pessoa;
use App\Models\Bases\BaseModel;

Class Endereco extends BaseModel{
    protected $table = 'endereco';
    protected $fillable = [
        'id', 'cep', 'logradouro', 'numero', 'bairro', 'complemento',
        'cidade', 'estado', 'padrao', 'latitude', 'longitude'
    ];

    public function GetLikeFields(){
        return [
            'cep' => 'required|max:40',
            'logradouro' => 'required|max:300',
            'numero' => 'required|max:15',
            'bairro' => 'required|max:250',
            'complemento' => 'required|max:250',
            'cidade' => 'required|max:250',
            'estado' => 'required|max:100'
        ];
    }

    public static function ObtemEnderecosUsuario($usuarioId){
        return Endereco::query()
        ->join('users_endereco', 'users_endereco.endereco_id', '=', 'endereco.id')
        ->where('users_endereco.usuario_id', '=', $usuarioId)
        ->get([
            'endereco.id',
            'endereco.cep',
            'endereco.logradouro',
            'endereco.numero',
            'endereco.bairro',
            'endereco.complemento',
            'endereco.cidade',
            'endereco.estado',
            'endereco.padrao',
            'endereco.latitude',
            'endereco.longitude'
        ]);
    }
}