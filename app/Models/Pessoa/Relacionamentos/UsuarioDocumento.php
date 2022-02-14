<?php
namespace App\Models\Pessoa\Relacionamentos;
use App\Models\Bases\BaseModelPKComposta;

Class UsuarioDocumento extends BaseModelPKComposta{
    protected $table = 'users_documento';
    protected $fillable = [
        'usuario_id', 'documento_id'
    ];
    protected $primaryKey = ['usuario_id', 'documento_id'];
}