<?php

namespace App\DTO;

class OrderDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $productId,
        public readonly int $quantity,
        public readonly float $totalPrice,
        public readonly string $createdAt
    ) {}
} 