<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Cria um novo evento de mensagem.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Define o canal de broadcast.
     */
    public function broadcastOn()
    {
        // Canal público chamado 'chat'
        return new Channel('chat');
    }

    /**
     * Dados enviados no broadcast.
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }

    /**
     * Nome do evento para o Echo.
     */
    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
