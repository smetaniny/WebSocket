<?php

namespace App\WebSocket\Errors;

use App\WebSocket\Errors\Contracts\ExceptionLoggerInterface;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Реализует паттерн Singleton для логирования исключений.
 *
 * @package App\WebSocket\Errors
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ExceptionLogger implements ExceptionLoggerInterface
{
    /**
     * Логирует переданное исключение.
     *
     * @param Exception $exception
     * @return void
     */
    public function log(Exception $exception): void
    {
        // Ловим возможные ошибки при запуске и логируем их
        Log::channel('websocket')->error($exception->getMessage());
    }
}
