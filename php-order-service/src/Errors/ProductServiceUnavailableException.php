<?php

namespace App\Errors;

use Exception;

class ProductServiceUnavailableException extends Exception
{
    public function __construct(string $message = "Product service is currently unavailable")
    {
        parent::__construct($message, 503);
    }
}