<?php

namespace App\Events\Api;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Api\ApiControllerInterface;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ObjectCreated extends Event
{
    public $data;
    public $listener;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $data, ApiControllerInterface $listener)
    {
        $this->data = $data;
        $this->listener = $listener;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
