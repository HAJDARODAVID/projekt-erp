<?php

namespace App\Exceptions;

use Exception;

class MustBeArrayException extends Exception
{
    public function __construct(){
        $this->message = "ActionLogs argument must be type array!";
    }
}
