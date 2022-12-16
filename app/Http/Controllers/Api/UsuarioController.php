<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bases\IAPIController;
use App\Models\User;
use App\Servicos\UsuarioServico;
use Illuminate\Http\Request;

/**
 * @group Usuário
 *
 * Endponits para gestão de usuários
 */
class UsuarioController extends Controller implements IAPIController
{
    private $servico = null;
    function __construct()
    {
        $this->servico = new UsuarioServico();
    }

    /**
     * Realiza o cadastro do usuários
     *
     * @bodyParam  name     string  required    Nome que o usuário deseja ser chamado, tamanho máximo de 255 caracteres
     * @bodyParam  username     string  required    nome do usuário (para login), colocar email como padrão
     * @bodyParam  email     string  required    email do usuário
     * @bodyParam  sexo    enum  required      Sexo do usuário, Obtito no categorizador. Se não for informado será preenchido com guid empty
     * @bodyParam  password     string  required     Senha (não criptografada) do usuário. Não será executada nenhuma validação de complexidade de senha.
     * @bodyParam  avatar_base_64     string  required     String base64 contendo o base64 da imagem de do avatar do usuário
     * @bodyParam  tipo_imagem_avatar     string  required     tipo da imagen (ex. image/jpg)
     *
     * @response Retornos padrões
     */
    function Cadastra(Request $request)
    {
        return $this->servico->CadastraUsuario($request);
    }

    /**
     * Obtem Listagem de usuários
     * Possui todos os filtros padrões
     *
     *
     * @response padrões
     *
     * @authenticated
     */
    function Listagem(Request $request)
    {
        return $this->servico->Listagem($request);
    }

    /**
     * Obtem Visualizao unica de usuário
     *
     * @authenticated
     */
    public function Detalhado(Request $request, $id)
    {
        return $this->servico->Detalhado($request, $id);
    }

    /**
     * Atualiza Usuário
     *
     * @bodyParam  name     string  required    Nome que o usuário deseja ser chamado, tamanho máximo de 255 caracteres
     * @bodyParam  username     string  required    nome do usuário (para login), colocar email como padrão
     * @bodyParam  email     string  required    email do usuário
     * @bodyParam  sexo    enum  required      Sexo do usuário, Obtito no categorizador. Se não for informado será mantido o atual
     * @bodyParam  password     string  required     Senha (não criptografada) do usuário. Se não for informado, será mantida a atual
     * @bodyParam  avatar_base_64     string  required     String base64 contendo o base64 da imagem de do avatar do usuário
     * @bodyParam  tipo_imagem_avatar     string  required     tipo da imagen (ex. image/jpg)
     *
     *
     * @authenticated
     */
    function Atualiza(Request $request, $id)
    {
        return $this->servico->Atualiza($request, $id);
    }

    /**
     * Move o usuário para a lixeira
     */
    function Deleta(Request $request, $id)
    {
        return $this->servico->Deleta($request, $id);
    }

    /**
     * Remove o usuário da lixeira
     */
    function Restaura(Request $request, $id)
    {
        return $this->servico->Restaura($request, $id);
    }

    public function ClonarRegistro (Request $request, $id){
        return User::ClonaRegistro($request, $id);
    }
}
