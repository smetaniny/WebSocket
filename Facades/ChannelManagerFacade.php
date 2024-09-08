<?php

namespace App\WebSocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\WebSocket\Clients\Facades
 * @package App\WebSocket\Errors
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ChannelManagerFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.channelManager';
    }
}
