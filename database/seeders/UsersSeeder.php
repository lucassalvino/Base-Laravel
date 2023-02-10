<?php

namespace Database\Seeders;

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

        $grupoAdmin = Grupo::create(Array(
            'nome' => "Root",
            'slug' => "root"
        ));

        $usuarioGrupo = UsuarioGrupo::create(Array(
            'grupo_id' => $grupoAdmin->id,
            'usuario_id' => $usuario->id
        ));
    }
}
