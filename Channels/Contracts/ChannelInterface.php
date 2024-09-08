<?php

namespace App\WebSocket\Channels\Contracts;

use Ratchet\ConnectionInterface;

interface ChannelInterface
{
    /**
     * Подписывает клиента на канал.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     */
    public function subscribe(ConnectionInterface $conn): void;

    /**
     * Отписывает клиента от канала.
     *
     * @param ConnectionInterface $conn Объект соединения клиента.
     */
    public function unsubscribe(ConnectionInterface $conn): void;
}
