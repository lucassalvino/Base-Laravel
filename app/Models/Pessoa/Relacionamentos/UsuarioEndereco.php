<?php
namespace App\Models\Pessoa\Relacionamentos;
use App\Models\Bases\BaseModelPKComposta;

Class UsuarioEndereco extends BaseModelPKComposta{
    protected $table = 'users_endereco';
    protected $fillable = [
        'usuario_id', 'endereco_id'
    ];
    
    protected $primaryKey = ['usuario_id', 'endereco_id'];
}