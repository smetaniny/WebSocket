<?php

namespace App\WebSocket\Security\Contracts;

interface AuthorizerInterface
{
    public function authorize(string $channelName, string $clientId): bool;
}
