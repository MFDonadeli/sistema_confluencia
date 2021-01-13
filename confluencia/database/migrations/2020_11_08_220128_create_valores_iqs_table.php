<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresIqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_iqs', function (Blueprint $table) {
            $table->increments('id_valores_iq');
            $table->integer('idpairs');
            $table->string('data');
            $table->string('hora');
            $table->string('datahora');
            $table->float('abertura');
            $table->float('fechamento');
            $table->float('maior_valor');
            $table->float('menor_valor');
            $table->string('caracteristica');
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
        Schema::dropIfExists('valores_iqs');
    }
}