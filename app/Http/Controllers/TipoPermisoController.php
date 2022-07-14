<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPermiso;
use DB;

class TipoPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoPermiso::all();
    }
}
