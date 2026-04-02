<?php

namespace App\Exceptions;

use Exception;

class ErrorMessage extends Exception
{
    public function __construct($msg)
    {
        $this->message = $msg;
    }
}
