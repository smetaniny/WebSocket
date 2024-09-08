<?php

namespace App\WebSocket\Monitoring\Contracts;

/**
 * Интерфейс для отображения информации о состоянии системы.
 *
 * @package App\WebSocket\Monitoring\Contracts
 * @author Smetanin Sergey
 * @version 1.0.0
 * @since 1.0.0
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
