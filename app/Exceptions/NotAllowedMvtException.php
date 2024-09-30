<?php

namespace App\Exceptions;

use Exception;

class NotAllowedMvtException extends Exception
{
    public function __construct($arg = []){
        $this->message = "Movement: ".$arg['mvt']." not allowed in ".$arg['class'];
    }
}
