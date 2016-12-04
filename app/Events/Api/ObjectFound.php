<?php

namespace App\Events\Api;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Controllers\Api\ApiControllerInterface;


class ObjectFound extends Event
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
