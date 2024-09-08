<?php

namespace App\WebSocket\Channels\Contracts;

/**
 * Интерфейс для управления каналами подписки и рассылки сообщений.
 * Определяет методы для подписки клиентов на каналы, их отписки и рассылки сообщений.
 *
 * @package App\WebSocket\Channels\Contracts
 * @author Smetanin Sergey
 * @see \App\WebSocket\Channels\ChannelManager
 * @version 1.0.0
 * @since 1.0.0
 */
interface ChannelManagerInterface
{
    /**
     * Подписывает клиента на канал.
     *
     * @param string $channelName Имя канала, на который клиент подписывается.
     * @param string $clientId Идентификатор клиента, который будет подписан на канал.
     *
     * @return void
     */
    public function subscribe(string $channelName, string $clientId): void;

    /**
     * Отписывает клиента от канала.
     *
     * @param string $channelName Имя канала, от которого клиент отписывается.
     * @param string $clientId Идентификатор клиента, который будет отписан от канала.
     *
     * @return void
     */
    public function unsubscribe(string $channelName, string $clientId): void;

    /**
     * Отправляет сообщение всем подписчикам канала.
     *
     * @param string $channelName Имя канала, где будет произведена рассылка.
     * @param string $message Сообщение, которое будет отправлено всем подписчикам.
     *
     * @return void
     */
    public function broadcast(string $channelName, string $message): void;
}
