<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Fiscal;
use App\Models\User;
use DB;

class FiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fiscal::all();
    }

    public function show($id)
    {
        return Fiscal::find($id);

    }

    public function fiscalesActivos()
    {
        return Fiscal::where('activo', 1)->get();
    }

    public function fiscalesByDate($date)
    {

        $quitar_fiscales =  Fiscal::join('registro', 'fiscal.id', '=', 'registro.id_fiscal')
            ->leftJoin('permiso', 'fiscal.id', '=', 'permiso.id_fiscal')
            ->leftJoin('fechas_permiso', 'permiso.id', '=', 'fechas_permiso.id_permiso')
            ->where('fiscal.activo', 1)
            ->where('registro.start', '=', $date)
            ->orWhere('fechas_permiso.fecha', '=', $date)
            ->select('fiscal.id', 'fiscal.nombre')
            ->get();

        $fiscales = Fiscal::where('activo', 1)->get();
        foreach ($fiscales as $key1 => $fiscal) {
            foreach($quitar_fiscales as $key2 => $quitar_fiscal) {
                if ($key1 === $key2) {
                    $position = $quitar_fiscal->id - 1;
                    unset($fiscales[$position]);
                }
            }
        }
        return array_values($fiscales->toArray());
    }

    public function store(Request $request) {
        try {
            $fiscal = new Fiscal();
            $fiscal->nombre        = $request->nombre;
            $fiscal->username      = $request->username;
            $fiscal->save();

            return \Response::json(['create' => true, 'fiscal' => $fiscal], 200);
        } catch (Exception $e) {
            return \Response::json(['create' => false, 'error' => $e], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $registro = Fiscal::find($id);
            $registro->delete();

            return \Response::json(['delete' => true], 200);
        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $registro = Fiscal::find($id);
            $registro->nombre   = $request->nombre;
            $registro->username = $request->username;
            $registro->activo   = $request->activo;
            $registro->save();

            return \Response::json(['delete' => true], 200);
        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }

    public function cargasTrabajoPorFiscal() {

        try {

            $query = DB::table('fiscal')
                ->select(array('fiscal.*', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('registro', 'fiscal.id', '=', 'registro.id_fiscal')
                ->groupBy('registro.id_fiscal')
                ->orderBy('registros', 'desc')
                ->get();

            return $query;

        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }

    public function cargasTrabajoPorTipo() {

        try {

            $jo = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 1)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $audiencia = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 2)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $control = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 3)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $jo         = ['jo' => $jo];
            $audiencia  = ['audiencia' => $audiencia];
            $control    = ['control' => $control];

            $resultado = array_merge($jo, $audiencia, $control);
            return $resultado;

        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }

    public function cargaTrabajoFiscal($id) {
        try {

            $jo = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 1)
                ->where('fiscal.id', $id)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $audiencia = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 2)
                ->where('fiscal.id', $id)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $control = DB::table('registro')
                ->select(array('fiscal.nombre as fiscal', 'tipo_registro.nombre as tipo', DB::raw('COUNT(registro.id_fiscal) as registros')))
                ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
                ->join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
                ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
                ->where('tipo_sala.id_tipo_registro', 3)
                ->where('fiscal.id', $id)
                ->groupBy('registro.id_fiscal', 'fiscal.nombre', 'tipo_registro.nombre')
                ->orderBy('registros', 'desc')
                ->get();

            $jo         = ['jo' => $jo];
            $audiencia  = ['audiencia' => $audiencia];
            $control    = ['control' => $control];

            $resultado = array_merge($jo, $audiencia, $control);
            return $resultado;

        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }
    }
}
