<?php

namespace App\Repositories;

use App\DTO\OrderDTO;

class InMemoryOrderRepository implements IOrderRepository
{
    /**
     * @var OrderDTO[]
     */
    protected array $orders = [];

    public function __construct()
    {
        // This is just a sample order for demonstration purposes
        $this->orders[] = new OrderDTO(
            id: 'sample-order-id',
            productId: 'sample-product-id',
            quantity: 1,
            totalPrice: 100.0,
            createdAt: (new \DateTimeImmutable())->format(DATE_ATOM)
        );
    }

    public function save(OrderDTO $order): void
    {
        $this->orders[] = $order;
    }
    /**
     * @return OrderDTO[]
     */
    public function getAll(): array
    {
        return $this->orders;
    }
}