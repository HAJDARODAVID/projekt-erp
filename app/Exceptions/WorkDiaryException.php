<?php

namespace App\Exceptions;

use Exception;

class WorkDiaryException extends Exception
{
    public function __construct($for, $param){
        switch ($for) {
            case 'user':
                $this->message = 'User ID: ' .$param. 'does not exists!';
                break;
                
            case 'jobSite':
                $this->message = 'Construction site ID: ' .$param. 'does not exists!';
                break;
                    
            case 'car':
                $this->message = 'Car ID: ' .$param. 'does not exists!';
                break;
            
            default:
            $this->message = 'Work diary default error!';
                break;
        }
    }
}