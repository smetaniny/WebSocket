<?php

namespace App\WebSocket\Core;

use App\WebSocket\Channels\ChannelManager;
use App\WebSocket\Clients\ClientManager;
use App\WebSocket\Core\Contracts\RouterInterface;
use App\WebSocket\Trait\SingletonTrait;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * Класс для маршрутизации сообщений WebSocket.
 * Реализует паттерн стратегию маршрутизации сообщений.
 */
class WebSocketRouter implements RouterInterface
{
    // Трейт для реализации паттерна Singleton.
    use SingletonTrait;

    protected ChannelManager $channelManager;  // Менеджер каналов
    protected ClientManager $clientManager;    // Менеджер клиентов

    /**
     * Конструктор класса.
     *
     */
    private function __construct()
    {
        $this->channelManager = ChannelManager::getInstance();
        $this->clientManager = ClientManager::getInstance();
    }


    /**
     * Маршрутизация сообщения в зависимости от его типа.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param MessageInterface $msg Объект сообщения WebSocket.
     *
     * @return void
     */
    public function route(ConnectionInterface $conn, MessageInterface $msg): void
    {
        // Декодируем сообщение из формата JSON.
        $data = json_decode($msg->getPayload(), true);

        // Проверяем, есть ли в сообщении тип события.
        if (!isset($data['event'])) {
            $this->handleInvalidMessage($conn, 'Отсутствует тип события в сообщении.');
            return;
        }

        // В зависимости от типа события выполняем соответствующее действие.
        switch ($data['event']) {
            case 'subscribe':
                $this->handleSubscribe($conn, $data);
                break;

            case 'unsubscribe':
                $this->handleUnsubscribe($conn, $data);
                break;

            case 'message':
                $this->handleMessage($conn, $data);
                break;

            default:
                $this->handleInvalidMessage($conn, 'Неизвестное событие: ' . $data['event']);
                break;
        }
    }

    /**
     * Обработка подписки клиента на канал.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение.
     *
     * @return void
     */
    public function handleSubscribe(ConnectionInterface $conn, array $data): void
    {
        // Проверяем, что канал указан в данных.
        if (!isset($data['channel'])) {
            $this->handleInvalidMessage($conn, 'Отсутствует имя канала в данных.');
            return;
        }

        // Проверяем, что клиент идентифицирован.
        $clientId = $this->getClientId($conn);
        if ($clientId === null) {
            $this->handleInvalidMessage($conn, 'Неизвестный клиент.');
            return;
        }

        // Подписываем клиента на указанный канал.
        $channelName = $data['channel'];
        $this->channelManager->subscribe($channelName, $clientId);

        // Логируем успешную подписку.
        echo "Клиент {$clientId} подписан на канал: {$channelName}\n";
    }

    /**
     * Обработка отписки клиента от канала.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение.
     *
     * @return void
     */
    public function handleUnsubscribe(ConnectionInterface $conn, array $data): void
    {
        // Проверяем, что канал указан в данных.
        if (!isset($data['channel'])) {
            $this->handleInvalidMessage($conn, 'Отсутствует имя канала в данных.');
            return;
        }

        // Проверяем, что клиент идентифицирован.
        $clientId = $this->getClientId($conn);
        if ($clientId === null) {
            $this->handleInvalidMessage($conn, 'Неизвестный клиент.');
            return;
        }

        // Отписываем клиента от указанного канала.
        $channelName = $data['channel'];
        $this->channelManager->unsubscribe($channelName, $clientId);

        // Логируем успешную отписку.
        echo "Клиент {$clientId} отписан от канала: {$channelName}\n";
    }

    /**
     * Обработка сообщений, отправленных в канал.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param array $data Декодированное сообщение.
     *
     * @return void
     */
    public function handleMessage(ConnectionInterface $conn, array $data): void
    {
        // Проверяем, что канал и сообщение указаны в данных.
        if (!isset($data['channel']) || !isset($data['message'])) {
            $this->handleInvalidMessage($conn, 'Отсутствуют данные канала или сообщения.');
            return;
        }

        // Логика для отправки сообщения всем подписчикам канала.
        $channelName = $data['channel'];
        $message = $data['message'];
        $this->channelManager->broadcast($channelName, $message);

        // Логируем отправку сообщения.
        echo "Сообщение от клиента {$this->getClientId($conn)} в канал {$channelName}: {$message}\n";
    }

    /**
     * Обработка неверного сообщения.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param string $error Описание ошибки.
     *
     * @return void
     */
    public function handleInvalidMessage(ConnectionInterface $conn, string $error): void
    {
        echo "Ошибка обработки сообщения от клиента {$this->getClientId($conn)}: {$error}\n";
        // Отправляем клиенту сообщение об ошибке.
        $conn->send(json_encode(['error' => $error]));
    }

    /**
     * Получение идентификатора клиента из соединения.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return string|null Идентификатор клиента или null, если не найден.
     */
    public function getClientId(ConnectionInterface $conn): ?string
    {
        // Получаем клиента из менеджера клиентов.
        // Это зависит от реализации вашей системы.
        foreach ($this->clientManager->getClients() as $client) {
            if ($client->getConnection() === $conn) {
                return $client->getId();
            }
        }

        // Клиент не найден.
        return null;
    }
}
