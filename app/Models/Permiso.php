<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    public $table = "permiso";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'fecha_inicio',
        'fecha_fin',
        'color',
        'id_fiscal',
        'id_tipo_permiso',
    ];
}
