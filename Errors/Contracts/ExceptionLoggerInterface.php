<?php

namespace App\WebSocket\Errors\Contracts;


use Exception;

/**
 * Interface ExceptionLoggerInterface
 * @package WebSocket\Errors\Contracts
 *
 * Определяет методы для логирования исключений.
 */
interface ExceptionLoggerInterface
{
    /**
     * Логирует переданное исключение.
     *
     * @param Exception $exception
     * @return void
     */
    public function log(Exception $exception): void;
}
