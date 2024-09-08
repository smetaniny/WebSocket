<?php

namespace App\WebSocket\Clients\Contracts;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для клиента, представляющего подключение WebSocket.
 */
interface ClientInterface
{
    /**
     * Возвращает уникальный идентификатор клиента.
     *
     * @return string Уникальный идентификатор клиента.
     */
    public function getId(): string;

    /**
     * Возвращает объект соединения клиента.
     *
     * @return ConnectionInterface Объект соединения клиента.
     */
    public function getConnection(): ConnectionInterface;
}
