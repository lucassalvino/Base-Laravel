<?php

namespace Database\Seeders;

use App\Models\ConfiguracoesSistema;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!User::query()->first())
            $this->call(UsersSeeder::class);
    }
}