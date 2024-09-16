<?php

namespace App\Exceptions;

use Exception;

class MissingArgumentException extends Exception
{
    public function __construct($arg = NULL){
        $this->message = "Argument: $".$arg." must be set!";
    }
}
