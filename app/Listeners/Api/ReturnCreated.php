<?php

namespace App\Listeners\Api;

use App\Events\Api\ObjectCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Api\ContactsController;

class ReturnCreated
{
    /**
     * Handle the event.
     *
     * @param  ContactCreated  $event
     * @return void
     */
    public function handle(ObjectCreated $event)
    {
        return $event->listener->respond(['contact_id' => $event->data['data']['uid']]);
    }
}
