<?php

namespace App\WebSocket\Security;

use App\WebSocket\Security\Contracts\AuthorizerInterface;

/**
 *
 * @package App\WebSocket\Security
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
 */
class Authorizer implements AuthorizerInterface
{

    /**
     * Авторизует клиента на доступ к каналу.
     *
     * Проверяет, имеет ли клиент право доступа к указанному каналу.
     *
     * @param string $channelName Имя канала, к которому осуществляется доступ.
     * @param string $clientId Идентификатор клиента.
     * @return bool Возвращает true, если клиент имеет доступ к каналу, иначе false.
     */
    public function authorize(string $channelName, string $clientId): bool
    {
        // Логика проверки прав доступа
        // Пример: проверка прав доступа клиента к каналу в базе данных или с помощью внешнего сервиса
        // Для примера, здесь просто проверяется, что имя канала и идентификатор клиента не пустые
        return !empty($channelName) && !empty($clientId);
    }
}
