<?php

namespace App\WebSocket\Broadcasting;

use App\WebSocket\Broadcasting\Contracts\BroadcasterInterface;

/**
 * Класс модуля вещания, который может использовать различные реализации Broadcaster.
 */
class BroadcastingModule
{
    /**
     * @var BroadcasterInterface Реализация вещателя.
     */
    protected BroadcasterInterface $broadcaster;

    /**
     * Конструктор.
     *
     * @param BroadcasterInterface $broadcaster Реализация вещателя.
     */
    public function __construct(BroadcasterInterface $broadcaster)
    {
        $this->broadcaster = $broadcaster;
    }

    /**
     * Вещает сообщение на указанный канал.
     *
     * @param string $channelName Имя канала.
     * @param string $message Сообщение для отправки.
     */
    public function broadcastToChannel(string $channelName, string $message): void
    {
        $this->broadcaster->broadcastToChannel($channelName, $message);
    }

    /**
     * Вещает сообщение всем подписчикам.
     *
     * @param string $message Сообщение для отправки.
     */
    public function broadcastToAll(string $message): void
    {
        $this->broadcaster->broadcastToAll($message);
    }
}
