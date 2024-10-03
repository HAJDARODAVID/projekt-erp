<?php

namespace App\Exceptions;

use Exception;

class InvalidCooperatorException extends Exception
{
    public function __construct($arg = NULL){
        $this->message = "Co-operator ID:".$arg." does not exists!";
    }
}
