<?php

namespace App\WebSocket\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @see \App\WebSocket\Errors\ErrorHandler
 * @package App\WebSocket\Facades
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 *
 * @method static handle(\Exception $e)
 */
class ErrorHandlerFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.errorHandler';
    }
}
