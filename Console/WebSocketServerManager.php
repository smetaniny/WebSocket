<?php

namespace App\WebSocket\Console;

use Exception;
use Illuminate\Support\Facades\Log;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use App\WebSocket\Core\WebSocketServer;

// Объявляем класс WebSocketServerManager, который будет управлять нашим WebSocket сервером
class WebSocketServerManager
{
    // Переменная для хранения пути к PID файлу
    private string $pidFile;

    // Переменная для хранения порта, на котором будет запущен сервер
    private int $port;

    // Конструктор класса, который инициализирует переменные
    public function __construct()
    {
        // Определяем путь к PID файлу, который будет хранить идентификатор процесса
        $this->pidFile = storage_path('app/websocket_server.pid');

        // Определяем порт, на котором будет запущен сервер; если в .env файле не указан, используется порт 6001
        $this->port = env('WEBSOCKET_PORT', 6001);
    }

    // Метод для запуска сервера
        public function start(): void
    {
        // Проверяем, запущен ли сервер уже (смотрим, существует ли PID файл)
        $this->checkPidFile();
        try {
            // Создаем WebSocket сервер с помощью фабрики IoServer
            $server = IoServer::factory(
                new HttpServer( // Создаем HTTP сервер
                    new WsServer( // Создаем WebSocket сервер
                        new WebSocketServer() // Наш основной класс сервера
                    )
                ),
                $this->port // Указываем порт для сервера
            );

            // Создаем PID файл, чтобы знать, что сервер запущен
            $this->createPidFile();

            // Выводим сообщение о том, что сервер запущен
            echo "WebSocket сервер запущен на порту {$this->port}....\n";

            // Запускаем сервер в работу
            $server->run();
        } catch (Exception $e) {
            // Ловим возможные ошибки при запуске и логируем их
            Log::channel('websocket')->error('Ошибка при запуске WebSocket сервера: ' . $e->getMessage());
        }
    }

    // Метод для остановки сервера
    public function stop(): void
    {
        // Проверяем, существует ли PID файл (значит, сервер запущен)
        if (file_exists($this->pidFile)) {
            // Читаем PID из файла
            $pid = file_get_contents($this->pidFile);

            // Проверяем, выполняется ли код на Windows
            if ($this->isWindows()) {
                // Если да, то используем команду taskkill для завершения процесса
                exec("taskkill /F /PID $pid", $output, $result);
            } else {
                // Если нет, используем команду kill для завершения процесса на Unix-подобной ОС
                $result = exec("kill -9 $pid", $output);
            }

            // Проверяем, завершился ли процесс успешно
            if ($result == 0) {
                // Удаляем PID файл
                unlink($this->pidFile);
                // Выводим сообщение, что сервер остановлен
                echo "WebSocket сервер с PID {$pid} остановлен.\n";
            } else {
                // Если не удалось остановить процесс, логируем ошибку
                Log::channel('websocket')->error("Не удалось остановить процесс WebSocket сервера с PID {$pid}.");
            }
        } else {
            // Если PID файл не найден, логируем ошибку (сервер, возможно, не запущен)
            Log::channel('websocket')->error('PID файл не найден. Возможно, сервер не запущен.');
        }
    }

    // Метод для перезапуска сервера
    public function restart(): void
    {
        // Сначала останавливаем сервер
        $this->stop();
        // Затем запускаем его заново
        $this->start();
        // Выводим сообщение о перезапуске
        echo "WebSocket сервер перезапущен.\n";
    }

    // Метод для проверки, запущен ли сервер (существует ли валидный PID файл)
    private function checkPidFile(): void
    {
        // Проверяем, существует ли PID файл
        if (file_exists($this->pidFile)) {
            // Читаем PID из файла
            $pid = file_get_contents($this->pidFile);

            // Проверяем, на какой ОС работает сервер
            if ($this->isWindows()) {
                // Если на Windows, используем команду tasklist для проверки, работает ли процесс с данным PID
                $output = [];
                exec("tasklist /FI \"PID eq $pid\"", $output);
                // Если процесс найден, значит сервер запущен
                $isRunning = count($output) > 1;
            } else {
                // Если не на Windows, используем posix_getsid для проверки существования процесса на Unix-подобной ОС
                $isRunning = posix_getsid((int)$pid);
            }

            // Если сервер уже запущен, выбрасываем исключение, чтобы предотвратить повторный запуск
            if ($isRunning) {
                throw new \RuntimeException('WebSocket сервер уже запущен с PID ' . $pid . '.');
            } else {
                // Если процесс не найден, удаляем старый PID файл
                unlink($this->pidFile);
                echo "Обнаружен и удален старый PID файл.\n";
            }
        }
    }

    // Метод для создания PID файла
    private function createPidFile(): void
    {
        // Получаем PID текущего процесса
        $pid = getmypid();
        // Записываем PID в файл
        file_put_contents($this->pidFile, $pid);
        // Выводим сообщение о создании PID файла
        echo "Создан PID файл с идентификатором процесса {$pid}.\n";
    }

    // Метод для проверки, работает ли сервер на Windows
    private function isWindows(): bool
    {
        // Проверяем первые три символа строки PHP_OS, которые содержат название ОС
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}
