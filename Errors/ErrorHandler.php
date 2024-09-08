<?php

namespace App\WebSocket\Errors;

use App\WebSocket\Errors\Contracts\ErrorHandlerInterface;
use App\WebSocket\Errors\Contracts\ExceptionLoggerInterface;
use App\WebSocket\Trait\SingletonTrait;
use Exception;

/**
 * Class ErrorHandler
 * @package WebSocket\Errors
 *
 * Реализует стратегию обработки ошибок.
 */
class ErrorHandler implements ErrorHandlerInterface
{
    use SingletonTrait;

    private ExceptionLoggerInterface $logger;

    /**
     * Конструктор класса ErrorHandler.
     */
    private function __construct()
    {
        // Инициализация логгера через Singleton
        $this->logger = ExceptionLogger::getInstance();
    }

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
        $this->logger->log($exception);
    }
}
