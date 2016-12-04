<?php

namespace App\Listeners\Api;

use App\Events\Api\ValidationFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReturnValidationErrors
{

    protected $listener;

    /**
     * Handle the event.
     *
     * @param  ValidationFailed  $event
     * @return void
     */
    public function handle(ValidationFailed $event)
    {
        return $event->listener->respondNotSaved($event->data);
    }
}
