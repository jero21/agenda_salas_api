<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start');
            $table->date('end');
            $table->text('detail')->nullable();
            $table->text('name')->nullable();


            $table->unsignedInteger('id_tipo_sala')->nullable();
            $table->foreign('id_tipo_sala')->references('id')->on('tipo_sala');

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
        Schema::dropIfExists('registro');
    }
}
