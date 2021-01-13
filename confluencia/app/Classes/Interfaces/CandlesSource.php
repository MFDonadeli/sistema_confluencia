<?php

namespace App\Classes\Interfaces;

interface CandlesSource
{
    public function getByTime($time, $moeda);

    public function getByAmount($amount, $moeda, $moment = "", $dthr = "");
}

?>