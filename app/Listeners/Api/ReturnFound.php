<?php

namespace App\Listeners\Api;

use App\Events\Api\ObjectFound;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReturnFound
{
    /**
     * Handle the event.
     *
     * @param  ObjectFound  $event
     * @return void
     */
    public function handle(ObjectFound $event)
    {
        return $event->listener->respond(['contact' => $event->data['data']]);
    }
}
