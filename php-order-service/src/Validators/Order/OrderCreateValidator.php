<?php

namespace App\Validators\Order;

use App\Errors\ValidationException;
use App\Validators\IValidator;

class OrderCreateValidator implements IValidator
{
    /**
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function validate(array $data): void
    {
        if (!isset($data['productId'], $data['quantity'])) {
            throw new ValidationException("Validation error: productId and quantity are required.");
        }

        $productId = trim((string)$data['productId']);
        $quantity = (int)$data['quantity'];

        if ($productId === '') {
            throw new ValidationException("Validation error: productId must not be empty.");
        }

        if ($quantity <= 0) {
            throw new ValidationException("Validation error: quantity must be a positive number.");
        }
    }
}