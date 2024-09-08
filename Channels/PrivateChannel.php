<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelInterface;
use Ratchet\ConnectionInterface;

/**
 * Реализация приватного канала для подписки и отправки сообщений.
 *
 * @package App\WebSocket\Channels
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class PrivateChannel implements ChannelInterface
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
            echo "Клиент {$clientId} подписан на канал PrivateChannel.\n";
        } else {
            echo "Клиент {$clientId} уже подписан на канал PrivateChannel.\n";
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
            echo "Клиент {$clientId} отписан от канала PrivateChannel.\n";
        } else {
            echo "Клиент {$clientId} не был подписан на канал PrivateChannel.\n";
        }
    }

    /**
     * Отправляет сообщение клиенту, подписанному на канал.
     *
     * @param string $message Сообщение для отправки.
     * @param ConnectionInterface $conn Объект соединения клиента, которому отправляется сообщение.
     *
     * @return void
     */
    public function sendMessage(string $message, ConnectionInterface $conn): void
    {
        // Получаем уникальный идентификатор клиента
        $clientId = $this->getClientId($conn);

        // Проверяем, подписан ли клиент на этот канал
        if (isset($this->subscribers[$clientId])) {
            // Отправка сообщения клиенту
            $conn->send($message);

            // Вывод сообщения в консоль (или журнал)
            echo "Сообщение '{$message}' отправлено клиенту {$clientId}.\n";
        } else {
            echo "Клиент {$clientId} не подписан на канал PrivateChannel. Сообщение не отправлено.\n";
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
        // В реальной реализации можно использовать ID из соединения
        // Например, вы можете использовать IP-адрес, уникальный идентификатор сессии или другие данные
        return (string) $conn->resourceId;
    }
}
