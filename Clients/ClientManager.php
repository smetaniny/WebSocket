<?php

namespace App\WebSocket\Clients;

use App\WebSocket\Trait\SingletonTrait;
use Ratchet\ConnectionInterface;
use App\WebSocket\Clients\Contracts\ClientManagerInterface;

/**
 * Класс для управления клиентами, подключенными через WebSocket.
 */
class ClientManager implements ClientManagerInterface
{
    // Трейт для реализации паттерна Singleton.
    use SingletonTrait;

    /**
     * @var array Массив, хранящий клиентов с их идентификаторами и соединениями.
     */
    public array $clients = [];

    /**
     * Добавляет клиента в менеджере.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @param ConnectionInterface $connection Объект соединения клиента.
     */
    public function addClient(string $clientId, ConnectionInterface $connection): void
    {
        $this->clients[$clientId] = new Client($clientId, $connection);
    }

    /**
     * Удаляет клиента из менеджера.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     */
    public function removeClient(string $clientId): void
    {
        unset($this->clients[$clientId]);
    }

    /**
     * Возвращает объект соединения клиента по его идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @return ConnectionInterface|null Объект соединения клиента или null, если клиент не найден.
     */
    public function getClient(string $clientId): ?ConnectionInterface
    {
        return $this->clients[$clientId]->getConnection() ?? null;
    }

    /**
     * Возвращает всех клиентов.
     *
     * @return array Массив объектов соединений всех клиентов.
     */
    public function getClients(): array
    {
        return array_map(function (Client $client) {
            return $client->getConnection();
        }, $this->clients);
    }
}
