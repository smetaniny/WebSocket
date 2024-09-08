<?php

namespace App\WebSocket\Errors\Contracts;


use Exception;

/**
 * Определяет методы для логирования исключений.
 *
 * @package App\WebSocket\Errors\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
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
