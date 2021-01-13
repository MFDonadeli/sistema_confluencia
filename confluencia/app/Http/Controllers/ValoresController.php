<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\PairsClass;
use App\Classes\Candles\Candles;
use App\Classes\Estrategias\ResultadoEstrategia;
use App\Classes\Input\CandlesInput;

use App\Models\Estrategias;
use App\Jobs\BeginStrategyProcess;

use \App\Classes\Estrategias\StrategyProcess;

class ValoresController extends Controller
{
    /**
     * Function of main index which shows all pairs, candles and strategies results
     */
    public function index()
    {
        $pairs = (new PairsClass())->getList(PairsClass::$LIST_ONLY);

        $estrategias = Estrategias::all();

        //return view('index', $pairs);

        return view('index', [
            'pairs' => $pairs,
            'estrategias' => $estrategias
        ]);
    }

    /**
     * Get candles from a pair
     * $source: Source of candles
     * $moeda: pair
     */
    public function candles_data($source, $moeda)
    {
        $class = "App\Classes\Candles\Candles".config('app.candle_sources')[$source];

        $candles = (new Candles(new $class()))->getByTime(50, $moeda);
        
        return view('candles', ['candles' => $candles]);
    }

    /**
     * Strategy result by source and pair
     */
    public function resultado_data($source, $moeda)
    {
        $class = "App\Classes\Estrategias\Resultado".config('app.candle_sources')[$source];

        $resultado = (new ResultadoEstrategia(new $class()))->getByTime(3, $moeda);
        
        $arr_result = array();
        foreach($resultado as $estrategia => $arr_item)
        {
            $arr_result['content-'.$estrategia] = view('resultado', ['resultados' => $arr_item['resultado']])->render();
        }

        return json_encode($arr_result);
    }

    /**
     * Show candle import data dashboard
     */
    public function import()
    {
        $aaa = new StrategyProcess(1, 'iq');
        $resdthr = \App\Models\ValoresIqOptionCandles::where('idpairs',1)->get('datahora');

        $class = "App\Classes\Input\Input".config('app.candle_sources')['iq'];
        
        
        foreach ($resdthr as $idthr) {
            //$aaa->run($idthr->datahora);
            (new CandlesInput(new $class()))->process($idthr->datahora);
        }
        

        dd('die');

        $pairs = (new PairsClass())->getList(PairsClass::$LIST_ONLY);

        return view('import.import-candles');    
    }

    /**
     * Start file import from source and build result table
     */
    public function start_import($source, $dthr)
    {
        $arr_resultado = null;
        $return_arr = array();

        $class = "App\Classes\Input\Input".config('app.candle_sources')[$source];

        $arr_resultado = (new CandlesInput(new $class()))->process($dthr);

        array_multisort($arr_resultado, SORT_DESC);

        return view('import.import-list-table', [
            'table_content' => $arr_resultado
            ])->render();

    }

    /**
     * Call the job to process the strategy
     */
    public function processa_estrategia($source, $moeda)
    {
        $estrategiaJob = new BeginStrategyProcess($source, $moeda);
        dispatch($estrategiaJob);
    }
}
