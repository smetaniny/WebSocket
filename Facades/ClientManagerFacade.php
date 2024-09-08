<?php

namespace App\WebSocket\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @see \App\WebSocket\Clients\Facades
 * @package App\WebSocket\Errors
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 *
 * @method static getClients()
 * @method static removeClient($resourceId)
 * @method static addClient($resourceId, \Ratchet\ConnectionInterface $conn)
 * @method static getClient($resourceId)
 */
class ClientManagerFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.clientManager';
    }
}
