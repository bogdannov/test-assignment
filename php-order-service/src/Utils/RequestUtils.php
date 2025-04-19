<?php

namespace App\Utils;

use App\Errors\ValidationException;

class RequestUtils
{
    /**
     * @param string $raw
     * @return array
     * @throws ValidationException
     */
    public static function parse(string $raw): array
    {
        $data = json_decode($raw, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            throw new ValidationException("Validation error: Invalid JSON payload.");
        }

        return $data;
    }
}