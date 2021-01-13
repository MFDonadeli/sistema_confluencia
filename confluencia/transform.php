<?php

$arr_est = array();
$estrategia_usada = "";

$array_conversao = array(
    "action_candle_0" => 0,
    "action_candle_1" => 1,
    "action_candle_2" => 2,
    "action_candle_3" => 3,
    "action_candle_4" => 4,

    "howmany_candles_for_entering_message" => "mensagem_qtde",
    "candles_for_entering_message" => "mensagem_analise",

    "candles_for_entering" => "vela_analise",
    "howmany_candles_for_entering" => "entrada_qtde",
    "howmany_candles_for_entering_analysis" => "gale1_qtde",
    "candle_entering_result" => "entrada_resultado",

    "howmany_candles_for_gale1_message" => "",
    "candles_for_gale1_message" => "",

    "candles_for_gale1" => "gale1_analise",
    "howmany_candles_for_gale1" => "gale1_qtde",
    "howmany_candles_for_gale1_analysis" => "gale2_qtde",
    "candle_gale1_result" => "gale1_resultado",

    "howmany_candles_for_gale2_message" => "",
    "candles_for_gale2_message" => "",

    "candles_for_gale2" => "gale2_analise",
    "howmany_candles_for_gale2" => "gale2_qtde",
    "candles_for_gale2_analysis" => "gale2res_analise",

    "howmany_candles_for_gale2_analysis" => "gale2res_qtde",
    "candle_gale2_result" => "gale2_resultado"
);

$arr_estrategias = ["mhi1", "mhi2", "mhi3", "vituxo", "mmaioria", "mminoria", "protraders", "vizinhos", "e23", "r7", "novaera", "torresgemeas", "moonwalker"];

$fields = "(estrategia,";
$values = "";

foreach ($arr_estrategias as $estrategia_usada) {
    $arr_est = get_arr($estrategia_usada);
    
    $values .= "('$estrategia_usada',";
    foreach ($array_conversao as $key=>$val) {
        if(!array_key_exists($val, $arr_est))
            $values .= '"",';
        else
            $values .= '"' . $arr_est[$val] . '",';
    }
    $values .= ")" . PHP_EOL;
}

$fields .= implode(",", array_keys($array_conversao));
echo "INSERT INTO tabela" . PHP_EOL . "$fields)" . PHP_EOL . "VALUES $values";

function get_arr($estrategia_usada)
{
    $arr_est = array();

    if($estrategia_usada == "mhi1")
    {
        //$arr_est['parte'] = 5; //Tamanho do quadrante (vai executar a cada parte velas)
        $arr_est[4] = 'mensagem'; //Na vela %5 = 4
        $arr_est[0] = 'entrada';
        $arr_est[1] = 'gale1';
        $arr_est[2] = 'gale2';
        $arr_est[3] = 'gale2res'; 
        $arr_est['mensagem_qtde'] = 2; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 3; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 4; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Minoria';
    }
    else if($estrategia_usada == "mhi2")
    {
        $arr_est[0] = 'mensagem'; //Na vela %5 = 4
        $arr_est[1] = 'entrada';
        $arr_est[2] = 'gale1';
        $arr_est[3] = 'gale2';
        $arr_est[4] = 'gale2res';
        $arr_est['mensagem_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 4; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Minoria';
    }
    else if($estrategia_usada == "mhi3")
    {
        $arr_est[1] = 'mensagem'; //Na vela %5 = 4
        $arr_est[2] = 'entrada';
        $arr_est[3] = 'gale1';
        $arr_est[4] = 'gale2';
        $arr_est[0] = 'gale2res';
        $arr_est['mensagem_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Minoria';
    }
    else if($estrategia_usada == "vituxo")
    {
        $arr_est[1] = 'mensagem'; //Na vela %5 = 4
        $arr_est[2] = 'entrada';
        $arr_est[3] = 'gale1';
        $arr_est[4] = 'gale2';
        $arr_est[0] = 'gale2res';
        $arr_est['mensagem_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 9; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 8; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 10; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 9; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Maioria';
    }
    else if($estrategia_usada == "protraders")
    {
        $arr_est[1] = 'mensagem'; //Na vela %5 = 4
        $arr_est[2] = 'entrada';
        $arr_est[3] = 'gale1';
        $arr_est[4] = 'gale2';
        $arr_est[0] = 'gale2res';
        $arr_est['mensagem_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "1,2,3"; //soma essas entradas array
        $arr_est['vela_analise'] = "1,2,3"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 9; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 8; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 10; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 9; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Minoria';
    }
    else if($estrategia_usada == "mmaioria")
    {
        $arr_est[4] = 'mensagem'; //Na vela %5 = 4
        $arr_est[0] = 'entrada';
        $arr_est[1] = 'gale1';
        $arr_est[2] = 'gale2';
        $arr_est[3] = 'gale2res';
        $arr_est['mensagem_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1,2,3"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2,3,4"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Maioria';
    }
    else if($estrategia_usada == "mminoria")
    {
        $arr_est[4] = 'mensagem'; //Na vela %5 = 4
        $arr_est[0] = 'entrada';
        $arr_est[1] = 'gale1';
        $arr_est[2] = 'gale2';
        $arr_est[3] = 'gale2res';
        $arr_est['mensagem_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = "0,1,2,3"; //soma essas entradas array
        $arr_est['vela_analise'] = "0,1,2,3,4"; //soma essas entradas array
        $arr_est['entrada_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Minoria';
    }
    else if($estrategia_usada == "vizinhos")
    {
        $arr_est[3] = 'mensagem'; //Na vela %5 = 4
        $arr_est[4] = 'entrada';
        $arr_est[0] = 'gale1';    
        $arr_est[1] = 'gale2';
        $arr_est[2] = 'gale2res';
        $arr_est['mensagem_qtde'] = 0; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 1; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 2; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 1; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 2; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 3; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "e23")
    {
        $arr_est[0] = 'mensagem'; //Na vela %5 = 4
        $arr_est[1] = 'entrada';
        $arr_est[2] = 'gale1';    
        $arr_est[3] = 'gale2';
        $arr_est[4] = 'gale2res';
        $arr_est['mensagem_qtde'] = 0; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 1; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 2; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 1; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 2; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 3; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "r7")
    {
        $arr_est[0] = 'mensagem'; //Na vela %5 = 4
        $arr_est[1] = 'entrada';
        $arr_est[2] = 'gale1';    
        $arr_est[3] = 'gale2';
        $arr_est[4] = 'gale2res';
        $arr_est['mensagem_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 9; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 10; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 9; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 11; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 10; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 12; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 11; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "novaera")
    {
        $arr_est[3] = 'mensagem'; //Na vela %5 = 4
        $arr_est[4] = 'entrada';
        $arr_est[0] = 'gale1';    
        $arr_est[1] = 'gale2';
        $arr_est[2] = 'gale2res';
        $arr_est['mensagem_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "torresgemeas")
    {
        $arr_est[3] = 'mensagem'; //Na vela %5 = 4
        $arr_est[4] = 'entrada';
        $arr_est[0] = 'gale1';    
        $arr_est[1] = 'gale2';
        $arr_est[2] = 'gale2res';
        $arr_est['mensagem_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 4; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 6; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "moonwalker")
    {
        $arr_est[4] = 'mensagem'; //Na vela %5 = 4
        $arr_est[0] = 'entrada';
        $arr_est[1] = 'gale1';    
        $arr_est[2] = 'gale2';
        $arr_est[3] = 'gale2res';
        $arr_est['mensagem_qtde'] = 2; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 4; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 3; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 4; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 6; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }
    else if($estrategia_usada == "impar")
    {
        $arr_est[4] = 'mensagem,gale2'; //Na vela %5 = 4
        $arr_est[0] = 'entrada,gale2res';
        $arr_est[2] = 'gale1';    
        $arr_est['mensagem_qtde'] = 2; //x anteriores, vai pegar o array deste tamanho
        $arr_est['mensagem_analise'] = -1; //soma essas entradas array (usado somente quando há que somar velas)
        $arr_est['vela_analise'] = 0; //soma essas entradas array
        $arr_est['entrada_qtde'] = 3; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_analise'] = $arr_est['vela_analise'];
        $arr_est['gale1_qtde'] = 5; //x anteriores, vai pegar o array deste tamanho
        $arr_est['entrada_resultado'] = 3; //posicao do array da vela do resultado da entrada
        $arr_est['gale2_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2res_analise'] = $arr_est['vela_analise'];                
        $arr_est['gale2_qtde'] = 7; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale1_resultado'] = 5; //posicao do array da vela do resultado da entrada
        $arr_est['gale2res_qtde'] = 8; //x anteriores, vai pegar o array deste tamanho
        $arr_est['gale2_resultado'] = 7; //posicao do array da vela do resultado da entrada
        $arr_est['analise'] = 'Vela Unica';
        $arr_est['contrario'] = false;
    }

    return $arr_est;
}
