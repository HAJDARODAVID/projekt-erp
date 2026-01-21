<?php

namespace App\Exceptions;

use Exception;

class ArraySearchTraitException extends Exception
{
    public function __construct($msg)
    {
        $this->message = $msg;
    }

    public static function propertyNotSet($property, $class = NULL)
    {
        return new self("Search property:[" . $property . "] not defined in class. \n" . $class);
    }

    public static function searchKeyNotExists($key, $class = NULL)
    {
        return new self("The given key:[" . $key . "]. does not exists on the property. \n" . $class);
    }
}
