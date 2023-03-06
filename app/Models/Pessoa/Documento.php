<?php
namespace App\Models\Pessoa;
use App\Models\Bases\BaseModel;
use App\Models\Enuns\TipoDocumento;
use App\Rules\ValidaEnum;
use Illuminate\Validation\Rule;

Class Documento extends BaseModel{
    protected $table = 'documento';
    protected $fillable = [
        'id', 'tipo', 'numero', 'usuario_id'
    ];

    public function GetValidadorCadastro($request){
        $numero = isset($request['numero']) ? $request['numero'] : '';
        $tipo = isset($request['tipo']) ? $request['tipo'] : '';
        return [
            'tipo' => ['required', 'max:100', new ValidaEnum(TipoDocumento::class)],
            'numero' => [
                'required',
                'max:300',
                Rule::unique('documento')
                ->where(function ($query) use($numero, $tipo) {
                    return $query->where('tipo', '=', $tipo)
                    ->where('numero', '=', $numero);
                })
            ]
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validacao = $this->GetValidadorCadastro($request);
        $numero = isset($request['numero']) ? $request['numero'] : '';
        $tipo = isset($request['tipo']) ? $request['tipo'] : '';
        $validacao['numero'] = [
            'required',
            'max:300',
            Rule::unique('documento')
            ->where(function ($query) use($numero, $tipo) {
                return $query->where('tipo', '=', $tipo)
                ->where('numero', '=', $numero);
            })->ignore($id)
        ];
        return $validacao;
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