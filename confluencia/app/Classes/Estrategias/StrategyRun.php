<?php

namespace App\Classes\Estrategias;

use App\Classes\Utils\Util;
use App\Models\Estrategias;
use App\Classes\Candles\Candles;

class StrategyRun
{
    private $moeda;
    private $estrategia_usada;
    private $source;
    private $contagem;
    private $dthr;
    private $acao;
    private $strategy_def;

    private $arr_entradas;

    private $dbLogClass;
    private $dbResultadoClass;

    public function __construct($strategy)
    {
        $this->moeda = $strategy->getMoeda();
        $this->estrategia_usada = $strategy->getStrategyName();
        $this->source = $strategy->getSource();
        $this->strategy_def = $strategy;
    }

    /**
     * Start the proccess of giving strategy results
     * 
     * $candles: Array of candles necessary to be processed
     * $dthr: Date/time that will be used to process the strategy step
     * $acao: Action that describe the action to be processed
     */
    public function run($candles, $dthr, $acao)
    {
        $this->arr_entradas = array();
        $this->dthr = $dthr;
        $this->acao = $acao;
        
        foreach ($candles as $item) {
            $this->arr_entradas[$item->datahora] = $item->resultado;
        }

        $this->dbLogClass = "App\Models\LogStrategySteps" . config('app.candle_sources')[$this->source];
        $this->dbResultadoClass = "App\Models\ResultadoEstrategia" . config('app.candle_sources')[$this->source];

        $this->process();
    }

    /**
     * Count the amount of candles of an specific color, this is necessary for somestrategies
     * 
     * $keys: Array of candles
     * $passo: Step we are analysing now
     */
    private function doCount($keys, $passo)
    {
        $arr_itens = $this->strategy_def->getCandlesToBeAnalyzed($passo);
        
        //Soma 2 ultimas velas do quandrante anterior
        foreach ($arr_itens as $item) {
            if ($this->arr_entradas[$keys[$item]] == 'GREEN') {
                $this->contagem++;
            }
            else if ($this->arr_entradas[$keys[$item]] == 'RED') {   
                $this->contagem--;
            }
        }
    }

    private function getCandleFromStep($keys, $passo, $contrario = false)
    {
        $item = $this->strategy_def->getCandlesToBeAnalyzed($passo);
        $retval = "";

        if($item == -1)
            return "Depende";

        $vela = ($this->arr_entradas[$keys[$item]]);
        
        //Soma 2 ultimas velas do quandrante anterior
        if($vela == 'GREEN' && $contrario)  {
            $retval = "RED";
        }
        else if ($vela == 'RED' && $contrario) {
            $retval = "GREEN";
        }
        else {
            $retval = $vela;
        }

        return $retval;
    }

    /**
     * Check if now or specific step was a win or a loss
     * 
     * $keys: Array of candles
     * $passo: action thw will be performed now
     */
    private function isWin($keys, $passo)
    {
        if ($this->strategy_def->getAnalysis() != "Vela Unica") {
            $this->doCount($keys, "gale1");
            
            //Datetime and color of the entering candle
            $datahora = $keys[$this->strategy_def->candle_entering_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_entering_result]];

            $condicao = $this->winCountCondition($vela);

            //If next step is gale1 or was win before
            if ($passo == 'gale1') {
                return $condicao;
            }
            else if ($condicao === true) {
                 return "win";
            }

            $this->doCount($keys, "gale2");
            
            $datahora = $keys[$this->strategy_def->candle_gale1_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_gale1_result]];

            $condicao = $this->winCountCondition($vela);

            if($passo == 'gale2') {
                return $condicao;
            }
            else if($condicao === true) {
                return "win";
            }

            $this->doCount($keys, "gale2");
            
            $datahora = $keys[$this->strategy_def->candle_gale2_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_gale2_result]];

            return $this->winCountCondition($vela);
        }    
        else {
            $contrario = false;
            if ($this->strategy_def->isContrario()) {
                $contrario = true;
            } 
            
            $retorno_vela = $this->getCandleFromStep($keys, "entering", $contrario);

            $datahora = $keys[$this->strategy_def->candle_entering_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_entering_result]];


            $condicao = $vela == $retorno_vela;

            if ($retorno_vela == "GRAY") {
                return 0;
            }
            else if ($passo == 'gale1') {
                return $condicao;
            }
            else if ($condicao === true) {
                return "win";
            }

            $retorno_vela = $this->getCandleFromStep($keys, "gale1", $contrario);

            $datahora = $keys[$this->strategy_def->candle_gale1_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_gale1_result]];

            $condicao = $vela == $retorno_vela;

            if ($retorno_vela == "GRAY") {
                return 0;
            }
            else if ($passo == 'gale2') {
                return $condicao;
            }
            else if ($condicao === true) { 
                return "win";                   
            }

            $retorno_vela = $this->getCandleFromStep($keys, "gale2", $contrario);

            $datahora = $keys[$this->strategy_def->candle_gale2_result];
            $vela = $this->arr_entradas[$keys[$this->strategy_def->candle_gale2_result]];

            $condicao = $vela == $retorno_vela;

            if ($retorno_vela == "GRAY") {
                return 0;
            }
            else {
                return $condicao;  
            }

        }
    }

    /**
     * After counting the amount of candles of a color, then check the result of that counting
     */
    private function winCountCondition($vela)
    {
        if ($this->contagem == 0) {
            return 0; //Tem igual verde e vermelho com gray no meio
        }

        if (
             (
                ( ($this->contagem > 0 && $vela == "RED" ) ||
                    ($this->contagem < 0 && $vela == "GREEN") ) 
                && $this->strategy_def->getAnalysis() == "Minoria" 
            )  ||
            ((($this->contagem > 0 && $vela == "GREEN" ) ||
                ($this->contagem < 0 && $vela == "RED")) 
                && $this->strategy_def->getAnalysis() == "Maioria" )
            ) {  
                return true;
        }
        else {
                return false;
        }
    }

    private function whatsNextCandle(&$message, $passo)
    {
        if ($this->contagem > 0) {
            if ($this->strategy_def->getAnalysis() == "Minoria") {
                if ($passo == 'entrada') {
                    $message = "Vela Vermelha. Se for verde preparar primeiro gale";
                }

                if ($passo == 'gale1') {
                    $message = "Vela Vermelha. Se for verde preparar segundo gale";
                }

                if ($passo == 'gale2') {
                    $message = "Vela Vermelha. Se for verde será loss";
                }
                
                return "Vermelha";
            }
            else {
                if ($passo == 'entrada') {
                    $message = "Vela Verde. Se for vermelha preparar primeiro gale";
                }

                if ($passo == 'gale1') {
                    $message = "Vela Verde. Se for vermelha preparar segundo gale";
                }

                if ($passo == 'gale2') {
                    $message = "Vela Verde. Se for vermelha será loss";
                }

                return "Verde";
            }
            
        }
        else if ($this->contagem < 0) {
            if ($this->strategy_def->getAnalysis() == "Minoria") {
                if ($passo == 'entrada') {
                    $message = "Vela Verde. Se for vermelha preparar primeiro gale";
                }

                if ($passo == 'gale1') {
                    $message = "Vela Verde. Se for vermelha preparar segundo gale";
                }

                if ($passo == 'gale2') {
                    $message = "Vela Verde. Se for vermelha será loss";
                }

                return "Verde";
            }
            else {
                if ($passo == 'entrada') {
                    $message = "Vela Vermelha. Se for verde preparar primeiro gale";
                }

                if($passo == 'gale1') {
                    $message = "Vela Vermelha. Se for verde preparar segundo gale";
                }

                if($passo == 'gale2') {
                    $message = "Vela Vermelha. Se for verde será loss";
                }

                return "Vermelha";
            }
        } 
        else {
            $message = "Quantidade igual, pula essa entrada";
            return "";
        } 
    }

    private function process()
    {
        $message = "";
        $this->contagem = 0;
        $resultado = "";
        $sql = "";  
        $sql_log = "";
        $vela_retorno = "";

        $dthr = $this->dthr;
        $acao = $this->acao;

        
        //Check the action 
        if ($acao == "entering_message") {
            //$arr_itens = array(6,7);

            //sort the array of candles to be in order of time
            $keys = array_keys($this->arr_entradas);
            sort($keys);

            //If the strategy is based on multiple candles
            if ($this->strategy_def->getAnalysis() != "Vela Unica") {
                //count the amount of greens and reds
                $this->doCount($keys, $acao);
                \Log::debug("MENSAGEM. Contagem " . $this->contagem . " analise " . $this->strategy_def->getAnalysis());

                //Se tiver mais verde
                if ($this->contagem > 0) {
                    if ($this->strategy_def->getAnalysis() == "Minoria") {
                        $message = "Próxima Vela Vermelha";
                        $resultado = "Vermelha";
                    }
                    else {
                        $message = "Próxima Vela Verde";
                        $resultado = "Verde";
                    }
                    
                }
                //Se tiver mais vermelha
                else if ($this->contagem < 0) {
                    if ($this->strategy_def->getAnalysis() == "Minoria") {
                        $message = "Próxima Vela Verde";
                        $resultado = "Verde";
                    }
                    else {
                        $message = "Próxima Vela Vermelha";
                        $resultado = "Vermelha";
                    }
                }
                //Se a quantidade for igual, vai depender
                else if ($this->contagem == 0) {
                    //$this->vela_guardada = "DEPEND";
                    if ($this->strategy_def->getAnalysis() == "Minoria") {
                        $message = "Se a vela atual for Vermelha, a próxima será verde, caso contrário será vermelha";
                    }
                    else {
                        $message = "Se a vela atual for Verde, a próxima será vermelha, caso contrário será verde";
                    }

                    $resultado = "Depende";   
                }
                
            }
            //If the strategy is based on one candle
            else if ($this->strategy_def->getAnalysis() == "Vela Unica") {
                if(count($this->arr_entradas) == 0) {
                    if ($this->strategy_def->isContrario()) {
                        $message = "Se a vela atual for Vermelha, a próxima será verde, caso contrário será vermelha";
                    }
                    else {
                        $message = "Se a vela atual for Vermelha, a próxima será vermelha, caso contrário será verde";
                    }
                }
                else {
                    $contrario = false;
                    
                    if($this->strategy_def->isContrario()) {
                        $contrario = true;
                    }
                    
                    $retorno_vela = $this->getCandleFromStep($keys, "entering_message", $contrario);
                    
                    $resultado = $retorno_vela;
                    
                    $message = "Próxima vela $retorno_vela";
                }

                \Log::debug("MENSAGEM: $message" . PHP_EOL);
                
            }
        }
        ////PROCESSAMENTO DA ENTRADA
        else if ($acao == "entering") {
            $keys = array_keys($this->arr_entradas);
            sort($keys);
            
            if ($this->strategy_def->getAnalysis() != "Vela Unica") {
                $this->doCount($keys, $acao);
                $vela_retorno = $this->whatsNextCandle($message, $acao);  
                \Log::debug("ENTRADA: Contagem " . $this->contagem . " Vela " . $vela_retorno . PHP_EOL); 
            }   
            else if ($this->strategy_def->getAnalysis() == "Vela Unica") {
                if (count($this->arr_entradas) == 0) {
                    
                    if($this->strategy_def->isContrario()) {
                        $message = "Se a vela atual for Vermelha, a próxima será verde, caso contrário será vermelha";
                    }
                    else {
                        $message = "Se a vela atual for Vermelha, a próxima será vermelha, caso contrário será verde";
                    }

                }
                else {
                    $contrario = false;
                    
                    if ($this->strategy_def->isContrario()) {
                        $contrario = true;
                    }

                    $vela_retorno = $this->getCandleFromStep($keys, $acao, $contrario);
                    $message = "Vela $vela_retorno";
                }

                \Log::debug("ENTRADA: Mensagem " . $message . PHP_EOL);
                
            } 
        }
        else {
            $passo = '';
            $msg_win = "";
            $msg_loss = "";
            $res_win = "";
            $res_loss = "";
            $resultados = false;
            ////PROCESSAMENTO DO GALE1
            //Aqui vai salvar se deu green na entrada
            //if(count($this->arr_entradas) == $this->getgale1_qtd()) //gale1
            if ($acao == "gale1") {
                $passo = "gale1";
                $msg_win = "Win de primeira";
                $res_win = "WIN";
                $msg_loss = "Vai para o gale 1";
                $res_loss = "G1";
                $resultados = true;
            }
            ////PROCESSAMENTO DO GALE2
            //Aqui vai salvar se deu green no gale1
            //else if(count($this->arr_entradas) == $this->getgale2_qtd()) //gale2
            else if ($acao == "gale2") {
                $passo = "gale2";
                $msg_win = "Win Gale1";
                $res_win = "Gale1";
                $msg_loss = "Vai para o gale 2";
                $res_loss = "G2";
                $resultados = true;
            }
            ////PROCESSAMENTO DO RESULTADO G2
            //else if(count($this->arr_entradas) == $this->gale2res_qtde()) //gale2res
            else if ($acao == "gale2_analysis") {
                $passo = "gale2_analysis";
                $msg_win = "Win Gale2";
                $res_win = "Gale2";
                $msg_loss = "Loss";
                $res_loss = "Loss";
                $resultados = true;
            }

            //Vai processar um dos resultados
            if ($resultados) {
                $keys = array_keys($this->arr_entradas);
                sort($keys);

                $condicao = $this->isWin($keys, $passo);

                //Se já havia dado win antes
                if ($condicao === "win") {
                    \Log::debug("Etapa: $passo já havia dado Win em passos anteriores");
                    return;
                }

                if ($condicao === true) {
                    \Log::debug("Etapa: $passo deu win");
                    $datahora = $keys[$this->strategy_def->candle_entering_result];

                    $message = $msg_win;
                    $resultado = $res_win;

                    $this->dbResultadoClass::updateOrInsert([
                        'idpairs' => $this->moeda,
                        'datahora' => $datahora,
                        'estrategia' => $this->estrategia_usada],
                        ['resultado_estrategia' => $res_win]
                        );

                }
                else if ($condicao === false) {   
                    \Log::debug("Etapa: $passo deu loss");
                    $message = $msg_loss;

                    $vela_retorno = $this->arr_entradas[$keys[$this->strategy_def->candle_entering_result]];

                    if ($this->strategy_def->getAnalysis() != "Vela Unica") {
                        $vela_retorno = $this->whatsNextCandle($message, $passo);
                    }
                    
                    $datahora = $keys[$this->strategy_def->candle_entering_result];
                    
                    $resultado = $res_loss;
                    $this->dbResultadoClass::updateOrInsert([
                        'idpairs' => $this->moeda,
                        'datahora' => $datahora,
                        'estrategia' => $this->estrategia_usada],
                        ['resultado_estrategia' => $res_loss]
                    );

                }   
            }

        }
        
        $this->dbLogClass::insert([
            'datahora' => $this->dthr,
            'idpairs' => $this->moeda,
            'estrategia' => $this->estrategia_usada,
            'resultado' => $resultado,
            'mensagem' => $message,
            'vela_retorno' => $vela_retorno
        ]); 
    
        \Log::debug("Atualizando mensagem de " . $this->estrategia_usada . ": $message e $vela_retorno");
    }
}