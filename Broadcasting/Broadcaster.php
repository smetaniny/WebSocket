<?php

namespace App\WebSocket\Broadcasting;

use App\WebSocket\Broadcasting\Contracts\BroadcasterInterface;

/**
 * Класс, реализующий вещание сообщений.
 *
 * @package App\WebSocket\Broadcasting
 * @author Smetanin Sergey
 * @see \App\WebSocket\Broadcasting\Contracts\BroadcasterInterface
 * @version 1.0.0
 * @since 1.0.0
 */
class Broadcaster implements BroadcasterInterface
{
    /**
     * Вещает сообщение на указанный канал.
     *
     * @param string $channelName Имя канала, на который будет отправлено сообщение.
     * @param string $message Сообщение для отправки на указанный канал.
     *
     * @return void
     */
    public function broadcastToChannel(string $channelName, string $message): void
    {
        // Здесь будет логика отправки сообщения на указанный канал.
        // Например, это может быть вызов методов другого класса или отправка через WebSocket.
        echo "Сообщение '{$message}' отправлено на канал '{$channelName}'\n";
    }

    /**
     * Вещает сообщение всем подписчикам.
     *
     * @param string $message Сообщение для отправки всем подписчикам.
     *
     * @return void
     */
    public function broadcastToAll(string $message): void
    {
        // Здесь будет логика отправки сообщения всем подписчикам.
        // Например, это может быть вызов методов другого класса или отправка через WebSocket.
        echo "Сообщение '{$message}' отправлено всем подписчикам\n";
    }
}
