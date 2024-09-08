<?php

namespace App\WebSocket\Redis;

use App\WebSocket\Redis\Contracts\RedisInterface;
use Illuminate\Support\Facades\Redis as LaravelRedis;

/**
 * Адаптер для работы с Redis, используя Laravel Redis фасад.
 */
class RedisAdapter implements RedisInterface
{
    /**
     * Публикует сообщение в Redis канал.
     *
     * @param string $channel Имя канала.
     * @param string $message Сообщение для публикации.
     * @return void
     */
    public function publish(string $channel, string $message): void
    {
        LaravelRedis::publish($channel, $message);
    }

    /**
     * Подписывается на Redis канал.
     *
     * @param string $channel Имя канала.
     * @param callable $callback Функция обратного вызова для обработки сообщений.
     * @return void
     */
    public function subscribe(string $channel, callable $callback): void
    {
        LaravelRedis::subscribe([$channel], function ($message) use ($callback) {
            $callback($message);
        });
    }

    /**
     * Устанавливает пару ключ-значение в Redis.
     *
     * @param string $key Ключ для установки.
     * @param string $value Значение для установки.
     * @return void
     */
    public function set(string $key, string $value): void
    {
        LaravelRedis::set($key, $value);
    }

    /**
     * Получает значение по ключу из Redis.
     *
     * @param string $key Ключ для получения значения.
     * @return string|null Возвращает значение или null, если ключ не найден.
     */
    public function get(string $key): ?string
    {
        return LaravelRedis::get($key);
    }

    /**
     * Удаляет ключ из Redis.
     *
     * @param string $key Ключ для удаления.
     * @return void
     */
    public function del(string $key): void
    {
        LaravelRedis::del($key);
    }
}
