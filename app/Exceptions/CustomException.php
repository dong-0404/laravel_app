<?php

namespace App\Exceptions;

use Exception;
<<<<<<< HEAD
=======
class CustomException extends Exception
{
>>>>>>> 5b6bf8e (sửa lại những code bị xoá)

class CustomException extends Exception
{
    public static function internalException()
    {
        return new static("An internal Exception Occurred", 500);
    }
}
