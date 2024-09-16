<?php

namespace App\WebSocket\Core\Contracts;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * Интерфейс для маршрутизации сообщений WebSocket.
 *
 * @package App\WebSocket\Core\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface RouterInterface
{
    /**
     * Метод для маршрутизации сообщений.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param MessageInterface $msg Объект сообщения WebSocket.
     *
     * @return void
     */
    public function route(ConnectionInterface $conn, MessageInterface $msg): void;
}
