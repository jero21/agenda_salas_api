<?php

namespace App\Http\Controllers;

use App\Utils\Registro\TransformRegistro;
use App\Models\ExcelRegistroPorFecha;
use App\Models\ExcelRegistroFiscal;
use App\Models\ExcelRegistroSala;
use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Fiscal;
use App\Models\TipoSala;
use Carbon\Carbon;
use DB;

class RegistroController extends Controller
{

    protected $registroTransform;

    public function __construct(TransformRegistro $registroTransform) 
    {
        $this->registroTransform = $registroTransform;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Registro::join('tipo_sala', 'registro.id_tipo_sala', '=', 'tipo_sala.id')
            ->join('tipo_registro', 'tipo_sala.id_tipo_registro', '=', 'tipo_registro.id')
            ->join('fiscal', 'registro.id_fiscal', '=', 'fiscal.id')
            ->select('registro.id', 'registro.start', 'registro.detail', 'tipo_sala.color', 'fiscal.nombre as name', 'tipo_sala.nombre as sala')
            ->get();

        return $this->registroTransform->transformCollection($registros->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $registro = new Registro();
            $registro->start        = $request->start;
            $registro->end          = $request->start;
            $registro->detail       = $request->detail;
            $registro->id_tipo_sala = $request['sala']['id'];
            $registro->id_fiscal    = $request['fiscal']['id'];
            $registro->save();

            $sala = TipoSala::find($request['sala']['id']);
            $fiscal = Fiscal::find($request['fiscal']['id']);

            $registro_fecha_excel = ExcelRegistroPorFecha::where('fecha', '=' ,$request->start)->first();
            if ($registro_fecha_excel) {

                $registro_sala = new ExcelRegistroSala();
                $registro_sala->sala         = $sala->nombre;
                $registro_sala->fiscal       = $fiscal->nombre;
                $registro_sala->id_excel_registro_por_fecha = $registro_fecha_excel->id;
                $registro_sala->id_registro    = $registro->id;
                $registro_sala->save();

            } else {
                $registro_fecha = new ExcelRegistroPorFecha();
                $registro_fecha->fecha          = $request->start;
                $registro_fecha->save();

                $registro_sala = new ExcelRegistroSala();
                $registro_sala->sala         = $sala->nombre;
                $registro_sala->fiscal       = $fiscal->nombre;
                $registro_sala->id_excel_registro_por_fecha = $registro_fecha->id;
                $registro_sala->id_registro    = $registro->id;
                $registro_sala->save();
            }
            
            if ($request->email) {
                $this->enviarEmail($sala->nombre, $fiscal->username, $request->start);
            }
            return \Response::json(['create' => true, 'registro' => $registro], 200);
        } catch (Exception $e) {
            return \Response::json(['create' => false, 'error' => $e], 500);
        }
    }


    public function update($id, Request $request)
    {
        try {
            $registro = Registro::find($request->id);
            $registro->detail       = $request->detail;

            if (is_array($request->sala)) {
                $registro->id_tipo_sala = $request['sala']['id'];
                $sala_nombre = TipoSala::find($request['sala']['id']);
                $sala = $sala_nombre->nombre;
            } else {
                $sala_id = TipoSala::where('nombre', $request->sala)->first();
                $registro->id_tipo_sala = $sala_id->id;
                $sala = $request->sala;
            }

            if (is_array($request->fiscal)) {
                $registro->id_fiscal = $request['fiscal']['id'];
                $fiscal_nombre = Fiscal::find($request['fiscal']['id']);
                $fiscal = $fiscal_nombre->nombre;
            } else {
                $fiscal_id = Fiscal::where('nombre', $request->fiscal)->first();
                $registro->id_fiscal = $fiscal_id->id;
                $fiscal = $request->fiscal;
            }

            $registro->save();

            $registro_sala = ExcelRegistroSala::where('id_registro', '=' , $registro->id)->first();
            if ($registro_sala) {
                $registro_sala->sala         = $sala;
                $registro_sala->fiscal       = $fiscal;
                $registro_sala->save();

            } 
            if ($request->email) {
                $this->enviarEmail($sala->nombre, $fiscal->username, $request->start);
            }
            return \Response::json(['create' => true, 'registro' => $registro], 200);
        } catch (Exception $e) {
            return \Response::json(['create' => false, 'error' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $registroExcel = ExcelRegistroSala::where('id_registro', $id)->delete();

            $registro = Registro::find($id);
            $registro->delete();

            return \Response::json(['delete' => true], 200);
        } catch (Exception $e) {
            return \Response::json(['delete' => false, 'error' => $e], 500);
        }        
    }

    public function enviarEmail($sala, $fiscal, $fecha) {

        $date = Carbon::parse($fecha)->format('d-m-Y');

        $from = "noreply@minpublico.cl";
        $to = $fiscal."@minpublico.cl";
        $subject = "AGENDA TEMUCO";
        $message = "Se informa que le fue asignaa la sala <b>" . $sala . "</b> para el <b>" . $date . "</b>";
        $headers = "Content-Type: text/html; charset=UTF-8";

        mail($to,$subject,$message, $headers);
    }
}
