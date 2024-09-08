<?php

namespace App\WebSocket\Core\Contracts;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * Интерфейс для маршрутизации сообщений WebSocket.
 */
interface RouterInterface
{
    /**
     * Получает единственный экземпляр ChannelManager.
     *
     * @return static
     */
    public static function getInstance(): self;

    /**
     * Метод для маршрутизации сообщений.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param MessageInterface $msg Объект сообщения WebSocket.
     *
     * @return void
     */
    public function route(ConnectionInterface $conn, MessageInterface $msg): void;

    /**
     * Метод для обработки подписки клиента на канал.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение с данными подписки.
     *
     * @return void
     */
    public function handleSubscribe(ConnectionInterface $conn, array $data): void;

    /**
     * Метод для обработки отписки клиента от канала.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение с данными отписки.
     *
     * @return void
     */
    public  function handleUnsubscribe(ConnectionInterface $conn, array $data): void;

    /**
     * Метод для обработки сообщений, отправленных в канал.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение с текстом и информацией о канале.
     *
     * @return void
     */
    public function handleMessage(ConnectionInterface $conn, array $data): void;

    /**
     * Метод для обработки неверных или некорректных сообщений.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param string $error Описание ошибки.
     *
     * @return void
     */
    public function handleInvalidMessage(ConnectionInterface $conn, string $error): void;

    /**
     * Метод для получения идентификатора клиента.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return string|null Идентификатор клиента или null, если клиент не найден.
     */
    public function getClientId(ConnectionInterface $conn): ?string;
}
