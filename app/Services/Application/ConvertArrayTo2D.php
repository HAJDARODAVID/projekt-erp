<?php

namespace App\Services\Application;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ConvertArrayTo2D
{
    /**
     * Recursively retrieves all unique keys from a nested array.
     *
     * This method leverages PHP's Standard PHP Library (SPL) iterators
     * (RecursiveArrayIterator and RecursiveIteratorIterator) for efficient
     * traversal of multi-dimensional arrays.
     *
     * @param array $array The input array, which can contain nested arrays.
     * @return array A flat array containing all unique keys found at any level.
     */
    public static function getAllKeysAndValuesRecursive(array $array): array
    {
        $keys = []; // Initialize an empty array to store all found keys
        $attributes = []; // Initialize an empty array to store all attributes and its values

        // Create a RecursiveArrayIterator for the initial array.
        // This iterator allows the RecursiveIteratorIterator to correctly identify
        // and traverse nested array structures.
        $arrayIterator = new RecursiveArrayIterator($array);

        // Create a RecursiveIteratorIterator.
        // The RecursiveIteratorIterator flattens the traversal of the
        // RecursiveArrayIterator, allowing us to loop through all elements
        // (including those in nested arrays) as if they were in a single dimension.
        //
        // RecursiveIteratorIterator::SELF_FIRST mode is used to ensure that
        // the key of a parent array is included in the results before its children's keys.
        $recursiveIterator = new RecursiveIteratorIterator(
            $arrayIterator,
            RecursiveIteratorIterator::SELF_FIRST
        );

        // Iterate through all elements (keys and values) in the nested structure
        // provided by the RecursiveIteratorIterator.
        foreach ($recursiveIterator as $key => $value) {
            // Add the current key to our list of collected keys.
            // The 'key()' method of RecursiveIteratorIterator returns the key
            // of the current element at its respective depth.
            $keys[] = $key;
            if (!is_array($value)) $attributes[$key] = $value;
        }

        // Use array_unique() to remove any duplicate key names.
        // This is useful if the same key name appears at different levels
        // or within different sub-arrays, ensuring a clean list of distinct keys.
        // BUT!!! i'm returning key value pairs
        return $attributes;
        //return array_unique($keys);
    }
}
