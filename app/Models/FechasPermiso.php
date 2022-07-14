<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FechasPermiso extends Model
{
    public $table = "fechas_permiso";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'fecha',
        'id_permiso'
    ];
}
