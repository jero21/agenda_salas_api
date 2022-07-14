<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\FechasPermiso;
use Carbon\Carbon;
use DB;
class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Permiso::join('fiscal', 'permiso.id_fiscal', '=', 'fiscal.id')
            ->join('tipo_permiso', 'permiso.id_tipo_permiso', '=', 'tipo_permiso.id')
            ->select('permiso.id', 'fiscal.nombre as fiscal', 'tipo_permiso.nombre as tipo_permiso', 'permiso.fecha_inicio', 'permiso.fecha_fin')
            ->get();
    }

    public function store(Request $request) {
        try {

            $permiso = new Permiso();
            $permiso->fecha_inicio       = $request->fecha_inicio;
            $permiso->fecha_fin          = $request->fecha_fin;
            $permiso->id_tipo_permiso    = $request->tipo_permiso;
            $permiso->id_fiscal          = $request->fiscal;
            $permiso->save();

            // Calcúla la diferencia de dias entre fecha_inicio y fecha_fin
            $fecha_i = Carbon::parse($request->fecha_inicio);
            $fecha_f = Carbon::parse($request->fecha_fin);

            $dt = Carbon::create($fecha_i->year, $fecha_i->month, $fecha_i->day);
            $daysForExtraCoding = $fecha_f->diffInDaysFiltered(function(Carbon $date) {
               return $date->diffInDays();
            }, $dt);

            // Genera registros por día
            $i = 0;
            while ($i <= $daysForExtraCoding) {
                $fechas_permiso = new FechasPermiso();
                $fechas_permiso->fecha = Carbon::parse($request->fecha_inicio)->addDay($i);
                $fechas_permiso->id_permiso = $permiso->id;
                $fechas_permiso->save();
                $i++;
            }
            


            return \Response::json(['create' => true, 'permiso' => $permiso], 200);
        } catch (Exception $e) {
            return \Response::json(['create' => false, 'error' => $e], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $permiso = Permiso::find($id);
            $permiso->delete();

            return \Response::json(['delete' => true], 200);
        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }

    public function permisoFiscalAgenda() {

        return Permiso::join('fiscal', 'permiso.id_fiscal', '=', 'fiscal.id')
            ->join('tipo_permiso', 'permiso.id_tipo_permiso', '=', 'tipo_permiso.id')
            ->select('permiso.fecha_inicio as start', 'tipo_permiso.nombre as detail', 'permiso.color', 'fiscal.nombre as name', 'permiso.fecha_fin as end')
            ->get();

    }
}
