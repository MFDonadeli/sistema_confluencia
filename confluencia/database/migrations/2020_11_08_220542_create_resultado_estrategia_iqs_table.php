<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoEstrategiaIqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_estrategia_iqs', function (Blueprint $table) {
            $table->increments('id_resultado_estrategias_iq');
            $table->integer('idpairs');
            $table->string('data');
            $table->string('hora');
            $table->string('datahora');
            $table->string('estrategia');
            $table->string('resultado_estrategia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado_estrategia_iqs');
    }
}
