<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExitoSubiendoArchivoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($usuario, $operacion_id, $data)
    {
        $this->usuario = $usuario;
        $this->operacion_id = $operacion_id;
        $this->data = $data;
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'operacion_id' => $this->operacion_id,
        ];
    }

    public function broadcastOn()
    {
        error_log("Tratando de enviar mensaje");
        return new PrivateChannel("App.User.{$this->usuario->id}");
    }
}
