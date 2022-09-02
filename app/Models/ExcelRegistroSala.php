<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelRegistroSala extends Model
{
    public $table = "excel_registro_sala";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
        'sala',
        'fiscal',
        'id_excel_registro_por_fecha',
        'id_registro'
    ];

}
