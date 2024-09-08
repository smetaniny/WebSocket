<?php

namespace App\WebSocket\Monitoring\Contracts;

/**
 * Интерфейс для ведения журнала логов системы.
 *
 * @package App\WebSocket\Monitoring\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
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
