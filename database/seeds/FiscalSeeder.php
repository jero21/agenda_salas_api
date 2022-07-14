<?php

use Illuminate\Database\Seeder;
use App\Models\Fiscal;

class FiscalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Fiscal::create(['nombre' => 'Nadia Leyla Gemita Salas Velasquez', 'username' => 'nsalas']);
        Fiscal::create(['nombre' => 'Stephanie Carreño', 'username' => 'scarreno']);
        Fiscal::create(['nombre' => 'Carlos Jorquera Berrios', 'username' => 'cjorquerab']);
        Fiscal::create(['nombre' => 'Claudia Ximena Perez Negron', 'username' => 'cperezn']);
        Fiscal::create(['nombre' => 'Jorge Ignacio Mandiola de la Fuente', 'username' => 'jmandiola']);
        Fiscal::create(['nombre' => 'Angélica Paola Mera Balmaceda', 'username' => 'amera']);
        Fiscal::create(['nombre' => 'Juan Carlos Rojo Venegas', 'username' => 'jrojo']);
        Fiscal::create(['nombre' => 'Vania Elizabeth Arancibia Rodriguez', 'username' => 'varancibia']);
        Fiscal::create(['nombre' => 'Luis Torres Gutierrez', 'username' => 'ltorres']);
        Fiscal::create(['nombre' => 'Alberto Enrique Chiffelle Marquez', 'username' => 'achiffelle']);
        Fiscal::create(['nombre' => 'Claudia Leyton Cornejos', 'username' => 'cleyton']);
        Fiscal::create(['nombre' => 'Daniela Ellenberg Campos', 'username' => 'dellenberg']);
        Fiscal::create(['nombre' => 'Juan Pablo Salas Castro', 'username' => 'jpsalas']);
        Fiscal::create(['nombre' => 'Ricardo Gutierrez Riveros', 'username' => 'rgutierrez']);
        Fiscal::create(['nombre' => 'Italo Ortega Silva', 'username' => 'iortega']);
        Fiscal::create(['nombre' => 'Juan Pablo Gerli Garcia', 'username' => 'jgerli']);
        Fiscal::create(['nombre' => 'Claudia Turra Lagos', 'username' => 'cturra']);
        Fiscal::create(['nombre' => 'Loreto Figueroa Gruner', 'username' => 'lfigueroa']);
        Fiscal::create(['nombre' => 'Marta Belmar Quijada', 'username' => 'mbelmarq']);
        Fiscal::create(['nombre' => 'Adelina Barriga Araneda', 'username' => 'abarriga']);
        Fiscal::create(['nombre' => 'Guido Vera Hernandez', 'username' => 'gvera']);
        Fiscal::create(['nombre' => 'Luis Arroyo Palma', 'username' => 'larroyo']);
        Fiscal::create(['nombre' => 'Monica Cerda Vargas', 'username' => 'mcerdav']);
    }
}
