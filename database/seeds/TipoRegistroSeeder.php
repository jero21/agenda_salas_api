<?php

use Illuminate\Database\Seeder;
use App\Models\TipoRegistro;

class TipoRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoRegistro::create(['nombre' => 'Juicio Oral']);
        TipoRegistro::create(['nombre' => 'Auciencia']);
        TipoRegistro::create(['nombre' => 'Control']);
    }
}
