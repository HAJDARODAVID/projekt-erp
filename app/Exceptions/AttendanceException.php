<?php

namespace App\Exceptions;

use Exception;

class AttendanceException extends Exception
{
    public function __construct($for, $param){
        switch ($for) {
            case 'worker-missing':
                $this->message = 'Worker ID can not be NULL!';
                break;

            case 'worker-not-defined':
                $this->message = 'Worker not defined!';
                break;
                
            case 'worker':
                $this->message = 'Worker ID: ' .$param. ' does not exists!';
                break;
                    
            case 'reason-not-defined':
                $this->message = 'Absence reason: ' .$param. ' not defined!';
                break;
            
            default:
            $this->message = 'Attendance default error!';
                break;
        }
    }
}