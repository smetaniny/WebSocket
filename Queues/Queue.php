<?php

namespace App\WebSocket\Queues;

use App\WebSocket\Queues\Contracts\QueueInterface;

/**
 * Реализация интерфейса QueueInterface для работы с очередями.
 *
 * @package App\WebSocket\Queues
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class Queue implements QueueInterface
{
    // Массив для хранения задач очереди
    protected array $queue = [];

    /**
     * Помещает задачу в очередь.
     *
     * @param string $job Задача для выполнения.
     * @param array $data Данные, связанные с задачей.
     * @return void
     */
    public function push(string $job, array $data): void
    {
        // Добавляем задачу и данные в очередь
        $this->queue[] = ['job' => $job, 'data' => $data];
    }

    /**
     * Помещает задачу в очередь с задержкой.
     *
     * @param int $delay Задержка в секундах.
     * @param string $job Задача для выполнения.
     * @param array $data Данные, связанные с задачей.
     * @return void
     */
    public function later(int $delay, string $job, array $data): void
    {
        // Для простоты реализуем без учета задержки
        $this->push($job, $data);
    }

    /**
     * Извлекает задачу из очереди.
     *
     * @return array|null Возвращает задачу и данные или null, если очередь пуста.
     */
    public function pop(): ?array
    {
        // Извлекаем первую задачу из очереди
        return array_shift($this->queue);
    }
}
