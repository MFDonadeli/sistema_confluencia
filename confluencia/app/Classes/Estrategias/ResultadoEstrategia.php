<?php

namespace App\Classes\Estrategias;

class ResultadoEstrategia {
    private $time;
    private $resultado;

    public function __construct($resultado)
    {
        $this->resultado = $resultado;
    }

    public function getByTime($time,$moeda)
    {
        return $this->resultado->getByTime($time,$moeda);
    }
}

?>