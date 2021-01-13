<?php

namespace App\Classes\Estrategias;
use App\Classes\Interfaces\ResultadoSourceInterface;

use App\Models\Estrategias;

use App\Classes\Utils\Util;

class ResultadoMt4 implements ResultadoSourceInterface
{
    public function getByTime($time,$moeda)
    {
        $return_array = array();

        //$dthr = Util::getSubTime($time, "hour");

        $dthr = '202011101735';

        $estrategias = Estrategias::all();

        foreach($estrategias as $estrategia)
        {
            $return_array[$estrategia->alias]['name'] = $estrategia->estrategia;

            $return_array[$estrategia->alias]['resultado'] = ResultadoEstrategiaMt4::latest('datahora')
                                                                ->where('idpairs',$moeda)
                                                                ->where('estrategia',$estrategia->alias)
                                                                ->where('datahora', '>', $dthr)
                                                                ->orderByDesc('datahora')
                                                                ->get();            
        }

        return $return_array;
    }
}

?>