<?php

namespace App\WebSocket\Errors;

use App\WebSocket\Errors\Contracts\ExceptionLoggerInterface;
use App\WebSocket\Trait\SingletonTrait;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class ExceptionLogger
 * @package WebSocket\Errors
 *
 * Реализует паттерн Singleton для логирования исключений.
 */
class ExceptionLogger implements ExceptionLoggerInterface
{
    // Трейт для реализации паттерна Singleton.
    use SingletonTrait;

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
