<?php

namespace App\Classes\Input;
use App\Classes\Interfaces\Writer;

use App\Classes\Utils\Util;
use App\Models\ValoresIqOptionCandles;
use App\Models\Pairs;

use App\Jobs\BeginStrategyProcess;

class InputIqOption implements Writer
{
    public function process($dthr)
    {
        $pairs = Pairs::all();
        
        $arr_return = array();

        foreach($pairs as $pair) {
            $arr_return[$pair->pair] = $this->process_and_save($pair->idpairs, $pair->pair);

            if ($arr_return[$pair->pair] != '') {
                \Log::info("Dispatching job for: " . $pair->pair);
                $estrategiaJob = new BeginStrategyProcess('iq', $pair->idpairs, $dthr);
                dispatch($estrategiaJob);
            }
        }
            
        return $arr_return;
    }

    private function process_and_save($idpair, $pair)
    {
        $filename = "C:\sites\sistema_confluencia\import_iqoption\\" . $pair . ".txt";

        $return = '';
        
        if(file_exists($filename))
        {
            $candle_list_file = file_get_contents($filename);

            $values = array();
            
            
            $candle_list = explode("\n", $candle_list_file);

            unlink($filename);

            foreach($candle_list as $candle)
            {
                if(empty($candle))
                    break;
                $candle = str_replace("\r", "", $candle);
                //echo $vals . "<br>";
                $candle_prop = explode(",",$candle);

                $data_hora = date_create($candle_prop[1] . ' ' . $candle_prop[2]);
            
                //date_sub($data_hora, date_interval_create_from_date_string('3 hour'));

                $hr = date_format($data_hora, 'H:i');
                $dt = date_format($data_hora, 'Y-m-d');
                $dthr = date_format($data_hora, 'YmdHi');

                $values[] = [
                    'idpairs' => $candle_prop[0],
                    'data' => $dt,
                    'hora' => $hr,
                    'datahora' => $dthr,
                    'abertura' => $candle_prop[4],
                    'fechamento' => $candle_prop[5],
                    'maior_valor' => $candle_prop[7],
                    'menor_valor' => $candle_prop[6],
                    'resultado' => $candle_prop[8]
                ];
                
                $return = date_format($data_hora, 'd-m-Y H:i');
            }

            ValoresIqOptionCandles::insertOrIgnore($values);

        }
        return $return;
    }
}

?>