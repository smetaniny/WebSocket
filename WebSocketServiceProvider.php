<?php

namespace App\WebSocket;

use App\WebSocket\Channels\ChannelManager;
use App\WebSocket\Clients\ClientManager;
use App\WebSocket\Errors\ErrorHandler;
use App\WebSocket\Errors\ExceptionLogger;
use App\WebSocket\Redis\RedisAdapter;
use App\WebSocket\Router\WebSocketRouter;
use Illuminate\Support\ServiceProvider;

class WebSocketServiceProvider extends ServiceProvider
{
    /**
     * Регистрирует сервисы в контейнере приложения.
     */
    public function register(): void
    {
        // Регистрируем WebSocketRouter
        $this->app->singleton('websocket.router', function ($app) {
            return new WebSocketRouter();
        });

        // Регистрируем ClientManager
        $this->app->singleton('websocket.clientManager', function ($app) {
            return new ClientManager();
        });

        // Регистрируем ErrorHandler
        $this->app->singleton('websocket.errorHandler', function ($app) {
            return new ErrorHandler();
        });

        // Регистрируем ChannelManager
        $this->app->singleton('websocket.channelManager', function ($app) {
            return new ChannelManager();
        });

        // Регистрируем RedisAdapter
        $this->app->singleton('websocket.redisAdapter', function ($app) {
            return new RedisAdapter();
        });

        // Регистрируем ExceptionLogger
        $this->app->singleton('websocket.exceptionLogger', function ($app) {
            return new ExceptionLogger();
        });
    }

    /**
     * Выполняет загрузку любых сервисов приложения.
     */
    public function boot(): void
    {
        // Здесь можно выполнить дополнительные действия при загрузке
    }
}
