<?php

namespace App\WebSocket\Channels;

use Ratchet\ConnectionInterface;
use App\WebSocket\Channels\Contracts\ChannelInterface;

class Channel implements ChannelInterface
{
    // Массив для хранения подписчиков канала. Ключом является идентификатор соединения, значением - само соединение.
    protected array $subscribers = [];

    /**
     * Подписывает клиента на канал.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     */
    public function subscribe(ConnectionInterface $conn): void
    {
        // Добавляем соединение клиента в массив подписчиков, используя идентификатор соединения как ключ.
        $this->subscribers[$conn->resourceId] = $conn;
    }

    /**
     * Отписывает клиента от канала.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     */
    public function unsubscribe(ConnectionInterface $conn): void
    {
        // Удаляем соединение клиента из массива подписчиков по идентификатору соединения.
        unset($this->subscribers[$conn->resourceId]);
    }

    /**
     * Отправляет сообщение всем подписчикам канала.
     *
     * @param string $message Сообщение для отправки.
     */
    public function broadcast(string $message): void
    {
        // Проходим по каждому подписчику и отправляем ему сообщение.
        foreach ($this->subscribers as $subscriber) {
            // Отправляем сообщение клиенту через соединение WebSocket.
            $subscriber->send($message);
        }
    }
}
