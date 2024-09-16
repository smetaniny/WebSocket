<?php

use App\WebSocket\Broadcasting\Private\ChatChannel;
use App\WebSocket\Broadcasting\Public\FaqChannel;

return [
    'routes' => [
        'public' => [
            'faq' => FaqChannel::class, // Вопрос-ответ
        ],
        'private' => [
            'chat' => ChatChannel::class,           // Чат
        ],
    ],
];
