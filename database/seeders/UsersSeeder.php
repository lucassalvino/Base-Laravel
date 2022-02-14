<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\EnvConfig;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
    public function run()
    {
        User::create(Array(
            'username' => 'kame',
            'name' => "kame",
            'email' => "lucassalvino1@gmail.com",
            'path_avatar' => User::$pathAvatarPadrao,
            'password' => hash(EnvConfig::HashSenha(), 'Mudar@1234!')
        ));
    }
}