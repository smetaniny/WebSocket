<?php

namespace App\WebSocket\Monitoring\Contracts;

/**
 * Интерфейс для отображения информации о состоянии системы.
 */
interface DashboardInterface
{
    /**
     * Отображает активные соединения в системе.
     *
     * @return array Массив с данными о текущих активных соединениях.
     */
    public function displayActiveConnections(): array;

    /**
     * Отображает журнал логов системы.
     *
     * @return array Массив с логами системы.
     */
    public function displayLog(): array;
}
