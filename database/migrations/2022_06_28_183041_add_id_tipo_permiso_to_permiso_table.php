<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdTipoPermisoToPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permiso', function (Blueprint $table) {
            $table->unsignedInteger('id_tipo_permiso')->nullable();
            $table->foreign('id_tipo_permiso')->references('id')->on('tipo_permiso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
