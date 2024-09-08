<?php

namespace App\WebSocket\Security\Contracts;

/**
 * Интерфейс для аутентификации пользователей по токену.
 *
 * Этот интерфейс определяет метод для проверки подлинности токена, который используется
 * для авторизации пользователей в системе WebSocket.
 *
 * @package App\WebSocket\Security\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
interface AuthenticatorInterface
{
    /**
     * Аутентифицирует пользователя по предоставленному токену.
     *
     * Проверяет, действителен ли указанный токен и предоставляет результат проверки.
     *
     * @param string $token Токен для аутентификации пользователя.
     * @return bool Возвращает true, если токен действителен и аутентификация прошла успешно, иначе false.
     */
    public function authenticate(string $token): bool;
}
