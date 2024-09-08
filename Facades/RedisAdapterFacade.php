<?php

namespace App\WebSocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\WebSocket\Core\WebSocketRouter
 * @package App\WebSocket\Facades
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 *
 * @method static set(string $string, false|string $json_encode)
 */
class RedisAdapterFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.redisAdapter';
    }
}
