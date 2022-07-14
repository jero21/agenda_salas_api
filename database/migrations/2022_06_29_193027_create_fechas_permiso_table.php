<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_permiso', function (Blueprint $table) {
            $table->increments('id');

            $table->date('fecha');
            $table->unsignedInteger('id_permiso')->nullable();
            $table->foreign('id_permiso')->references('id')->on('permiso');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechas_permiso');
    }
}
