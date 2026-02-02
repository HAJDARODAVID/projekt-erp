<?php

namespace App\Services;

class BaseDTO
{
    /**
     * Get all the properties in a array
     * 
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
