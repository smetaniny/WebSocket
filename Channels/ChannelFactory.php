<?php

namespace App\WebSocket\Channels;

use App\WebSocket\Channels\Contracts\ChannelInterface;
use InvalidArgumentException;

/**
 * Фабрика для создания каналов различного типа.
 *
 * @package App\WebSocket\Channels
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class ChannelFactory
{
    /**
     * Создаёт новый канал на основе заданного типа.
     *
     * @param string $type Тип канала (например, 'public', 'private').
     * @return ChannelInterface Возвращает объект, реализующий интерфейс ChannelInterface.
     * @throws InvalidArgumentException Если тип канала неизвестен.
     */
    public function createChannel(string $type): ChannelInterface
    {
        // Проверяем тип канала и создаём соответствующий объект
        return match ($type) {
            'public' => new PublicChannel(),
            'private' => new PrivateChannel(),
            'presence' => new PresenceChannel(),
            default => throw new InvalidArgumentException("Неизвестный тип канала: $type"),
        };
    }
}
