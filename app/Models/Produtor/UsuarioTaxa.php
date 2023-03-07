<?php
namespace App\Models\Produtor;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UsuarioTaxa extends BaseModel{
    public static $TaxasParcelamentoPadrao = [1, 1.044, 1.059, 1.0741, 1.0893, 1.1047, 1.1202, 1.1358, 1.1517, 1.1677, 1.1837, 1.2];
    public static $taxaPlataformaPadrao = 6.9;
    public static $taxaFixaPadrao = 2;
    public static $DiasAdiantamentoPadrao = 20;
    public static $TaxaConvenienciaPadrao = 10;

    protected $table = "usuario_taxa";
    protected $fillable = [
        'id', 'usuario_id', 'taxas'
    ];

    public function GetValidadorCadastro($request){
        return [
            'usuario_id' => 'required|exists:users,id',
            'taxas'=> 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $retorno = $this->GetValidadorCadastro($request);
        $retorno['usuario_id'] = ['exists:users,id'];
        return $retorno;
    }

    public static function ObtemArrayTaxasPadrao(){
        return Array(
            'taxaplataforma' => self::$taxaPlataformaPadrao,
            'taxafixa' => self::$taxaFixaPadrao,
            'taxaplataforma_pix' => self::$taxaPlataformaPadrao,
            'taxafixa_pix' => self::$taxaFixaPadrao,
            'taxaplataforma_boleto' => self::$taxaPlataformaPadrao,
            'taxafixa_boleto' => self::$taxaFixaPadrao,
            'dias_adiantamento' => self::$DiasAdiantamentoPadrao,
            'taxasparcelamento' => self::$TaxasParcelamentoPadrao,
            'taxaconveniencia' => self::$TaxaConvenienciaPadrao
        );
    }

    public function ConstruiFiltroListagem(Builder $consulta, Request $request): Builder{
        $consulta = $consulta->join('users', 'users.id', '=', 'usuario_taxa.usuario_id');
        return $consulta;
    }

    public function ColunasListagem(): array{
        return [
            'usuario_taxa.id',
            'users.name as nome_usuario'
        ];
    }
}