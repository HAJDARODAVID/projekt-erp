<?php

namespace App\Traits;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use App\Services\Application\ConvertArrayTo2D;

trait ValidationTrait
{

    /**
     * Store all the defined rules for validation
     */
    protected $validation_rules = [];

    /**
     * When the validation starts, here will be all the attributes pass from wherever
     */
    protected $validationAttributes = [];

    /**
     * Store all attribute errors
     */
    protected $validationErrors = [];

    /**
     * Add a rule for single data set.
     */
    protected function addValidationRule(string $name, string $rule)
    {
        $this->validation_rules[$name] = $rule;
        return $this;
    }

    /**
     * Add rules for validation
     */
    protected function addValidationAttributeRules(array $rules)
    {
        $this->validation_rules = $rules;
        return $this;
    }

    /**
     * Add rules for validation
     * 
     * @param array $data The input array, which can contain the data for validation.
     * @return bool Return true if the validation has passed of false if failed.
     */
    protected function attributesValidation(array $data)
    {
        /**Reset all validation errors */
        $this->validationErrors = [];

        /**Get all the key=>value pairs from multidimensional array to a 2D array */
        $this->validationAttributes = ConvertArrayTo2D::getAllKeysAndValuesRecursive($data);

        /**Go thru all the attribute rules and check with the data given */
        foreach ($this->validation_rules as $key => $rules) {
            $allRules = explode('|', $rules);
            //Go thru all set rules for one attribute
            foreach ($allRules as $rule) {
                $ruleWithParameter = explode('-', $rule);
                if (method_exists(get_class($this), $ruleWithParameter[0])) {
                    $method = $ruleWithParameter[0];
                    $att = isset($ruleWithParameter[1]) ? $ruleWithParameter[1] : NULL;
                    //call the corresponding rule method
                    $ruleComplianceCheck = $this->{$method}($key, $att);
                    if ($ruleComplianceCheck == FALSE) break;
                }
            }
        }
        /**Return TRUE if there is no error, otherwise return FALSE */
        return count($this->validationErrors) > 0 ? FALSE : TRUE;
    }

    protected function getAllValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * Given attribute must be set
     */
    protected function required($name): bool
    {
        if (!array_key_exists($name, $this->validationAttributes)) {
            $this->validationErrors[$name] = TRUE;
            return FALSE;
        }
        if ($this->validationAttributes[$name] == NULL || $this->validationAttributes[$name] == "") {
            $this->validationErrors[$name] = TRUE;
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Given attribute be max len of 
     */
    protected function max($name, $len): bool
    {
        if (isset($this->validationAttributes[$name]) && strlen($this->validationAttributes[$name]) <= $len) {
            return TRUE;
        }
        $this->validationErrors[$name] = TRUE;
        return FALSE;
    }

    /**
     * Given attribute be min len of 
     */
    protected function min($name, $len): bool
    {
        if (isset($this->validationAttributes[$name]) && strlen($this->validationAttributes[$name]) >= $len) {
            return TRUE;
        }
        $this->validationErrors[$name] = TRUE;
        return FALSE;
    }

    /**
     * Given attribute must be type of date
     */
    protected function date($name): bool
    {
        if (isset($this->validationAttributes[$name])) {
            if ($this->validationAttributes[$name] == "" || $this->validationAttributes[$name] == NULL) return TRUE;
            $explodedDate = explode('-', $this->validationAttributes[$name]);
            if (checkdate($explodedDate[1] * 1, $explodedDate[2], $explodedDate[0])) {
                return TRUE;
            } else {
                $this->validationErrors[$name] = TRUE;
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Given attribute must be allowed option
     */
    protected function allowedOptions($name, $array): bool
    {
        if (!json_validate($array)) {
            $this->validationErrors[$name] = TRUE;
            return FALSE;
        }
        $array = json_decode($array, true);
        if (key_exists($this->validationAttributes[$name], $array)) {
            return TRUE;
        } else {
            $this->validationErrors[$name] = TRUE;
            return FALSE;
        }
    }

    /**
     * Check if given attribute is a valid email
     * 
     * @param string $name Attribute name
     * @return bool
     */
    protected function email(string $name): bool
    {
        // FILTER_VALIDATE_EMAIL uses PHP's robust internal filtering mechanism.
        if (filter_var($this->validationAttributes[$name], FILTER_VALIDATE_EMAIL) === false) {
            $this->validationErrors[$name] = TRUE;
            return FALSE;
        }
        return TRUE;
    }
}
