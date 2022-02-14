<?php
namespace App\Models\Pessoa\Relacionamentos;
use App\Models\Bases\BaseModelPKComposta;

Class UsuarioTelefone extends BaseModelPKComposta{
    protected $table = 'users_telefone';
    protected $fillable = [
        'usuario_id', 'telefone_id'
    ];
    protected $primaryKey = ['usuario_id', 'telefone_id'];
}