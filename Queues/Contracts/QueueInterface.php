<?php

namespace App\WebSocket\Queues\Contracts;

/**
 * Интерфейс для работы с очередями.
 *
 * @package App\WebSocket\Queues\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface QueueInterface
{
    /**
     * Помещает задачу в очередь.
     *
     * @param string $job Задача для выполнения.
     * @param array $data Данные, связанные с задачей.
     * @return void
     */
    public function push(string $job, array $data): void;

    /**
     * Помещает задачу в очередь с задержкой.
     *
     * @param int $delay Задержка в секундах.
     * @param string $job Задача для выполнения.
     * @param array $data Данные, связанные с задачей.
     * @return void
     */
    public function later(int $delay, string $job, array $data): void;

    /**
     * Извлекает задачу из очереди.
     *
     * @return array|null Возвращает задачу и данные или null, если очередь пуста.
     */
    public function pop(): ?array;
}
