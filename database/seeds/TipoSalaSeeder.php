<?php

use Illuminate\Database\Seeder;
use App\Models\TipoSala;

class TipoSalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoSala::create(['nombre' => 'JuicioOral-01', 'color' => '#1976D2', 'id_tipo_registro' => 1]);
        TipoSala::create(['nombre' => 'JuicioOral-02', 'color' => '#1976D2', 'id_tipo_registro' => 1]);
        TipoSala::create(['nombre' => 'JuicioOral-03', 'color' => '#1976D2', 'id_tipo_registro' => 1]);
        TipoSala::create(['nombre' => 'Audiencia-02', 'color' => '#009688', 'id_tipo_registro' => 2]);
        TipoSala::create(['nombre' => 'Audiencia-03', 'color' => '#009688', 'id_tipo_registro' => 2]);
        TipoSala::create(['nombre' => 'Audiencia-04', 'color' => '#009688', 'id_tipo_registro' => 2]);
        TipoSala::create(['nombre' => 'Audiencia-05', 'color' => '#009688', 'id_tipo_registro' => 2]);
        TipoSala::create(['nombre' => 'Audiencia-Especial', 'color' => '#009688', 'id_tipo_registro' => 2]);
        TipoSala::create(['nombre' => 'Control', 'color' => '#FF9800', 'id_tipo_registro' => 3]);
    }
}
