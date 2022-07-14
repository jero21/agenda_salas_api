<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiscal extends Model
{
    public $table = "fiscal";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillables = [
    	'id',
    	'nombre',
        'username',
        'activo'
    ];

    public function registros(){
        return $this->hasMany(Registro::class, 'id_fiscal');
    }
}
