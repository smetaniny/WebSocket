<?php

namespace App\WebSocket\Security;

use App\WebSocket\Security\Contracts\AuthenticatorInterface;

/**
 *
 * @package App\WebSocket\Security
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class Authenticator implements AuthenticatorInterface
{
    /**
     * Аутентифицирует пользователя на основе токена.
     *
     * Проверяет подлинность токена и возвращает результат аутентификации.
     *
     * @param string $token Токен для аутентификации.
     * @return bool Возвращает true, если токен действителен, иначе false.
     */
    public function authenticate(string $token): bool
    {
        // Логика проверки токена
        // Пример: проверка наличия токена в базе данных или с помощью внешнего сервиса
        // Для примера, здесь просто проверяется, что токен не пустой
        return !empty($token);
    }
}
