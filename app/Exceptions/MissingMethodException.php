<?php

namespace App\Exceptions;

use Exception;

class MissingMethodException extends Exception
{
    public function __construct($method = NULL){
        $this->message = 'Method ' . $method . ' is not defined!';
    }
}
