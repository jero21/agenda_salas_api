<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSala;
use DB;

class TipoSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoSala::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  date  $date
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $quitar_salas =  TipoSala::join('registro', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
            ->where('registro.start', '=', $date)
            ->select('tipo_sala.id')
            ->orderBy('nombre')
            ->get();

        $salas = TipoSala::all();
        foreach ($salas as $key1 => $sala) {
            foreach($quitar_salas as $key2 => $quitar_sala) {
                if ($key1 === $key2) {
                    $position = $quitar_sala->id - 1;
                    unset($salas[$position]);
                }
            }
        }
        return array_values($salas->toArray());
    }
}
