<?php

namespace App\Traits;

trait MagicStatic
{
    public static function __callStatic($name, $arguments)
    {
        $instance = static::getInstance();
        if (method_exists($instance, $name)) {
            return $instance->$name(...$arguments);
        }
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arguments);
        }
    }
}
