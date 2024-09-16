<?php

namespace App\WebSocket\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @see \App\WebSocket\Router\WebSocketRouter
 * @package App\WebSocket\Facades
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 *
 * @method static route(\Ratchet\ConnectionInterface $conn, mixed $msg)
 */
class RouterFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.router';
    }
}
