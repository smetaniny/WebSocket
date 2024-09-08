<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelManagerInterface;
use App\WebSocket\Trait\SingletonTrait;

class ChannelManager implements ChannelManagerInterface
{
    // Трейт для реализации паттерна Singleton.
    use SingletonTrait;

    // Массив для хранения каналов
    protected array $channels = [];

    /**
     * Подписывает клиента на канал.
     *
     * @param string $channelName Имя канала.
     * @param string $clientId Идентификатор клиента.
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
     */
    public function broadcast(string $channelName, string $message): void
    {
        // Если канал существует, рассылаем сообщение
        if (isset($this->channels[$channelName])) {
            $this->channels[$channelName]->broadcast($message);
        }
    }
}
