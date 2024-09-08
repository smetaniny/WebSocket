<?php

namespace App\WebSocket\Monitoring\Contracts;

/**
 * Интерфейс для ведения журнала логов системы.
 */
interface LoggerInterface
{
    /**
     * Записывает сообщение в журнал логов.
     *
     * @param string $message Сообщение для записи в журнал.
     */
    public function log(string $message): void;
}
