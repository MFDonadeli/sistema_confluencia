<?php

namespace App\Classes\Estrategias;

use App\Models\EstrategiasDefinitions;

class StrategyDefinition
{
    private $strategy_name;
    private $dthr;
    private $moeda;
    private $source;
    private $strategy_definition;

    public function __construct($strategy_name, $moeda, $dthr, $source)
    {
        $this->strategy_name = $strategy_name;
        $this->dthr = $dthr;
        $this->moeda = $moeda;
        $this->source = $source;

        $this->fillStrategyDefinition();
    }

    private function fillStrategyDefinition()
    {
        $this->strategy_definition = EstrategiasDefinitions::where('estrategia', $this->strategy_name)->first();
    }

    public function getStrategyName() 
    {
        return $this->strategy_name;
    }

    public function getMoeda() 
    {
        return $this->moeda;
    }

    public function getDtHr() 
    {
        return $this->dthr;
    }

    public function getSource() 
    {
        return $this->source;
    }

    public function getAcao(int $candle)
    {
        $field = 'action_candle_'.$candle;
        return $this->strategy_definition->$field;
    }

    /**
     * For an specific action, return the amount of candles that will be used to do the analysis
     */
    public function forThisActionHowManyCandles($action)
    {
        $field = 'howmany_candles_for_'.$action;
        return $this->strategy_definition->$field;
    }

    public function getAnalysis()
    {
        return $this->strategy_definition->analysis;
    }

    /**
     * Return the list of candles or the candle that will be used to check if the result of the strategy step
     * 
     * $passo: Which is the step to taken the correct set of candles
     */
    public function getCandlesToBeAnalyzed($passo)
    {
        $field = 'candles_for_'.$passo;
        $candleList = $this->strategy_definition->$field;

        return is_numeric($candleList) ? 
            $candleList : 
            explode(",", $candleList);
    }

    public function isContrario()
    {
        return ($this->strategy_definition->against_analysis == 'true') ? true : false;
    }

    public function __get($prop)
    {
        return $this->strategy_definition->$prop;
    }
}