<?php

namespace App\Listeners\Api;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Api\ContactsController;

class ReturnOk
{
    /**
     * Handle the event.
     *
     * @param  ContactCreated  $event
     * @return void
     */
    public function handle($event)
    {
        return $event->listener->respondOk($event->message);
    }
}
