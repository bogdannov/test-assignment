<?php

namespace App\Errors;

use Exception;

class RemoteServiceException extends Exception
{
    public function __construct
    (
        string $message = "Remote service unavailable",
        int $code = 0,
        ?\Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}