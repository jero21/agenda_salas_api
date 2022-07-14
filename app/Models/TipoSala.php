<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSala extends Model
{
    public $table = "tipo_sala";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'nombre',
        'color',
        'id_tipo_registro',
    ];

    public function registros(){
        return $this->hasMany(Registro::class, 'id_tipo_sala');
    }
}
