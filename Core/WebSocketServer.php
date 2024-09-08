<?php

namespace App\WebSocket\Core;

use App\WebSocket\Core\Contracts\WebSocketServerInterface;
use App\WebSocket\Facades\ClientManagerFacade;
use App\WebSocket\Facades\ErrorHandlerFacade;
use App\WebSocket\Facades\RedisAdapterFacade;
use App\WebSocket\Facades\RouterFacade;
use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Класс для обработки WebSocket соединений.
 * Реализует интерфейс MessageComponentInterface от Ratchet.
 *
 * @package App\WebSocket\Core
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class WebSocketServer implements MessageComponentInterface, WebSocketServerInterface
{
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
            ClientManagerFacade::addClient($conn->resourceId, $conn);

            // Подготовка данных для сохранения в Redis
            $connectionData = [
                'resourceId' => $conn->resourceId,
                'remoteAddress' => $conn->remoteAddress, // Пример дополнительной информации
                'time' => time()
            ];

            // Сохранение данных в Redis
            RedisAdapterFacade::set('connection:' . $conn->resourceId, json_encode($connectionData));

            $client = ClientManagerFacade::getClient($conn->resourceId);

            // Отправляем сообщение клиенту
            if ($client instanceof ConnectionInterface) {
                $client->send("hello");
                echo "Сообщение отправлено клиенту {$conn->resourceId}\n";
            } else {
                echo "Ошибка: клиент не найден или не является экземпляром ConnectionInterface\n";
            }
        } catch (Exception $e) {
            ErrorHandlerFacade::handle($e);
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
            RouterFacade::route($conn, $msg);
            echo "Сообщение получено: {$msg->getPayload()}\n";
        } catch (Exception $e) {
            ErrorHandlerFacade::handle($e);
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
            ClientManagerFacade::removeClient($conn->resourceId);
        } catch (Exception $e) {
            ErrorHandlerFacade::handle($e);
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
            ErrorHandlerFacade::handle($e);
        } catch (Exception $e) {
            ErrorHandlerFacade::handle($e);
        }
    }
}
