<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public static function internalException()
    {
        return new static("An internal Exception Occurred", 500);
    }
}
