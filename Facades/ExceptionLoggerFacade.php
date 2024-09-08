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
 * @method static log(\Exception $exception)
 */
class ExceptionLoggerFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'websocket.exceptionLogger';
    }
}
