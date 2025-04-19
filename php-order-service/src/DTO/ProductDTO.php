<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly float $price
    ) {}
}