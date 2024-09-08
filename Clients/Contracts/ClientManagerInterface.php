<?php

namespace App\WebSocket\Clients\Contracts;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для менеджера клиентов, управляющего подключениями WebSocket.
 */
interface ClientManagerInterface
{
    /**
     * Получает единственный экземпляр ChannelManager.
     *
     * @return static
     */
    public static function getInstance(): self;

    /**
     * Добавляет клиента в менеджер.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @param ConnectionInterface $connection Объект соединения клиента.
     */
    public function addClient(string $clientId, ConnectionInterface $connection): void;

    /**
     * Удаляет клиента из менеджера по его идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     */
    public function removeClient(string $clientId): void;

    /**
     * Возвращает объект соединения клиента по его идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @return ConnectionInterface|null Объект соединения клиента или null, если клиент не найден.
     */
    public function getClient(string $clientId): ?ConnectionInterface;

    /**
     * Возвращает массив всех соединений клиентов.
     *
     * @return array Массив объектов соединений всех клиентов.
     */
    public function getClients(): array;
}
