<?php

namespace App\Exceptions;

class TestException extends CustomException
{
    public static function oopieDaisy(): TestException
    {
        return new self("OppsieDaisy", 403);
    }

    public static function checkError(): TestException
    {
        return new self("An error has occurred", 500);
    }


}
