<?php

namespace App\WebSocket\Redis\Contracts;

/**
 * Интерфейс для работы с Redis.
 *
 * @package App\WebSocket\Redis\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface RedisInterface
{
    /**
     * Публикует сообщение в Redis канал.
     *
     * @param string $channel Имя канала.
     * @param string $message Сообщение для публикации.
     * @return void
     */
    public function publish(string $channel, string $message): void;

    /**
     * Подписывается на Redis канал.
     *
     * @param string $channel Имя канала.
     * @param callable $callback Функция обратного вызова для обработки сообщений.
     * @return void
     */
    public function subscribe(string $channel, callable $callback): void;

    /**
     * Устанавливает пару ключ-значение в Redis.
     *
     * @param string $key Ключ для установки.
     * @param string $value Значение для установки.
     * @return void
     */
    public function set(string $key, string $value): void;

    /**
     * Получает значение по ключу из Redis.
     *
     * @param string $key Ключ для получения значения.
     * @return string|null Возвращает значение или null, если ключ не найден.
     */
    public function get(string $key): ?string;

    /**
     * Удаляет ключ из Redis.
     *
     * @param string $key Ключ для удаления.
     * @return void
     */
    public function del(string $key): void;
}
