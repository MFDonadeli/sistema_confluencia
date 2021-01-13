<?php

namespace App\Classes\Estrategias;

use App\Classes\Utils\Util;
use App\Models\Estrategias;
use App\Classes\Candles\Candles;

class PrepareStrategyProcess
{
    public function makePreparation(StrategyDefinition $curr_strategy)
    {
        $candles_arr_return = array();

        $class = "App\Classes\Candles\Candles".config('app.candle_sources')[$curr_strategy->getSource()];

        $hr = substr($curr_strategy->getDtHr(), 8);

        $candle = $hr % 5;
        $action = $curr_strategy->getAcao($candle);

        $arr_action = explode(",", $action);
        $candle_amount = 0;

        foreach ($arr_action as $action) {
            $arr = array();

            $candle_amount = $curr_strategy->forThisActionHowManyCandles($action);

            $candles_arr_return[$action] = (new Candles(new $class()))->getByAmount(
                                                            $candle_amount, 
                                                            $curr_strategy->getMoeda(), 
                                                            "before", 
                                                            $curr_strategy->getDtHr());
        }

        return $candles_arr_return;
    }
}