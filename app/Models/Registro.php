<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    public $table = "registro";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'start',
        'end',
        'detail',
        'name',
        'id_tipo_sala',
        'id_fiscal',
    ];

    public function fiscal() {
        return $this->belongsTo(Fiscal::class, 'id_fiscal');
    }
    public function tipoSala() {
        return $this->belongsTo(TipoSala::class, 'id_tipo_sala');
    }
}
