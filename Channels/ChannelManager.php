<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelManagerInterface;

/**
 * Менеджер каналов для управления подпиской клиентов и отправкой сообщений.
 *
 * @package App\WebSocket\Channels
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ChannelManager implements ChannelManagerInterface
{
    /**
     * Массив для хранения каналов.
     *
     * @var array
     */
    protected array $channels = [];

    /**
     * Подписывает клиента на канал.
     *
     * @param string $channelName Имя канала.
     * @param string $clientId Идентификатор клиента.
     *
     * @return void
     */
    public function subscribe(string $channelName, string $clientId): void
    {
        // Если канал не существует, создаем его
        if (!isset($this->channels[$channelName])) {
            $this->channels[$channelName] = new Channel();
        }

        // Подписываем клиента на канал
        $this->channels[$channelName]->subscribe($clientId);
    }

    /**
     * Отписывает клиента от канала.
     *
     * @param string $channelName Имя канала.
     * @param string $clientId Идентификатор клиента.
     *
     * @return void
     */
    public function unsubscribe(string $channelName, string $clientId): void
    {
        // Если канал существует, отписываем клиента
        if (isset($this->channels[$channelName])) {
            $this->channels[$channelName]->unsubscribe($clientId);
        }
    }

    /**
     * Отправляет сообщение всем подписчикам канала.
     *
     * @param string $channelName Имя канала.
     * @param string $message Сообщение для рассылки.
     *
     * @return void
     */
    public function broadcast(string $channelName, string $message): void
    {
        // Если канал существует, рассылаем сообщение
        if (isset($this->channels[$channelName])) {
            $this->channels[$channelName]->broadcast($message);
        }
    }
}
