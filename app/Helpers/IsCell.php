<?php

namespace App\Helpers;

class IsCell{

    public static function selected(array $array, $date){
        if(isset($array) && isset($date)){
            $key = array_search($date, $array);
            if($key === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
}