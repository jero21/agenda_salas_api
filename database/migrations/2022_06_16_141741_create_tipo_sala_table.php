<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoSalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_sala', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('color');

            $table->unsignedInteger('id_tipo_registro')->nullable();
            $table->foreign('id_tipo_registro')->references('id')->on('tipo_registro');

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
        Schema::dropIfExists('tipo_sala');
    }
}
