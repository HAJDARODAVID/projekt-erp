<?php

namespace App\Exceptions;

use Exception;

class MovementDoesNotExists extends Exception
{
    public function __construct($arg = []){
        $this->message = "Movement: ".$arg['mvt']." does not exists!";
    }
}
