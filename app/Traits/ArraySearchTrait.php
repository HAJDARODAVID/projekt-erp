<?php

namespace App\Traits;

use App\Exceptions\ArraySearchTraitException;

trait ArraySearchTrait
{
    /**Defines the key in the array where to search */
    protected $arraySearchKey = NULL;

    /**Defines the property where the search value will be stored */
    protected $searchProperty = NULL;

    /**Defines the property that contains the search data */
    protected $arraySearchDataProperty = NULL;

    /**Key that will be added to your array for defining if to show => bool*/
    protected $searchResultKeyName = 'show-array-item-search';

    /**
     * Set the key in the array where to search.
     * Use this method inside the "boot" method.
     * 
     * @param string $key Named key in the array
     * @return $this
     */
    protected function setArraySearchKey(string $key)
    {
        $this->arraySearchKey = $key;
        return $this;
    }

    /**
     * Set the property where the search value.
     * Use this method inside the "boot" method.
     * 
     * @param string $key Named key in the array
     * @return $this
     */
    protected function setSearchProperty(string $property)
    {
        $this->searchProperty = $property;
        return $this;
    }

    /**
     * Set the property where the search will be applied.
     * Use this method inside the "boot" method.
     * 
     * @param string $property Property name.
     * @return $this
     */
    protected function setArraySearchProperty(string $property)
    {
        $this->arraySearchDataProperty = $property;
        return $this;
    }

    /**
     * This will add the $this->searchResultKeyName key to your array.
     * Use this after you set your data so that the key will be applied 
     * and the searching feature will be ready to go.
     * 
     * @return $this
     */
    protected function enableArraySearch()
    {
        $this->showOrHideArrayItems('show');
        return $this;
    }

    /**
     * A method that will go through the array and apply the show or hide action.
     * 
     * @param mixed $searchFor What we will search for.
     * @return void
     */
    protected function searchArray(): void
    {
        try {
            /**Check if the property is set, and exists on the class */
            if (is_null($this->arraySearchDataProperty) || (!property_exists(get_class($this), $this->arraySearchDataProperty))) {
                throw ArraySearchTraitException::propertyNotSet($this->arraySearchDataProperty, get_class($this));
            }
            foreach ($this->{$this->arraySearchDataProperty} as $key => $value) {
                $searchValue = $value;
                if (!is_null($this->arraySearchKey)) {
                    /**Check if the key exists on the $value */
                    if (!isset($value[$this->arraySearchKey])) throw ArraySearchTraitException::searchKeyNotExists($this->arraySearchKey, get_class($this));
                    $searchValue = $value[$this->arraySearchKey];
                }
                if ($this->{$this->searchProperty} != NULL || $this->{$this->searchProperty} != "") {
                    if (str_contains(strtolower($searchValue), strtolower($this->{$this->searchProperty}))) {
                        $this->showThisArrayItem($key);
                    } else {
                        $this->hideThisArrayItem($key);
                    }
                } else {
                    $this->showOrHideArrayItems('show');
                }
            }
        } catch (\Throwable $th) {
            $this->showException($th->getMessage());
        }
        return;
    }

    /**
     * Added or sets the $this->searchResultKeyName key with the value of TRUE to your array.
     * This will indicate that this array item should be show.
     * 
     * @param mixed $arrayKey Key where the action will be applied 
     * @return $this
     */
    protected function showThisArrayItem($arrayKey)
    {
        $this->{$this->arraySearchDataProperty}[$arrayKey][$this->searchResultKeyName] = TRUE;
        return $this;
    }

    /**
     * Added or sets the $this->searchResultKeyName key with the value of FALSE to your array.
     * This will indicate that this array item should be hidden.
     * 
     * @param mixed $arrayKey Key where the action will be applied
     * @return $this
     */
    protected function hideThisArrayItem($arrayKey)
    {
        $this->{$this->arraySearchDataProperty}[$arrayKey][$this->searchResultKeyName] = FALSE;
        return $this;
    }

    /**
     * Action that will show or hide the array item.
     * 
     * @param mixed $action Defines the action that will be done [show, hide]
     * @return $this
     */
    protected function showOrHideArrayItems($action)
    {
        switch ($action) {
            case 'show':
                foreach ($this->{$this->arraySearchDataProperty} as $key => $value) {
                    $this->showThisArrayItem($key);
                }
                break;
            case 'hide':
                foreach ($this->{$this->arraySearchDataProperty} as $key => $value) {
                    $this->hideThisArrayItem($key);
                }
                break;
        }
        return $this;
    }

    /**
     * This will set the property from $this->searchProperty to null 
     */
    public function resetArraySearchInput()
    {
        $this->showOrHideArrayItems('show');
        $this->{$this->searchProperty} = NULL;
        return $this;
    }
}
