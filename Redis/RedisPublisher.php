<?php

namespace App\WebSocket\Redis;

use App\WebSocket\Redis\Contracts\RedisInterface;

/**
 * Публикует сообщения в Redis.
 */
class RedisPublisher
{
    private RedisInterface $redis;

    /**
     * Конструктор класса.
     *
     * @param RedisInterface $redis Инстанс Redis интерфейса.
     */
    public function __construct(RedisInterface $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Публикует сообщение в Redis канал.
     *
     * @param string $channel Имя канала.
     * @param string $message Сообщение для публикации.
     * @return void
     */
    public function publish(string $channel, string $message): void
    {
        $this->redis->publish($channel, $message);
    }
}
