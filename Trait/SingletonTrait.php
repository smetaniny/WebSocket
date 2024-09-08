<?php

namespace App\WebSocket\Trait;

use App\WebSocket\Channels\ChannelManager;
use App\WebSocket\Clients\ClientManager;
use App\WebSocket\Core\WebSocketRouter;
use App\WebSocket\Errors\ErrorHandler;
use App\WebSocket\Errors\ExceptionLogger;

/**
 * Трейт для реализации паттерна Singleton. Singleton гарантирует, что у класса будет только один экземпляр в течение
 * выполнения программы.
 */
trait SingletonTrait
{
    // Свойство для хранения единственного экземпляра класса.
    // Используем ?self, что означает, что оно может быть экземпляром класса или null.
    private static ?self $instance = null;

    /**
     * Метод для получения единственного экземпляра класса.
     * Если экземпляра еще нет (null), создается новый.
     * Если экземпляр уже существует, возвращается существующий.
     *
     * @return ExceptionLogger|ChannelManager|ClientManager|WebSocketRouter|ErrorHandler|SingletonTrait Единственный
     *     экземпляр класса.
     */
    public static function getInstance(): self
    {
        // Проверяем, был ли уже создан экземпляр класса.
        if (self::$instance === null) {
            // Если экземпляра еще нет, создаем новый.
            self::$instance = new self();
        }
        // Возвращаем единственный экземпляр.
        return self::$instance;
    }

    // Приватный конструктор предотвращает создание нового экземпляра класса извне.
    // Это необходимо для соблюдения паттерна Singleton.
    private function __construct()
    {
    }

    // Приватный метод __clone() запрещает клонирование объекта.
    // Это важно для того, чтобы избежать создания дубликатов объекта.
    private function __clone()
    {
    }
}
