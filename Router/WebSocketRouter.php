<?php

namespace App\WebSocket\Router;

use App\WebSocket\Channels\ChannelManager;
use App\WebSocket\Core\Contracts\RouterInterface;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * WebSocketRouter для системы интернет-магазина с уведомлениями, чатом и обновлениями в реальном времени.
 * Реализует стратегию маршрутизации для обработки различных типов сообщений.
 *
 * @package App\WebSocket\Core
 * @version 1.1.0
 * @since 1.0.0
 */
class WebSocketRouter implements RouterInterface
{
    /**
     * Маршрутизация входящих WebSocket-сообщений на основе их типа события.
     *
     * @param ConnectionInterface $conn Объект подключения WebSocket.
     * @param MessageInterface $msg Объект сообщения WebSocket.
     *
     * @return void
     */
    public function route(ConnectionInterface $conn, MessageInterface $msg): void
    {
        $channelManager = new ChannelManager();

        // Выводим полученное сообщение в консоль для отладки.
        echo "WebSocketRouter route: {$msg}\n";

        // Декодируем сообщение в формате JSON для получения массива данных.
        $data = json_decode($msg->getPayload(), true);

        // Маршрутизируем сообщение на основе типа события.
        switch ($data['event']) {
            case 'subscribe':
                // Обработка подписки на канал.
                $channelManager->subscribe($conn, $data);
                break;

            case 'unsubscribe':
                // Обработка отписки от канала.
                $channelManager->unsubscribe($conn, $data);
                break;

            default:

                break;
        }
    }
}
