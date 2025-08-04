<?php

namespace App\Traits;

trait Singleton
{
    private static $instance = null;

    private function __construct() {}

    /**
     * Gets the single instance of the class.
     *
     */
    public static function getInstance()
    {
        // Check if the instance has been created.
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Checks if an instance of the class has already been created.
     *
     * @return bool True if an instance exists, false otherwise.
     */
    public static function isCreated(): bool
    {
        return self::$instance !== null;
    }
}
