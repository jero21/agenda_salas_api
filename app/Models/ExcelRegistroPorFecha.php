<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelRegistroPorFecha extends Model
{
    public $table = "excel_registro_por_fecha";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'fecha',
    ];

    public function salas() {
        return $this->hasMany(ExcelRegistroSala::class, 'id_excel_registro_por_fecha');
    }
}
