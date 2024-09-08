<?php

namespace App\WebSocket\Core\Contracts;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * Интерфейс для обработки событий WebSocket-сервера.
 */
interface WebSocketServerInterface
{
    /**
     * Метод вызывается, когда клиент подключается к серверу.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return void
     */
    public function onOpen(ConnectionInterface $conn): void;

    /**
     * Метод вызывается, когда клиент закрывает соединение.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return void
     */
    public function onClose(ConnectionInterface $conn): void;

    /**
     * Метод вызывается, когда сервер получает сообщение от клиента.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param MessageInterface $msg Объект сообщения WebSocket.
     *
     * @return void
     */
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg): void;

    /**
     * Метод вызывается, когда происходит ошибка в соединении.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param \Exception $e Исключение, описывающее ошибку.
     *
     * @return void
     */
    public function onError(ConnectionInterface $conn, \Exception $e): void;
}
