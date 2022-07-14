<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelRegistroFiscal extends Model
{
    public $table = "excel_registro_fiscal";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'fiscal',
        'id_excel_registro_por_fecha'
    ];

}
