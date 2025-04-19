<?php

namespace App\Repositories;

use App\DTO\OrderDTO;

interface IOrderRepository
{
    /**
     * @param OrderDTO $order
     * @return void
     */
    public function save(OrderDTO $order): void;
    /**
     * @return OrderDTO[]
     */
    public function getAll(): array;
}