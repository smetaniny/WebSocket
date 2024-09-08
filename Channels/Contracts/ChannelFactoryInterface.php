<?php

namespace App\WebSocket\Channels\Contracts;

use InvalidArgumentException;

/**
 * Интерфейс для фабрики каналов.
 * Определяет метод для создания нового канала по заданному типу.
 *
 * @package App\WebSocket\Channels\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface ChannelFactoryInterface
{
    /**
     * Создает новый канал по заданному типу.
     *
     * В зависимости от типа канала, метод возвращает объект, реализующий интерфейс ChannelInterface.
     *
     * @param string $type Тип канала (например, 'public', 'private', 'presence').
     *
     * @return ChannelInterface Возвращает объект, реализующий интерфейс ChannelInterface.
     *
     * @throws InvalidArgumentException Если тип канала неизвестен.
     */
    public function createChannel(string $type): ChannelInterface;
}
