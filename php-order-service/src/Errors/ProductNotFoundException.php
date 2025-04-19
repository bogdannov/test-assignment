<?php

namespace App\Errors;

use Exception;

class ProductNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Product not found", 404);
    }
}