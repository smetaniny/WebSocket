<?php

namespace Smetaniny\WebSocket\Facades;

use Illuminate\Support\Facades\Facade;

class WebSocketFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'web-socket';
    }
}
