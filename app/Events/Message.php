<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }


    public function broadcastOn()
    {
        return new PresenceChannel('requests');
    }

    public function broadcastWith()
    {
        return [
            'request' => $this->request,
        ];
    }

    public function broadcastAs()
    {
        return 'request';
    }
}
