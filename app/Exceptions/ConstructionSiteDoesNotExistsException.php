<?php

namespace App\Exceptions;

use Exception;

class ConstructionSiteDoesNotExistsException extends Exception
{
    public function __construct($arg = []){
        $this->message = "Construction site with id: ".$arg['id']." does not exists!";
    }
}
