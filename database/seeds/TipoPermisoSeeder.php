<?php

use Illuminate\Database\Seeder;
use App\Models\TipoPermiso;

class TipoPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPermiso::create(['nombre' => 'Licencia']);
        TipoPermiso::create(['nombre' => 'Feriado Legal']);
        TipoPermiso::create(['nombre' => 'Administrativo']);
        TipoPermiso::create(['nombre' => 'Capacitacion']);
    }
}
