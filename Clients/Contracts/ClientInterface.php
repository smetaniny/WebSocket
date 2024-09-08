<?php

namespace App\WebSocket\Clients\Contracts;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для клиента, представляющего подключение WebSocket.
 *
 * Этот интерфейс определяет методы для получения уникального идентификатора клиента и его соединения.
 *
 * @package App\WebSocket\Clients\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface ClientInterface
{
    /**
     * Возвращает уникальный идентификатор клиента.
     *
     * Этот метод возвращает уникальный идентификатор, связанный с конкретным клиентом WebSocket.
     *
     * @return string Уникальный идентификатор клиента.
     */
    public function getId(): string;

    /**
     * Возвращает объект соединения клиента.
     *
     * Этот метод возвращает объект соединения WebSocket, связанный с клиентом.
     *
     * @return ConnectionInterface Объект соединения клиента.
     */
    public function getConnection(): ConnectionInterface;
}
