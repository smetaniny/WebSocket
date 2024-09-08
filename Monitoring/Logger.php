<?php

namespace App\WebSocket\Monitoring;

use App\WebSocket\Monitoring\Contracts\LoggerInterface;

/**
 * Реализация интерфейса LoggerInterface для ведения журнала логов.
 */
class Logger implements LoggerInterface
{
    // Массив для хранения логов (пример)
    protected array $logs = [];

    /**
     * Записывает сообщение в журнал логов.
     *
     * @param string $message Сообщение для записи в журнал.
     */
    public function log(string $message): void
    {
        // Добавляем сообщение в массив логов
        $this->logs[] = $message;

        // В реальной реализации здесь можно записать лог в файл или в базу данных
        echo "Лог записан: $message\n";
    }
}
