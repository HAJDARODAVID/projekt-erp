<?php

namespace App\Services\Application;

/**
 * @method void execute()
 */
class DtoService
{
    public function __construct($data = NULL, $dataInputType = 'array')
    {
        if ($dataInputType === 'array' && is_array($data)) $this->addToDtoFromArray($data);

        //Run the execute method if it exists.
        //Add execute():void method to your DTO file as protected, and in it you can do additional data transformation. 
        //This will run after all your properties are set.
        if (method_exists(get_class($this), 'execute')) $this->execute();
    }

    /**
     * Creates the object properties from a array key/value pairs.
     */
    private function addToDtoFromArray($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    /**
     * This will only give you the option to select only specific keys that will be available in the DTO.
     */
    public function select(...$property)
    {

        foreach (get_object_vars($this) as $objProperty => $value) {
            if (!in_array($objProperty, $property)) unset($this->$objProperty);
        }
        dd($this);
        return;
    }

    /**
     * Returns all properties as a array.
     * The properties must be protected or public
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Create a new instance of a object over a static function
     *
     * @return  self
     */
    public static function init()
    {
        return new self;
    }
}
