<?php

namespace App\Classes\Input;
use App\Classes\Interfaces\Writer;

use App\Classes\Utils\Util;
use App\Models\Valores;
use App\Models\Log;
use App\Models\Pairs;

class InputMT4 implements Writer
{
    public function process($dthr)
    {
        $pairs = Pairs::all();
        
        $arr_return = array();

        foreach($pairs as $pair){
            $arr_return[$pair->pair] = $this->process_and_save($pair->idpairs, $pair->pair);
        }
            
        return $arr_return;
    }

    private function process_and_save($idpair, $pair)
    {
        $filename = Util::MT4_PATH . "_" . $pair . "_M1.txt";
        $return = '';

        if(file_exists($filename))
        {           
            $candle_list_file = file_get_contents($filename);

            $values = array();
            
            $candle_list = explode("\n", $candle_list_file);
            foreach($candle_list as $candle)
            {
                if(empty($candle))
                    break;
                $candle = str_replace("\r", "", $candle);
                //echo $vals . "<br>";
                $candle_prop = explode(",",$candle);

                //print_r($va);
                $date = str_replace(".", "-", $candle_prop[0]);
                $data_hora = date_create($date . ' ' . $candle_prop[1]);


                date_sub($data_hora, date_interval_create_from_date_string('5 hour'));

                $hr = date_format($data_hora, 'H:i');
                $dt = date_format($data_hora, 'Y-m-d');
                $dthr = date_format($data_hora, 'YmdHi');
                //$j = $i + 1;
                
                $values[] = [
                    'idpairs' => $idpair,
                    'data' => $dt,
                    'hora' => $hr,
                    'datahora' => $dthr,
                    'abertura' => $candle_prop[5],
                    'fechamento' => $candle_prop[4],
                    'maior_valor' => $candle_prop[2],
                    'menor_valor' => $candle_prop[3],
                    'resultado' => $candle_prop[7]
                ];
                
                $return = date_format($data_hora, 'd-m-Y H:i');
            }

            Valores::insertOrIgnore($values);
                
            $last_minute_inserted = Valores::select(
                Valores::raw("min(timestampdiff(MINUTE,STR_TO_DATE(datahora,'%Y%m%d%H%i'),now())) as diff"))
                    ->where('idpairs', $idpair)
                    ->get()[0];

            if($last_minute_inserted->diff > 10){
                Log::updateOrInsert(['pair' => $pair], 
                    ['pair' => $pair,
                    'open' => 'Closed']);
            }
            else{
                Log::updateOrInsert(['pair' => $pair], 
                    ['pair' => $pair,
                    'open' => 'Open']);
            }

        }

        return $return;
    }
}

?>