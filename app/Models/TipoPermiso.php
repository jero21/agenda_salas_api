<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    public $table = "tipo_permiso";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'nombre',
    ];
}
