<?php

namespace App\Exceptions;

use Exception;

class MaterialDoesNotExistsException extends Exception
{
    public function __construct($arg = []){
        $this->message = "Material: ".$arg['id']." does not exists!";
    }
}
