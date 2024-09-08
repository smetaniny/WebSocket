<?php

namespace App\WebSocket\Clients;

use Ratchet\ConnectionInterface;
use App\WebSocket\Clients\Contracts\ClientInterface;

/**
 * Класс, представляющий клиента с уникальным идентификатором и соединением.
 *
 * Этот класс используется для хранения информации о клиенте, включая его идентификатор и соединение WebSocket.
 *
 * @package App\WebSocket\Clients
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class Client implements ClientInterface
{
    /**
     * Уникальный идентификатор клиента.
     *
     * @var string
     */
    protected string $id;

    /**
     * Объект соединения клиента.
     *
     * @var ConnectionInterface
     */
    protected ConnectionInterface $connection;

    /**
     * Конструктор.
     *
     * @param string $id Уникальный идентификатор клиента.
     * @param ConnectionInterface $connection Объект соединения клиента.
     */
    public function __construct(string $id, ConnectionInterface $connection)
    {
        $this->id = $id;
        $this->connection = $connection;
    }

    /**
     * Возвращает идентификатор клиента.
     *
     * Этот метод возвращает уникальный идентификатор клиента, который был установлен при создании объекта.
     *
     * @return string Идентификатор клиента.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Возвращает объект соединения клиента.
     *
     * Этот метод возвращает объект соединения WebSocket клиента.
     *
     * @return ConnectionInterface Объект соединения клиента.
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}
