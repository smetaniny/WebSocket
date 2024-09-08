<?php

namespace App\WebSocket\Clients;

use Ratchet\ConnectionInterface;
use App\WebSocket\Clients\Contracts\ClientManagerInterface;

/**
 * Класс для управления клиентами, подключенными через WebSocket.
 *
 * Этот класс управляет подключениями клиентов, позволяя добавлять, удалять и получать информацию о подключенных клиентах.
 *
 * @package App\WebSocket\Clients
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ClientManager implements ClientManagerInterface
{
    /**
     * Массив, хранящий клиентов с их идентификаторами и соединениями.
     *
     * @var Client[] Массив объектов клиентов, ключами являются уникальные идентификаторы клиентов.
     */
    public array $clients = [];

    /**
     * Добавляет клиента в менеджер.
     *
     * Этот метод создает новый объект клиента и добавляет его в массив клиентов.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @param ConnectionInterface $connection Объект соединения клиента.
     *
     * @return void
     */
    public function addClient(string $clientId, ConnectionInterface $connection): void
    {
        $this->clients[$clientId] = new Client($clientId, $connection);
    }

    /**
     * Удаляет клиента из менеджера.
     *
     * Этот метод удаляет клиента из массива клиентов по его уникальному идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     *
     * @return void
     */
    public function removeClient(string $clientId): void
    {
        unset($this->clients[$clientId]);
    }

    /**
     * Возвращает объект соединения клиента по его идентификатору.
     *
     * Этот метод возвращает объект соединения клиента, если клиент найден, иначе возвращает null.
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
     * Этот метод возвращает массив объектов соединений всех клиентов, управляемых менеджером.
     *
     * @return ConnectionInterface[] Массив объектов соединений всех клиентов.
     */
    public function getClients(): array
    {
        return array_map(function (Client $client) {
            return $client->getConnection();
        }, $this->clients);
    }
}
