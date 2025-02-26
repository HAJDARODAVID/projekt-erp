<?php

namespace App\Helpers;

class ClassMerger{

    public static function merge($classes){
        $string = "";
        foreach ($classes as $class) {
            $string = $string . ' '  . $class;
        }
        return $string;
    }
}