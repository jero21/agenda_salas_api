<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriadoLegalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso', function (Blueprint $table) {
            $table->increments('id');

            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('color')->default('deep-purple');

            $table->unsignedInteger('id_fiscal')->nullable();
            $table->foreign('id_fiscal')->references('id')->on('fiscal');

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
        Schema::dropIfExists('permiso');
    }
}
