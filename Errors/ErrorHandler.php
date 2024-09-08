<?php

namespace App\WebSocket\Errors;

use App\WebSocket\Errors\Contracts\ErrorHandlerInterface;
use App\WebSocket\Facades\ErrorHandlerFacade;
use App\WebSocket\Facades\ExceptionLoggerFacade;
use Exception;

/**
 * Реализует стратегию обработки ошибок.
 *
 * @package App\WebSocket\Errors
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ErrorHandler implements ErrorHandlerInterface
{
    /**
     * Обрабатывает переданную ошибку и логирует её.
     *
     * @param Exception $exception
     * @return void
     */
    public function handle(Exception $exception): void
    {
        // Обработка ошибки
        // Здесь могут быть дополнительные действия, например, уведомление разработчиков

        // Логирование ошибки
        ExceptionLoggerFacade::log($exception);
    }
}
