<?php

namespace App\Exceptions;

use Exception;

class MovementException extends Exception
{
    public function __construct(){
        $this->message = "Missing or invalid movement type!";
    }
}
