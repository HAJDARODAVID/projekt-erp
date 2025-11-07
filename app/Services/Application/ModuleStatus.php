<?php

namespace App\Services\Application;

/**
 * Class ModuleStatus.
 */
class ModuleStatus
{
    const MODULE_STATUS_ACTIVE   = 1;
    const MODULE_STATUS_DISABLED = 0;

    const MODULE_ALLOWED_STATUSES = [
        self::MODULE_STATUS_ACTIVE,
        self::MODULE_STATUS_DISABLED,
    ];

    const MODULE_STATUS_DESCRIPTION = [
        'en' => [
            self::MODULE_STATUS_ACTIVE   => 'Active',
            self::MODULE_STATUS_DISABLED => 'Disabled',
        ],
    ];

    private $status;

    private function __construct($status = NULL)
    {
        $this->status = $status;
    }

    /**
     * Set the object by module status
     * 
     * @return self|void
     */
    public static function setByStatus($status)
    {
        if (in_array($status, self::MODULE_ALLOWED_STATUSES)) return new self($status);
        return;
    }

    /**
     * This will give you the active status
     */
    public static function active()
    {
        return self::MODULE_STATUS_ACTIVE;
    }

    /**
     * This will give you the disabled status
     */
    public static function disabled()
    {
        return self::MODULE_STATUS_DISABLED;
    }

    public function getModuleStatusDesc($lang = 'en')
    {
        return self::MODULE_STATUS_DESCRIPTION[$lang][$this->status];
    }
}
