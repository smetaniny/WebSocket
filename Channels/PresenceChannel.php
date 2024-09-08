<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelInterface;
use Ratchet\ConnectionInterface;

/**
 * Канал присутствия (PresenceChannel), позволяющий отслеживать подписку и отписку клиентов.
 *
 * @package App\WebSocket\Channels
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class PresenceChannel implements ChannelInterface
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

        // Добавляем клиента в массив подписчиков
        $this->subscribers[$clientId] = $conn;

        // Вывод сообщения в консоль (или журнал)
        echo "Клиент {$clientId} подписан на канал PresenceChannel.\n";
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

        // Удаляем клиента из массива подписчиков
        unset($this->subscribers[$clientId]);

        // Вывод сообщения в консоль (или журнал)
        echo "Клиент {$clientId} отписан от канала PresenceChannel.\n";
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
        foreach ($this->subscribers as $clientId => $conn) {
            // Отправка сообщения клиенту
            $conn->send($message);

            // Вывод сообщения в консоль (или журнал)
            echo "Сообщение '{$message}' отправлено клиенту {$clientId}.\n";
        }
    }

    /**
     * Получает уникальный идентификатор клиента из объекта соединения.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     * @return string Уникальный идентификатор клиента.
     */
    protected function getClientId(ConnectionInterface $conn): string
    {
        // В реальной реализации можно использовать ID из соединения.
        // Например, вы можете использовать IP-адрес, уникальный идентификатор сессии или другие данные.
        return (string) $conn->resourceId;
    }
}
