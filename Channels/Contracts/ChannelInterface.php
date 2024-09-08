<?php

namespace App\WebSocket\Channels\Contracts;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для реализации каналов WebSocket.
 * Определяет методы для подписки и отписки клиентов от каналов.
 *
 * @package App\WebSocket\Channels\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface ChannelInterface
{
    /**
     * Подписывает клиента на канал.
     *
     * Этот метод добавляет клиента в список подписчиков канала,
     * что позволяет ему получать сообщения, отправленные на этот канал.
     *
     * @param ConnectionInterface $conn Объект соединения клиента, который подписывается на канал.
     *
     * @return void
     */
    public function subscribe(ConnectionInterface $conn): void;

    /**
     * Отписывает клиента от канала.
     *
     * Этот метод удаляет клиента из списка подписчиков канала,
     * что препятствует ему в дальнейшем получать сообщения от этого канала.
     *
     * @param ConnectionInterface $conn Объект соединения клиента, который отписывается от канала.
     *
     * @return void
     */
    public function unsubscribe(ConnectionInterface $conn): void;
}
