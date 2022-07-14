<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\ExcelRegistroPorFecha;
use Carbon\Carbon;
use Excel;

class DescargaDatosController extends Controller
{
    public function descarga($desde, $hasta) {

        $datos = ExcelRegistroPorFecha::with('salas')->orderBy('fecha', 'asc')
            ->whereBetween('fecha', [$desde, $hasta])
            ->get();
            
        Excel::create('Agenda Temuco', function($excel) use ($datos) {
            // Set the title
            $excel->setTitle("Causas");

            // Call them separately
            $excel->setDescription('Agenda Temuco');
            
            $excel->sheet('Agenda', function($sheet) use($datos) {

                $sheet->cell('A1', function($cell) {$cell->setValue('DÍA');});
                $sheet->cell('B1', function($cell) {$cell->setValue('DÍA');});
                $sheet->cell('C1', function($cell) {$cell->setValue('MES');});
                $sheet->cell('D1', function($cell) {$cell->setValue('CONTROL DE DETENCIÓN');});
                $sheet->cell('E1', function($cell) {$cell->setValue('JO 1');});
                $sheet->cell('F1', function($cell) {$cell->setValue('JO 2');});
                $sheet->cell('G1', function($cell) {$cell->setValue('JO 3');});
                $sheet->cell('H1', function($cell) {$cell->setValue('AUDIENCIA 2');});
                $sheet->cell('I1', function($cell) {$cell->setValue('AUDIENCIA 3');});
                $sheet->cell('J1', function($cell) {$cell->setValue('AUDIENCIA 4');});
                $sheet->cell('K1', function($cell) {$cell->setValue('AUDIENCIA 5');});
                $sheet->cell('L1', function($cell) {$cell->setValue('SALA ESPECIAL');});

                if (!empty($datos)) {
                    foreach ($datos as $key => $value) {
                        $i= $key+2;
                        
                        $date = Carbon::parse($value['fecha']);
                        $meses = array(
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        );
                        $dias_semana = array(
                            "Lunes",
                            "Martes",
                            "Miercoles",
                            "Jueves",
                            "Viernes",
                            "Sabado",
                            "Domingo"
                        );
                        $fecha = Carbon::parse($value['fecha']);
                        $dia = $fecha->format('d');
                        $mes = $meses[($fecha->format('n')) - 1];
                        $dia_semana = $dias_semana[$fecha->dayOfWeek - 1];


                        $sheet->cell('A'.$i, $dia);
                        $sheet->cell('B'.$i, $dia_semana);
                        $sheet->cell('C'.$i, $mes);


                        foreach ($value['salas'] as $key => $sala) {


                            switch ($sala->sala) {
                                case "Control":
                                    $sheet->cell('D'.$i, $sala->fiscal); 
                                    break;
                                case "JuicioOral-01":
                                    $sheet->cell('E'.$i, $sala->fiscal); 
                                    break;
                                case "JuicioOral-02":
                                    $sheet->cell('F'.$i, $sala->fiscal); 
                                    break;
                                case "JuicioOral-03":
                                    $sheet->cell('G'.$i, $sala->fiscal); 
                                    break;
                                case "Audiencia-02":
                                    $sheet->cell('H'.$i, $sala->fiscal); 
                                    break;
                                case "Audiencia-03":
                                    $sheet->cell('I'.$i, $sala->fiscal); 
                                    break;
                                case "Audiencia-04":
                                    $sheet->cell('J'.$i, $sala->fiscal); 
                                    break;
                                case "Audiencia-05":
                                    $sheet->cell('K'.$i, $sala->fiscal); 
                                    break;
                                case "Audiencia-Especial":
                                    $sheet->cell('L'.$i, $sala->fiscal); 
                                    break;
                            }
                        }
                    } 
                }
            });

        })->export('xlsx');
    }
}
