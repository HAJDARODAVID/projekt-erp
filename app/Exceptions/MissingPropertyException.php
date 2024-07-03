<?php

namespace App\Exceptions;

use Exception;

class MissingPropertyException extends Exception
{
    public function __construct($property = NULL){
        $this->message = 'Property ' . $property . ' is not defined!';
    }
}
