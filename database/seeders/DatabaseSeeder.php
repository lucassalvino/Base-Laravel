<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if(!User::query()->first())
            $this->call(UsersSeeder::class);
        $this->call(MenusSeeders::class);
    }
}