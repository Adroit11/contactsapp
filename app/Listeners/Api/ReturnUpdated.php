<?php

namespace App\Listeners\Api;

use App\Events\Api\ObjectUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Api\ContactsController;

class ReturnUpdated
{
    /**
     * Handle the event.
     *
     * @param  ContactCreated  $event
     * @return void
     */
    public function handle(ObjectUpdated $event)
    {
        return $event->listener->respond(['contact' => $event->data['data']]);
    }
}
