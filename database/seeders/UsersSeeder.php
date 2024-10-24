<?php

namespace Database\Seeders;

use App\Models\ConfiguracoesSistema;
use App\Models\Grupo;
use App\Models\Relacionamentos\UsuarioGrupo;
use App\Models\User;
use App\Servicos\UsuarioServico;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
    public function run()
    {
        $usuario = User::create(Array(
            'username' => 'kame',
            'name' => "kame",
            'email' => "lucassalvino1@gmail.com",
            'path_avatar' => User::$pathAvatarPadrao,
            'password' => 'nds'
        ));

        UsuarioServico::AtualizaSenhaUsuario($usuario->id, "Mudar@1234!");

        $grupoAdmin = Grupo::create(Array(
            'nome' => "Administradores",
            'slug' => "administradores"
        ));

        $usuarioGrupo = UsuarioGrupo::create(Array(
            'grupo_id' => $grupoAdmin->id,
            'usuario_id' => $usuario->id
        ));

        ConfiguracoesSistema::create(Array(
            'quantidade_sessoes_permitidas' => 10,
            'usuario_sistema_id' => $usuario->id
        ));
    }
}
