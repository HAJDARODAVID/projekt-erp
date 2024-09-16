<?php

namespace App\Exceptions;

use Exception;

class MustBeArrayException extends Exception
{
    public function __construct($what = NULL, $name = NULL){
        $w= $what != NUll ? $what : NULL;
        $n= $name != NUll ? $name : NULL;

        if($w){
          $message =  $w ." arguments must be type array!";
        }

        if($n){
            $message =  $n ." argument must be type array!";
        }

        if($n && $w){
            $message =  $w ."-". $n ." argument must be type array!";
        }

        if(!$n && !$w){
            $message =  "Argument must be type array!";
        }

        $this->message = $message;
    }
}
