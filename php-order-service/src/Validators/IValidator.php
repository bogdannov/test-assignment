<?php

namespace App\Validators;

use App\Error\ValidationException;

interface IValidator
{
    /**
     * @param array $data
     * @return void
     */
    public function validate(array $data): void;
}