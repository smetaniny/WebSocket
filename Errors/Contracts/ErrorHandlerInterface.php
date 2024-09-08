<?php

namespace App\WebSocket\Errors\Contracts;

use Exception;

/**
 * Interface ErrorHandlerInterface
 * @package WebSocket\Errors\Contracts
 *
 * Определяет методы для обработки ошибок в системе.
 */
interface ErrorHandlerInterface
{
    /**
     * Обрабатывает переданную ошибку.
     *
     * @param Exception $exception
     * @return void
     */
    public function handle(Exception $exception): void;
}
