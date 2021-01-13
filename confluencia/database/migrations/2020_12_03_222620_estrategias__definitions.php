<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstrategiasDefinitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estrategias_definitions', function (Blueprint $table) {
            $table->increments('id_estrategias_definitions');
            $table->string('estrategia');
            $table->string('action_candle_0');
            $table->string('action_candle_1');
            $table->string('action_candle_2');
            $table->string('action_candle_3');
            $table->string('action_candle_4');
            $table->string('howmany_candles_for_entering_message');
            $table->string('candles_for_entering_message');
            
            $table->string('candles_for_entering');
            $table->string('howmany_candles_for_entering');
            $table->string('howmany_candles_for_entering_analysis');
            $table->string('candle_entering_result');
            
            $table->string('howmany_candles_for_gale1_message');
            $table->string('candles_for_gale1_message');
            
            $table->string('candles_for_gale1');
            $table->string('howmany_candles_for_gale1');
            $table->string('howmany_candles_for_gale1_analysis');
            $table->string('candle_gale1_result');
            
            $table->string('howmany_candles_for_gale2_message');
            $table->string('candles_for_gale2_message');
            
            $table->string('candles_for_gale2');
            $table->string('howmany_candles_for_gale2');
            $table->string('candles_for_gale2_analysis');
            
            $table->string('howmany_candles_for_gale2_analysis');
            $table->string('candle_gale2_result');

           
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
