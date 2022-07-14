<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRegistro extends Model
{
    public $table = "tipo_registro";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'nombre',
    ];
}
