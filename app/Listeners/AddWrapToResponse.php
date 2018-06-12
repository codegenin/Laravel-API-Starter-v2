<?php

namespace App\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddWrapToResponse
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
     * @param ResponseWasMorphed|object $event
     * @return void
     */
    public function handle(ResponseWasMorphed $event)
    {
        if (!$event->response->isSuccessful()) {
            $event->response->setStatusCode(200);
        }
    }
}
