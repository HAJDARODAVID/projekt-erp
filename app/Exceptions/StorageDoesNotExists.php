<?php

namespace App\Exceptions;

use Exception;

class StorageDoesNotExists extends Exception
{
    public function __construct($arg = []){
        $this->message = "Storage: ".$arg['str']." does not exists!";
    }
}
