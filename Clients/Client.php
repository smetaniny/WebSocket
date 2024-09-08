<?php

namespace App\WebSocket\Clients;

use Ratchet\ConnectionInterface;
use App\WebSocket\Clients\Contracts\ClientInterface;

/**
 * Класс, представляющий клиента с уникальным идентификатором и соединением.
 */
class Client implements ClientInterface
{
    /**
     * @var string Уникальный идентификатор клиента.
     */
    protected string $id;

    /**
     * @var ConnectionInterface Объект соединения клиента.
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
     * @return string Идентификатор клиента.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Возвращает объект соединения клиента.
     *
     * @return ConnectionInterface Объект соединения клиента.
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}
