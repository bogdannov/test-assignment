<?php

namespace App\Validators;

use App\Validators\Order\OrderCreateValidator;
use InvalidArgumentException;

class ValidatorFactory
{
    private static array $validators = [
        'order.create' => OrderCreateValidator::class,
    ];
    /**
     * @param string $validatorName
     * @return IValidator
     */
    public static function create(string $validatorName): IValidator
    {
        if (!array_key_exists($validatorName, self::$validators)) {
            throw new InvalidArgumentException("Validator not found: $validatorName");
        }

        $validatorClass = self::$validators[$validatorName];
        return new $validatorClass();
    }
}