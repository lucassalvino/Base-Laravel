<?php

namespace Database\Seeders;

use App\Models\ConfiguracoesSistema;
use App\Models\Grupo;
use App\Models\Relacionamentos\UsuarioGrupo;
use App\Models\User;
use App\Utils\EnvConfig;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
    public function run()
    {
        $usuario = User::create(Array(
            'username' => 'kame',
            'name' => "kame",
            'email' => "lucassalvino1@gmail.com",
            'path_avatar' => User::$pathAvatarPadrao,
            'password' => hash(EnvConfig::HashSenha(), 'Mudar@1234!')
        ));

        $grupoAdmin = Grupo::create(Array(
            'nome' => "Administradores",
            'slug' => "administradores"
        ));

        $grupoRoot = Grupo::create(Array(
            'nome' => "Root",
            'slug' => "root"
        ));

        $grupoProdutor = Grupo::create(Array(
            'nome' => "Produtor",
            'slug' => "produtor"
        ));

        $usuarioGrupo = UsuarioGrupo::create(Array(
            'grupo_id' => $grupoAdmin->id,
            'usuario_id' => $usuario->id
        ));

        $usuarioGrupo = UsuarioGrupo::create(Array(
            'grupo_id' => $grupoRoot->id,
            'usuario_id' => $usuario->id
        ));

        ConfiguracoesSistema::create(Array(
            'quantidade_sessoes_permitidas' => 10,
            'usuario_sistema_id' => $usuario->id
        ));
    }
}
