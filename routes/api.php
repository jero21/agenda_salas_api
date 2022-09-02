<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'AuthenticateController@login');

// Descarga Excel
Route::get('descarga/{desde}/{hasta}', 'DescargaDatosController@descarga');

Route::middleware(['api'])->group(function () {
    Route::get('getUser', 'AuthenticateController@getAuthUser');

    Route::resource('registros', 'RegistroController');
    Route::resource('fiscales', 'FiscalController');
    Route::resource('salas', 'TipoSalaController');
    Route::resource('tipo_permiso', 'TipoPermisoController');
    Route::resource('permisos', 'PermisoController');

    Route::get('fiscales_by_date/{date}', 'FiscalController@fiscalesByDate');
    Route::get('fiscales_activos', 'FiscalController@fiscalesActivos');
    Route::get('permiso_fiscales_agenda', 'PermisoController@permisoFiscalAgenda');

    // CARGAS
    Route::get('cargas_trabajo_fiscal/{desde}/{hasta}', 'FiscalController@cargasTrabajoPorFiscal');
    Route::get('carga_trabajo_fiscal/{id}', 'FiscalController@cargaTrabajoFiscal');
    Route::get('cargas_trabajo_tipo/{desde}/{hasta}', 'FiscalController@cargasTrabajoPorTipo');

});
