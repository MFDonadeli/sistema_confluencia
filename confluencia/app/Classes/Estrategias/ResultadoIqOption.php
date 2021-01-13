<?php

namespace App\Classes\Estrategias;
use App\Classes\Interfaces\ResultadoSourceInterface;

use App\Models\ResultadoEstrategiaIqOption;
use App\Models\Estrategias;

use App\Classes\Utils\Util;

class ResultadoIqOption implements ResultadoSourceInterface
{
    public function getByTime($time,$moeda)
    {
        $return_array = array();

        $dthr = Util::getSubTime($time, "hour");
        //$dthr = '202101080900';

        $estrategias = Estrategias::all();

        foreach($estrategias as $estrategia)
        {
            $return_array[$estrategia->alias]['name'] = $estrategia->estrategia;

            $return_array[$estrategia->alias]['resultado'] = ResultadoEstrategiaIqOption::latest('datahora')
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