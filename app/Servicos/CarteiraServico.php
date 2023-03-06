<?php
namespace App\Servicos;

use App\Models\Carteira\Carteira;
use App\Models\Carteira\CarteiraMovimentacao;
use App\Models\Enuns\Carteira\StatusMovimentacao;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class CarteiraServico{
    private Carteira $carteira;

    public static function ObtemCarteira($usuario_id) : Carteira{
        $carteira = Carteira::query()->where('id', '=', $usuario_id)->first();
        if($carteira){
            return $carteira;
        }
        $agora = Carbon::now()->timezone('America/Sao_Paulo')->toDateTimeString();
        DB::table('usuario_carteira')->insert(Array(
            'id' => $usuario_id,
            'saldo_disponivel' => 0,
            'saldo_a_receber' => 0,
            'saldo_bloqueado' => 0,
            'ultima_atualizacao_saldos' => $agora,
            'updated_at' => $agora,
            'created_at' => $agora
        ));
        return Carteira::query()->where('id', '=', $usuario_id)->first();
    }

    public function __construct($usuario_id){
        $carteira = static::ObtemCarteira($usuario_id);
        if(!is_null($carteira)){
            $this->carteira = $carteira;
        }else{
            throw new Exception("Não foi possível carregar a carteira");
        }
    }

    public function ObtemSaldoConta(){
        return [
            "id" => $this->carteira->id,
            "saldo_disponivel" => $this->carteira->saldo_disponivel,
            "saldo_a_receber" => $this->carteira->saldo_a_receber,
            "saldo_bloqueado" => $this->carteira->saldo_bloqueado,
            "created_at" => $this->carteira->created_at
        ];
    }

    public function RealizaMovimentacao($valor, $descricao, $tipoMovimentacao, $cobranca_id = null, $saque_id = null, $cobranca_split_id = null, $data_disponivel = null){
        $descricao = trim($descricao);
        if(!isset($descricao) || ($descricao == '')){
            throw new Exception("É necessário informar uma descrição para a movimentação");
        }
        if(!is_numeric($valor)){
            throw new Exception("É necessário informar o valor da movimentação");
        }
        if(is_null($data_disponivel)){
            $data_disponivel = Carbon::now()->timezone('America/Sao_Paulo')->toDateTimeString();
        }
        $saldoAnterior = $this->carteira->saldo_a_receber;
        $insertMovimentacao = [
            'usuario_carteira_id' => $this->carteira->id,
            'saldo_antes_movimentacao' => $saldoAnterior,
            'saldo_depois_movimentacao' => ($saldoAnterior + $valor),
            'valor_movimentacao' => $valor,
            'descricao_curta' => $descricao,
            'descricao' => $descricao,
            'dados_movimentacao' => json_encode([
                'cobranca_id' => $cobranca_id,
                'saque_id' => $saque_id,
                'cobranca_split_id' => $cobranca_split_id
            ]),
            'status' => StatusMovimentacao::Novo,
            'tipo_movimentacao' => $tipoMovimentacao,
            'data_disponivel' => $data_disponivel,
            'usuario_id' => $this->carteira->id,
            'parent_id' => null,
            'hash' => base64_encode(openssl_encrypt(
                json_encode($this->carteira),
                "AES-256-CBC",
                env('KEY_CARTEIRA_CRIP', "CAFECOMLEITE"),
                0,
                env('VETOR_INICIALIZACAO_CRIP', 'bAsE_lArAvEl_lsd')
            ))
        ];
        $movimentacao = CarteiraMovimentacao::create($insertMovimentacao);
        if($movimentacao){
            $this->carteira->saldo_a_receber = $this->carteira->saldo_a_receber + $valor;
            $this->carteira->save();
        }
        return $movimentacao;
    }
}