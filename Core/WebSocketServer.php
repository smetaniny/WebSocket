<?php

namespace App\WebSocket\Core;

use App\WebSocket\Clients\ClientManager;
use App\WebSocket\Core\Contracts\RouterInterface;
use App\WebSocket\Core\Contracts\WebSocketServerInterface;
use App\WebSocket\Errors\Contracts\ErrorHandlerInterface;
use App\WebSocket\Errors\ErrorHandler;
use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Redis;

/**
 * Класс для обработки WebSocket соединений.
 * Реализует интерфейс MessageComponentInterface от Ratchet.
 */
class WebSocketServer implements MessageComponentInterface, WebSocketServerInterface
{
    private RouterInterface $router;
    private ClientManager $clientManager;
    private Redis $redis;
    private ErrorHandlerInterface $errorHandler;

    /**
     * Конструктор класса, принимает WebSocketRouter и ErrorHandler.
     */
    public function __construct()
    {
        // Инициализация Redis
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);

        // Инициализация других зависимостей
        $this->router = WebSocketRouter::getInstance();
        $this->clientManager = ClientManager::getInstance();
        $this->errorHandler = ErrorHandler::getInstance();
    }

    /**
     * Метод вызывается, когда клиент подключается к серверу.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return void
     */
    public function onOpen(ConnectionInterface $conn): void
    {
        try {
            // Логика обработки нового подключения
            echo "Новое подключение: {$conn->resourceId}\n";

            // Добавление соединения в клиентский менеджер
            $this->clientManager->addClient($conn->resourceId, $conn);

            // Подготовка данных для сохранения в Redis
            $connectionData = [
                'resourceId' => $conn->resourceId,
                'remoteAddress' => $conn->remoteAddress, // Пример дополнительной информации
                'time' => time()
            ];

            // Сохранение данных в Redis
            $this->redis->hSet('connections', $conn->resourceId, json_encode($connectionData));
        } catch (Exception $e) {
            $this->errorHandler->handle($e);
        }
    }

    /**
     * Метод вызывается, когда клиент отправляет сообщение на сервер.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param mixed $msg Сообщение WebSocket.
     *
     * @return void
     */
    public function onMessage(ConnectionInterface $conn, mixed $msg): void
    {
        try {
            // Передаем сообщение в маршрутизатор для обработки
            $this->router->route($conn, $msg);
            echo "Сообщение получено: {$msg->getPayload()}\n";
        } catch (Exception $e) {
            $this->errorHandler->handle($e);
        }
    }

    /**
     * Метод вызывается, когда клиент закрывает соединение.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     *
     * @return void
     */
    public function onClose(ConnectionInterface $conn): void
    {
        try {
            // Логика обработки закрытия соединения
            echo "Соединение закрыто: {$conn->resourceId}\n";
            // Удаление соединения из клиентского менеджера
            $this->clientManager->removeClient($conn->resourceId);
        } catch (Exception $e) {
            $this->errorHandler->handle($e);
        }
    }

    /**
     * Метод вызывается, когда происходит ошибка в соединении.
     *
     * @param ConnectionInterface $conn Объект, представляющий соединение WebSocket.
     * @param Exception $e Исключение, описывающее ошибку.
     *
     * @return void
     */
    public function onError(ConnectionInterface $conn, Exception $e): void
    {
        try {
            // Логика обработки ошибок
            echo "Ошибка: {$e->getMessage()}\n";
            $conn->close();

            // Передача ошибки в обработчик
            $this->errorHandler->handle($e);
        } catch (Exception $e) {
            $this->errorHandler->handle($e);
        }
    }
}
