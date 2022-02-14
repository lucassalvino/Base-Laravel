<?php 
namespace App\Servicos;

use App\Models\Questionario\PerguntaQuestionario;
use App\Models\Questionario\Questionario;
use App\Utils\BaseRetornoApi;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class QuestionarioServico{
    function __construct() {
    }

    public function ExisteArrayPerguntas($requisicao){
        return (array_key_exists('perguntas', $requisicao) && is_array($requisicao['perguntas']));
    }

    public function GeraRetornoSemPerguntas(){
        return Questionario::GeraErro(["O campo perguntas é requerido ou é necessário enviar um array de perguntas"]);
    }

    public function AtualizaCadastraPerguntas($perguntas, $questionarioId){
        foreach($perguntas as $pergunta){
            $pergunta['questionario_id'] = $questionarioId;
            $retor = null;
            if(array_key_exists('id', $pergunta)){
                $retor = PerguntaQuestionario::AtualizaElementoArray($pergunta, $pergunta['id']);
            }else{
                $retor = PerguntaQuestionario::CadastraElementoArray($pergunta);
            }
            if(PerguntaQuestionario::CheckIfIsValidator($retor)){
                return PerguntaQuestionario::GeraErro($retor);
            }
        }
        return $retor;
    }

    /**
     * realiza cadastro de questionario
     * espera um array contendo os dados de questionario e um array com perguntas
     */
    public function CadastraQuestionario($requisicao){
        DB::beginTransaction();
        try{
            $cadastroQuestionario = Questionario::CadastraElementoArray($requisicao);
            if(Questionario::CheckIfIsValidator($cadastroQuestionario)){
                return Questionario::GeraErro($cadastroQuestionario);
            }

            if( !$this->ExisteArrayPerguntas($requisicao) ){
                return $this->GeraRetornoSemPerguntas();
            }

            $cadastroPerguntas = $this->AtualizaCadastraPerguntas($requisicao['perguntas'] ,$cadastroQuestionario);
            if(!is_null($cadastroPerguntas) && PerguntaQuestionario::CheckIfIsValidator($cadastroPerguntas)){
                return PerguntaQuestionario::GeraErro($cadastroPerguntas);
            }
            
            DB::commit();
            return BaseRetornoApi::GetRetornoSucessoId("Questionário cadastrado com sucesso" , $cadastroQuestionario);
        }
        catch (Exception $erro){
            Log::error($erro);
            return Questionario::GeraErro([$erro->getMessage]);
        }
    }


    public function Listagem(Request $request){
        return Questionario::ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id){
        return Questionario::Detalhado($request, $id);
    }

    public function Atualiza($requisicao, $id){
        DB::beginTransaction();
        try{
            $registroBanco = Questionario::query()->where('id', '=', $id)->first();
            if(!$registroBanco){
                return BaseRetornoApi::GetRetorno404("O questionário informado não existe");
            }
            $atualizacao = Questionario::AtualizaElementoArray($requisicao, $registroBanco);
            if(Questionario::CheckIfIsValidator($atualizacao)){
                return Questionario::GeraErro($atualizacao);
            }

            if( !$this->ExisteArrayPerguntas($requisicao) ){
                return $this->GeraRetornoSemPerguntas();
            }

            $cadastroPerguntas = $this->AtualizaCadastraPerguntas($requisicao['perguntas'] ,$id);
            if(!is_null($cadastroPerguntas) && PerguntaQuestionario::CheckIfIsValidator($cadastroPerguntas)){
                return PerguntaQuestionario::GeraErro($cadastroPerguntas);
            }

            DB::commit();
            return BaseRetornoApi::GetRetornoSucessoId("Questionário atualizado com sucesso", $id);
        }
        catch(Exception $erro){
            Log::error($erro);
            return Questionario::GeraErro($erro);
        }
    }

    public function Deleta(Request $request, $id){
        return Questionario::DeleteElemento($request, $id);
    }

    public function Restaura(Request $request, $id){
        return Questionario::RestoreElemento($request, $id);
    }
}