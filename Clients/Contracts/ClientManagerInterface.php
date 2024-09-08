<?php

namespace App\WebSocket\Clients\Contracts;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для менеджера клиентов, управляющего подключениями WebSocket.
 *
 * Этот интерфейс определяет методы для добавления, удаления и получения клиентов, а также для получения всех соединений клиентов.
 *
 * @package App\WebSocket\Clients\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface ClientManagerInterface
{
    /**
     * Добавляет клиента в менеджер.
     *
     * Этот метод создает объект клиента и добавляет его в управление менеджером по уникальному идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @param ConnectionInterface $connection Объект соединения клиента.
     *
     * @return void
     */
    public function addClient(string $clientId, ConnectionInterface $connection): void;

    /**
     * Удаляет клиента из менеджера по его идентификатору.
     *
     * Этот метод удаляет клиента из управления менеджером по его уникальному идентификатору.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     *
     * @return void
     */
    public function removeClient(string $clientId): void;

    /**
     * Возвращает объект соединения клиента по его идентификатору.
     *
     * Этот метод возвращает объект соединения клиента, если клиент найден, иначе возвращает null.
     *
     * @param string $clientId Уникальный идентификатор клиента.
     * @return ConnectionInterface|null Объект соединения клиента или null, если клиент не найден.
     */
    public function getClient(string $clientId): ?ConnectionInterface;

    /**
     * Возвращает массив всех соединений клиентов.
     *
     * Этот метод возвращает массив объектов соединений всех клиентов, управляемых менеджером.
     *
     * @return ConnectionInterface[] Массив объектов соединений всех клиентов.
     */
    public function getClients(): array;
}
