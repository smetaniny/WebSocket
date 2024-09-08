<?php

namespace App\WebSocket\Security\Contracts;

interface AuthenticatorInterface
{
    public function authenticate(string $token): bool;
}
