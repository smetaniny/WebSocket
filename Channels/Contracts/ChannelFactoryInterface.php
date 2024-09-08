<?php

namespace App\WebSocket\Channels\Contracts;

interface ChannelFactoryInterface
{
    /**
     * Создает новый канал по заданному типу.
     *
     * @param string $type Тип канала.
     * @return ChannelInterface
     */
    public function createChannel(string $type): ChannelInterface;
}
