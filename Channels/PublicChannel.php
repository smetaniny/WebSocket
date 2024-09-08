<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelInterface;
use Ratchet\ConnectionInterface;

/**
 * Реализация публичного канала для подписки и отправки сообщений.
 *
 * @package App\WebSocket\Channels
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class PublicChannel implements ChannelInterface
{
    /**
     * Массив для хранения объектов соединений клиентов.
     * Ключом является уникальный идентификатор клиента.
     *
     * @var array
     */
    protected array $subscribers = [];

    /**
     * Подписывает клиента на канал.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     *
     * @return void
     */
    public function subscribe(ConnectionInterface $conn): void
    {
        // Получаем уникальный идентификатор клиента
        $clientId = $this->getClientId($conn);

        // Проверяем, не подписан ли уже клиент на этот канал
        if (!isset($this->subscribers[$clientId])) {
            // Добавляем клиента в массив подписчиков
            $this->subscribers[$clientId] = $conn;

            // Вывод сообщения в консоль (или журнал)
            echo "Клиент {$clientId} подписан на канал PublicChannel.\n";
        } else {
            echo "Клиент {$clientId} уже подписан на канал PublicChannel.\n";
        }
    }

    /**
     * Отписывает клиента от канала.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     *
     * @return void
     */
    public function unsubscribe(ConnectionInterface $conn): void
    {
        // Получаем уникальный идентификатор клиента
        $clientId = $this->getClientId($conn);

        // Проверяем, подписан ли клиент на этот канал
        if (isset($this->subscribers[$clientId])) {
            // Удаляем клиента из массива подписчиков
            unset($this->subscribers[$clientId]);

            // Вывод сообщения в консоль (или журнал)
            echo "Клиент {$clientId} отписан от канала PublicChannel.\n";
        } else {
            echo "Клиент {$clientId} не был подписан на канал PublicChannel.\n";
        }
    }

    /**
     * Отправляет сообщение всем подписчикам канала.
     *
     * @param string $message Сообщение для отправки.
     *
     * @return void
     */
    public function broadcast(string $message): void
    {
        // Проходим по каждому подписчику и отправляем сообщение
        foreach ($this->subscribers as $conn) {
            $conn->send($message);

            // Вывод сообщения в консоль (или журнал)
            echo "Сообщение '{$message}' отправлено клиенту с ID: {$this->getClientId($conn)}.\n";
        }
    }

    /**
     * Получает уникальный идентификатор клиента из объекта соединения.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     *
     * @return string Уникальный идентификатор клиента.
     */
    protected function getClientId(ConnectionInterface $conn): string
    {
        // В реальной реализации можно использовать ID из соединения
        // Например, IP-адрес, уникальный идентификатор сессии или другие данные
        return (string) $conn->resourceId;
    }
}
