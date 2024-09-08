<?php

namespace App\WebSocket\Broadcasting\Contracts;

/**
 * Интерфейс для Broadcaster, который управляет рассылкой сообщений по каналам WebSocket.
 * Определяет общие методы для отправки сообщений на конкретные каналы и для широковещательной рассылки.
 *
 * @package App\WebSocket\Broadcasting\Contracts
 * @author Smetanin Sergey
 * @see \App\WebSocket\Broadcasting\Broadcaster
 * @version 1.0.0
 * @since 1.0.0
 */
interface BroadcasterInterface
{
    /**
     * Вещает сообщение на указанный канал.
     * Используйте этот метод для отправки сообщений на конкретный канал.
     *
     * @param string $channelName Имя канала, на который будет отправлено сообщение.
     * Это идентификатор, по которому клиенты будут подписываться на события.
     * @param string $message Текст сообщения, которое будет отправлено подписчикам канала.
     *
     * @return void
     */
    public function broadcastToChannel(string $channelName, string $message): void;

    /**
     * Вещает сообщение всем подключенным подписчикам.
     * Используйте этот метод для отправки сообщений, которые должны быть получены всеми пользователями,
     * независимо от их подписки на определённый канал.
     *
     * @param string $message Текст сообщения для рассылки всем подключенным пользователям.
     *
     * @return void
     */
    public function broadcastToAll(string $message): void;
}
