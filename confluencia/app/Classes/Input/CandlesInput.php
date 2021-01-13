<?php

namespace App\Classes\Input;

use App\Classes\Interfaces\Writer;

class CandlesInput
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function process($dthr)
    {
        return $this->writer->process($dthr);
    }
}

?>