<?php
namespace App\Models\Carteira;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

Class Carteira extends BaseModel{
    protected $table = 'usuario_carteira';
    protected $fillable = [
        'id', 'saldo_disponivel', 'saldo_a_receber', 'saldo_bloqueado',
        'ultima_atualizacao_saldos'
    ];

    public function ConstruiFiltroListagem(Builder $consulta, Request $request): Builder{
        $consulta = $consulta->join('users', 'users.id', '=', 'usuario_carteira.id');
        return $consulta;
    }

    public function ColunasListagem(): array
    {
        return [
            'users.id',
            'users.name',
            'users.email',
            'usuario_carteira.saldo_disponivel',
            'usuario_carteira.saldo_a_receber',
            'usuario_carteira.saldo_bloqueado'
        ];
    }

    public static function ListagemElemento(Request $request, $nopaginate = NULL){
        $retorno = parent::ListagemElemento($request, $nopaginate);
        foreach($retorno as $ret){
            $ret->saldo_disponivel = number_format(($ret->saldo_disponivel/100), 2, ',', '.');
            $ret->saldo_a_receber = number_format(($ret->saldo_a_receber/100), 2, ',', '.');
            $ret->saldo_bloqueado = number_format(($ret->saldo_bloqueado/100), 2, ',', '.');
        }
        return $retorno;
    }

    public function GetLikeFields(){
        return [
            'users.name',
            'users.email'
        ];
    }

    public static function ObtemViewCarteira($carteira_id){
        $ret = Carteira::query()
            ->join('users', 'users.id', '=', 'usuario_carteira.id')
            ->where('usuario_carteira.id', '=', $carteira_id)
            ->first([
                'users.id',
                'users.name',
                'usuario_carteira.saldo_disponivel',
                'usuario_carteira.saldo_a_receber',
                'usuario_carteira.saldo_bloqueado'
            ]);
        if($ret){
            $ret->saldo_disponivel = number_format(($ret->saldo_disponivel/100), 2, ',', '.');
            $ret->saldo_a_receber = number_format(($ret->saldo_a_receber/100), 2, ',', '.');
            $ret->saldo_bloqueado = number_format(($ret->saldo_bloqueado/100), 2, ',', '.');
        }
        return $ret;
    }
}