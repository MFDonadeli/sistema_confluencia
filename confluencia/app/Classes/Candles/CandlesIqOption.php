<?php

namespace App\Classes\Candles;
use App\Classes\Interfaces\CandlesSource;

use App\Models\ValoresIqOptionCandles;

class CandlesIqOption implements CandlesSource
{
    public function getByTime($time, $moeda){
        return ValoresIqOptionCandles::latest('datahora')
            ->where('idpairs',$moeda)
            ->orderByDesc('datahora')
            ->limit($time)
            ->get();
    }

    public function getByAmount($amount, $moeda, $moment = "", $dthr = "")
    {
        $dthr_comparison = ($moment == "before" ? "<" : ">");

        $query = ValoresIqOptionCandles::latest('datahora')
            ->where('idpairs',$moeda);
            
        if (!empty($dthr)){
            $query->where('datahora', $dthr_comparison, $dthr);
        }
        
        $query->orderByDesc('datahora')
            ->limit($amount);

        $queryGet = $query->get();

        if ($queryGet->count() != $amount) {
            return null;
        }
        
        /*if ($queryGet[0]->datahora - $queryGet[$amount-1]->datahora != $amount-1) {
            return null;
        }*/

        return $queryGet;
        
    }
}

?>