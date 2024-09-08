<?php

namespace App\WebSocket\Errors\Contracts;

use Exception;

/**
 * Определяет методы для обработки ошибок в системе.
 *
 * @package App\WebSocket\Errors\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface ErrorHandlerInterface
{
    /**
     * Обрабатывает переданную ошибку.
     *
     * @param Exception $exception
     *
     * @return void
     */
    public function handle(Exception $exception): void;
}
