<?php

namespace App\Listeners;

use App\Providers\IqOptionValueCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IqOptionValueCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IqOptionValueCreatedEvent  $event
     * @return void
     */
    public function handle(IqOptionValueCreatedEvent $event)
    {
        $candle = $event->getCandle();
        error_log('Some message here.');
    }

}