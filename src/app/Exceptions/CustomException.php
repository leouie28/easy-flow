<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public static function authError($message = "Invalid Credentials")
    {
        return new self($message, 401);
    }
}
