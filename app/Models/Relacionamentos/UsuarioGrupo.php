<?php
namespace App\Models\Relacionamentos;

use App\Models\Bases\BaseModelPKComposta;
use App\Models\Grupo;
use App\Models\User;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

Class UsuarioGrupo extends BaseModelPKComposta{
    protected $table = 'usuario_grupo';

    protected $fillable = [
        'grupo_id', 'usuario_id'
    ];
    
    protected $primaryKey = ['grupo_id', 'usuario_id'];

    private static $Grupos = Array();

    private static function CarregaGrupos($idsValidar){
        if(count(self::$Grupos) <= 0 && (isset($idsValidar) && is_array($idsValidar))){
            self::$Grupos = Grupo::query()->whereIn('id',$idsValidar)->orderBy('id')->get(['id']);
        }
        return self::$Grupos;
    }

    public static function CadastraUsuarioGrupo(Request $request){
        $arrayErros = Array();
        if(isset($request['usuarios']) && is_array($request['usuarios'])){
            foreach($request['usuarios'] as $usuario){
                $usuarioId =  $usuario['usuario_id'];
                if(isset($usuarioId)){
                    $usuarioBanco = User::query()->where('id', '=', $usuarioId)->first();
                    if($usuarioBanco){
                        $gruposUsuario = UsuarioGrupo::withTrashed()->where('usuario_id','=',$usuarioBanco->id)->get();
                        $erros = self::ProcessaAtualizacaoCadastro('usuario_id', 'grupo_id', $usuarioBanco, $usuario['grupos'], self::CarregaGrupos($usuario['grupos']), $gruposUsuario);
                        array_merge($arrayErros, $erros);
                    }else{
                        array_push($arrayErros, "O Id do usuário informado não é válido");    
                    }
                }else{
                    array_push($arrayErros, "O Id do usuário não foi setado");
                }
            }
        }else{
            array_push($arrayErros, "Nenhum usário foi definido");
        }

        return BaseRetornoApi::GetRetornoPostArrayErros($arrayErros, "Dados salvos com sucesso");
    }
}