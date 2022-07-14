<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcelRegistroFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_registro_fiscal', function (Blueprint $table) {
            $table->increments('id');

            $table->string('fiscal');

            $table->unsignedInteger('id_excel_registro_por_fecha')->nullable();
            $table->foreign('id_excel_registro_por_fecha')->references('id')->on('excel_registro_por_fecha');

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
        Schema::dropIfExists('excel_registro_fiscal');
    }
}
