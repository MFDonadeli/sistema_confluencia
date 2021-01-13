<?php

namespace App\Classes\Estrategias;

use App\Classes\Estrategias\PrepareStrategyProcess;
use App\Classes\Estrategias\StrategyRun;
use App\Classes\Utils\Util;
use App\Models\Estrategias;

class StrategyProcess
{
    private $moeda;
    private $source;

    public function __construct($moeda, $source)
    {
        $this->moeda = $moeda;
        $this->source = $source;
    }

    public function run($dthr)
    {
        $estrategias = Estrategias::all();

        foreach ($estrategias as $est) {
            $curr_estrategy = new StrategyDefinition($est->alias, $this->moeda, $dthr, $this->source);

            $prepare = new PrepareStrategyProcess();
            $arr_candles = $prepare->makePreparation($curr_estrategy);

            foreach ($arr_candles as $action => $candles_list) {
                if ($candles_list) {
                    (new StrategyRun($curr_estrategy))->run($candles_list, $dthr, $action);
                }
            }
        }
    }
}