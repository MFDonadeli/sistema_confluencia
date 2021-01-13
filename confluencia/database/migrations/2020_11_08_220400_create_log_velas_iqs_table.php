<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogVelasIqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_velas_iqs', function (Blueprint $table) {
            $table->increments('id_logvelas_iq');
            $table->integer('idpairs');
            $table->string('datahora');
            $table->string('estrategia');
            $table->string('mensagem');
            $table->string('resultado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_velas_iqs');
    }
}
