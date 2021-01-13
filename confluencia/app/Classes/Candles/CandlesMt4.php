<?php

namespace  App\Classes\Candles;

use App\Classes\Interfaces\CandlesSource;

use App\Models\Valores;

class CandlesMT4 implements CandlesSource
{
    public function getByTime($time, $moeda){
        return Valores::latest('datahora')
            ->where('idpairs',$moeda)
            ->orderByDesc('datahora')
            ->limit($time)
            ->get();
    }

    public function getByAmount($amount, $moeda, $moment = "", $dthr = "")
    {
        $dthr_comparison = ($moment == "before" ? "<" : ">");

        $query = Valores::latest('datahora')
            ->where('idpairs',$moeda);
            
        if(!empty($dthr)){
            $query->where('datahora', $dthr_comparison, $dthr);
        }
        
        $query->orderByDesc('datahora')
            ->limit($amount);

        return $query->get();
    }
}

?>