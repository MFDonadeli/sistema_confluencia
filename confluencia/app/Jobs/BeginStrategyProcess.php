<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use \App\Classes\Estrategias\StrategyProcess;

class BeginStrategyProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $moeda;
    private $source;
    private $dthr;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($source, $moeda, $dthr)
    {
        $this->moeda = $moeda;
        $this->source = $source;
        $this->dthr = $dthr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $aaa = new StrategyProcess($this->moeda, $this->source);
        $aaa->run($this->dthr);
    }
}
