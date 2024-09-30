<?php

namespace App\Exceptions;

use Exception;

class MaterialNotOnStockException extends Exception
{
    public function __construct($arg = []){
        $this->message = "Material: ".$arg['id']." not on stock!";
    }
}
