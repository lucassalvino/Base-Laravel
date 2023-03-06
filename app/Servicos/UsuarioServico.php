<?php
namespace App\Servicos;

use App\Models\Enuns\TipoDocumento;
use App\Models\Pessoa\Documento;
use App\Models\Pessoa\Endereco;
use App\Models\Pessoa\Telefone;
use App\Models\User;
use App\Utils\BaseRetornoApi;
use App\Utils\Strings;
use App\Utils\Valida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioServico{
    function __construct() {
    }

    private function ObtemArrayUsuario(Request $request, $atualizacao = false){
        $retorno = [];
        $chavesAdicionar = [
            'name',
            'username',
            'email',
            'base_path_avatar',
            'tipo_path_avatar',
            'sexo',
            'data_nascimento'
        ];

        foreach($chavesAdicionar as $chave){
            if(!is_null($request->get($chave, null))){
                $retorno[$chave] = $request->get($chave);
            }
        }

        if(!Strings::isNullOrEmpty($request->get('password'))){
            $retorno['password'] = $request->get('password');
        }

        return $retorno;
    }

    private function ObtemArrayDocumento($documento, $usuario_id){
        $retorno = [
            'tipo' => Valida::CPF($documento) ? TipoDocumento::CPF : TipoDocumento::CNPJ,
            'numero' => Strings::SomenteNumeros($documento),
            'usuario_id' => $usuario_id
        ];
        return $retorno;
    }

    private function ObtemArrayTelefone($telefone, $usuario_id){
        $numero = Strings::SomenteNumeros($telefone);
        $retorno = [
            'usuario_id' => $usuario_id,
            'ddd' => mb_substr($numero, 0, 2),
            'numero' => mb_substr($numero, 2)
        ];
        return $retorno;
    }

    public static function ObtemUsuariosGrupo($slugGrupo){
        $sql = "SELECT users.id, users.name From users
        inner join usuario_grupo ON usuario_grupo.usuario_id = users.id
        inner join grupo on grupo.id = usuario_grupo.grupo_id
        where grupo.slug = '".$slugGrupo."'";
        return DB::select($sql);
    }

    public function CadastraUsuario(Request $request){
        DB::beginTransaction();
        try{
            $dados = $this->ObtemArrayUsuario($request);
            $cadastro = User::CadastraElementoArray($dados);
            if(!User::VerificaRetornoSucesso($cadastro)){
                return User::GeraErro($cadastro);
            }
            $dadosEndereco = $request->get('endereco');
            if(!is_null($dadosEndereco)){
                $dadosEndereco['usuario_id'] = $cadastro;
                $cdEndereco = Endereco::CadastraElementoArray($dadosEndereco);
                if(!Endereco::VerificaRetornoSucesso($cdEndereco)){
                    return Endereco::GeraErro($cdEndereco);
                }
            }
            $documento = $request->get('documento');
            if(!is_null($documento)){
                $arryDoc = $this->ObtemArrayDocumento($documento, $cadastro);
                $cdDocumento = Documento::CadastraElementoArray($arryDoc);
                if(!Documento::VerificaRetornoSucesso($cdDocumento)){
                    return Documento::GeraErro($cdDocumento);
                }
            }
            $telefone = $request->get('telefone');
            if(!is_null($telefone)){
                $arryTel = $this->ObtemArrayTelefone($telefone, $cadastro);
                $cdTelefone = Telefone::CadastraElementoArray($arryTel);
                if(!Telefone::VerificaRetornoSucesso($cdTelefone)){
                    return Telefone::GeraErro($cdTelefone);
                }
            }
            DB::commit();
            return BaseRetornoApi::GetRetornoSucessoId("Usuário cadastrado com sucesso", $cadastro);
        }catch(Exception $erro){
            return User::GeraErro($erro);
        }
    }

    public function Atualiza(Request $request, $id){
        DB::beginTransaction();
        try{
            $dadosUpdate = $this->ObtemArrayUsuario($request, true);
            $usuario = User::query()->where('id', '=', $id)->first();
            if(!$usuario){
                return BaseRetornoApi::GetRetorno404("Usuário não foi encontrado");
            }
            $atualizacao = User::AtualizaElementoArray($dadosUpdate, $usuario);
            if(!User::VerificaRetornoSucesso($atualizacao)){
                return User::GeraErro($atualizacao);
            }
            $dadosEndereco = $request->get('endereco');
            if(!is_null($dadosEndereco)){
                $dadosEndereco['usuario_id'] = $id;
                $enderecoDB = Endereco::query()
                    ->where('usuario_id', '=', $id)
                    ->first();
                if($enderecoDB){
                    $upEndereco = Endereco::AtualizaElementoArray($dadosEndereco, $enderecoDB);
                }else{
                    $upEndereco = Endereco::CadastraElementoArray($dadosEndereco);
                }
                if(!Endereco::VerificaRetornoSucesso($upEndereco)){
                    return Endereco::GeraErro($upEndereco);
                }
            }
            $documento = $request->get('documento');
            if(!is_null($documento)){
                $arryDoc = $this->ObtemArrayDocumento($documento, $id);
                $documentoDB = Documento::query()
                    ->where('usuario_id', '=', $id)
                    ->first();
                if($documentoDB){
                    $upDocumento = Documento::AtualizaElementoArray($arryDoc, $documentoDB);
                }else{
                    $upDocumento = Documento::CadastraElementoArray($arryDoc);
                }
                if(!Documento::VerificaRetornoSucesso($upDocumento)){
                    return Documento::GeraErro($upDocumento);
                }
            }
            $telefone = $request->get('telefone');
            if(!is_null($telefone)){
                $arryTel = $this->ObtemArrayTelefone($telefone, $id);
                $telefoneDb = Telefone::query()
                    ->where('usuario_id', '=', $id)
                    ->first();
                if($telefoneDb){
                    $upTelefone = Telefone::AtualizaElementoArray($arryTel ,$telefoneDb);
                }else{
                    $upTelefone = Telefone::CadastraElementoArray($arryTel);
                }
                if(!Telefone::VerificaRetornoSucesso($upTelefone)){
                    return Telefone::GeraErro($upTelefone);
                }
            }
            DB::commit();
            return BaseRetornoApi::GetRetornoSucessoId("Usuário atualizado com sucesso!", $atualizacao);
        }catch(Exception $erro){
            return User::GeraErro($erro);
        }
    }

    public function Listagem(Request $request){
        return User::ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id){
        return User::Detalhado($request, $id);
    }

    public function Deleta(Request $request, $id){
        return User::DeleteElemento($request, $id);
    }

    public function Restaura(Request $request, $id){
        return User::RestoreElemento($request, $id);
    }
}
