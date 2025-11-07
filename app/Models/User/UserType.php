<?php

namespace App\Models\User;

class UserType
{
    private $type;

    const USER_TYPE_MANAGER      = 'MGR';
    const USER_TYPE_ADMIN_STAFF  = 'ADM';
    const USER_TYPE_GROUP_LEADER = 'GRL';
    const USER_TYPE_SUPER_ADMIN  = 'S-ADM';
    const USER_TYPE_COOPERATOR   = 'COP';
    const USER_TYPE_WORKER       = 'WRK';

    const AVAILABLE_TYPES = [
        self::USER_TYPE_MANAGER      => 'Manager',
        self::USER_TYPE_ADMIN_STAFF  => 'Administration staff',
        self::USER_TYPE_GROUP_LEADER => 'Group leader',
        self::USER_TYPE_SUPER_ADMIN  => 'Super admin',
        self::USER_TYPE_COOPERATOR   => 'Cooperator',
        self::USER_TYPE_WORKER       => 'Worker',
    ];

    /**
     * Set here the default user type.
     * This will be used by creating a new user or in forms
     */
    const DEFAULT = self::USER_TYPE_GROUP_LEADER;

    /** Array of types that should be excluded from other */
    private $excludedTypes = [self::USER_TYPE_SUPER_ADMIN];

    /** Array of types that can be assigned by the ADM staff */
    private $assignable = [self::USER_TYPE_ADMIN_STAFF, self::USER_TYPE_GROUP_LEADER, self::USER_TYPE_COOPERATOR, self::USER_TYPE_WORKER];

    private function __construct($type)
    {
        if (key_exists($type, self::AVAILABLE_TYPES)) $this->type = $type;
    }

    /**
     * Create a new empty instance
     * 
     * @return self
     */
    public static function init()
    {
        return new self(NULL);
    }

    /**
     * Set a new instance from a worker type
     * 
     * @param string $type Passthru the worker type
     * @return self
     */
    public static function setByType(string $type)
    {
        return new self($type);
    }

    /**
     * Set a new instance for worker type
     * 
     * @return self
     */
    public static function setTypeWorker()
    {
        return new self(self::USER_TYPE_WORKER);
    }

    /**
     * Set a new instance for groupe leader type
     * 
     * @return self
     */
    public static function setTypeGroupLeader()
    {
        return new self(self::USER_TYPE_GROUP_LEADER);
    }

    /**
     * Set a new instance for administration type
     * 
     * @return self
     */
    public static function setTypeAdministration()
    {
        return new self(self::USER_TYPE_ADMIN_STAFF);
    }

    /**
     * Set a new instance for manager type
     * 
     * @return self
     */
    public static function setTypeManager()
    {
        return new self(self::USER_TYPE_MANAGER);
    }

    /**
     * Set a new instance for super admin type
     * 
     * @return self
     */
    public static function setTypeSuperAdmin()
    {
        return new self(self::USER_TYPE_SUPER_ADMIN);
    }

    /**
     * Get the type description
     * 
     * @return string
     */
    public function description()
    {
        return self::AVAILABLE_TYPES[$this->type];
    }

    /**
     * Get the all the employee type
     * 
     * @return array
     */
    public function getAllType($exclude = TRUE)
    {
        $output = self::AVAILABLE_TYPES;
        if ($exclude) {
            foreach ($this->excludedTypes as $type) {
                unset($output[$type]);
            }
        }
        return array_keys($output);
    }

    public function getAssignableTypes($lang = 'en')
    {
        $output = [];
        foreach ($this->assignable as $type) {
            $output[$type] = translator(self::AVAILABLE_TYPES[$type], $lang);
        }
        asort($output);
        return $output;
    }
}
