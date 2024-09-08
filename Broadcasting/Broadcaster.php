<?php

namespace App\WebSocket\Broadcasting;

use App\WebSocket\Broadcasting\Contracts\BroadcasterInterface;

/**
 * Класс, реализующий вещание сообщений.
 */
class Broadcaster implements BroadcasterInterface
{
    /**
     * Вещает сообщение на указанный канал.
     *
     * @param string $channelName Имя канала.
     * @param string $message Сообщение для отправки.
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
     * @param string $message Сообщение для отправки.
     */
    public function broadcastToAll(string $message): void
    {
        // Здесь будет логика отправки сообщения всем подписчикам.
        // Например, это может быть вызов методов другого класса или отправка через WebSocket.
        echo "Сообщение '{$message}' отправлено всем подписчикам\n";
    }
}
