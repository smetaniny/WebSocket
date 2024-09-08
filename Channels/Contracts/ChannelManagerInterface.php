<?php

namespace App\WebSocket\Channels\Contracts;

namespace App\WebSocket\Channels\Contracts;

/**
 * Interface ChannelManagerInterface
 *
 * Этот интерфейс должен быть реализован классом, который следует паттерну Singleton.
 */
interface ChannelManagerInterface
{
    /**
     * Получает единственный экземпляр ChannelManager.
     *
     * @return static
     */
    public static function getInstance(): self;

    /**
     * Подписывает клиента на канал.
     *
     * @param string $channelName Имя канала.
     * @param string $clientId Идентификатор клиента.
     */
    public function subscribe(string $channelName, string $clientId): void;

    /**
     * Отписывает клиента от канала.
     *
     * @param string $channelName Имя канала.
     * @param string $clientId Идентификатор клиента.
     */
    public function unsubscribe(string $channelName, string $clientId): void;

    /**
     * Отправляет сообщение всем подписчикам канала.
     *
     * @param string $channelName Имя канала.
     * @param string $message Сообщение для рассылки.
     */
    public function broadcast(string $channelName, string $message): void;
}
