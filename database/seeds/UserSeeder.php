<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['username' => 'ahermosillac', 'nombre' => 'Alvaro Hermosilla', 'id_perfil' => 1]);
        User::create(['username' => 'jmorac', 'nombre' => 'Jeremias Mora', 'id_perfil' => 1]);
        User::create(['username' => 'lmarin', 'nombre' => 'Lissete Marin', 'id_perfil' => 1]);
    }
}
