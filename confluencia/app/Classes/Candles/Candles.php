<?php

namespace App\Classes\Candles;

class Candles {
    private $time;
    private $amount;
    private $candlesSource;

    public function __construct($candlesSource)
    {
        $this->candlesSource = $candlesSource;
    }

    public function getByTime($time, $moeda)
    {
        return $this->candlesSource->getByTime($time, $moeda);
    }

    public function getByAmount($amount, $moeda, $moment = "", $dthr = "")
    {
        return $this->candlesSource->getByAmount($amount, $moeda, $moment, $dthr);
    }
}

?>