<?php

namespace App\WebSocket\Broadcasting\Contracts;

/**
 * Интерфейс для класса, который отвечает за вещание сообщений.
 */
interface BroadcasterInterface
{
    /**
     * Вещает сообщение на указанный канал.
     *
     * @param string $channelName Имя канала.
     * @param string $message Сообщение для отправки.
     */
    public function broadcastToChannel(string $channelName, string $message): void;

    /**
     * Вещает сообщение всем подписчикам.
     *
     * @param string $message Сообщение для отправки.
     */
    public function broadcastToAll(string $message): void;
}
