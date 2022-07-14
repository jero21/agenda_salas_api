<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FiscalSeeder::class);
        $this->call(TipoRegistroSeeder::class);
        $this->call(TipoSalaSeeder::class);
        $this->call(TipoPermisoSeeder::class);
        
    }
}
