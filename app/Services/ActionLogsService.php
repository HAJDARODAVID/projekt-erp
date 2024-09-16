<?php

namespace App\Services;

use Exception;
use App\Exceptions\MustBeArrayException;
use App\Exceptions\MissingArgumentException;
use App\Exceptions\MissingMethodException;
use App\Exceptions\MissingPropertyException;
use App\Models\ActionLog;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Class ActionLogsService.
 */
class ActionLogsService
{

    CONST ACTIONS = [
        'delete_bill'
    ];

    private $action;
    private $user;
    private $data = [];

    private $forValidation = [
        'action', 'user', 'data'
    ];

    static public function execute($data){
        return (new ActionLogsService())->createNewLog($data);
    }

    private function createNewLog($data){
        try {
            if(!is_array($data)){
                throw new MustBeArrayException('ActionsLogs');
            }
            foreach ($data as $key => $value) {
                if(!property_exists(get_class($this), $key)){
                    throw new MissingPropertyException($key);
                }
                if(!method_exists(get_class($this),'set'.ucfirst($key))){
                    throw new MissingMethodException('set'.ucfirst($key));
                }
                $method = 'set'.ucfirst($key);
                $this->$method($value);
            }
        } catch (Exception $e) {
            return [
                'error' => TRUE,
                'message' => $e->getMessage(),
            ];
        }

        $validation = $this->validation();
        if(isset($validation['error'])){
            return [
                'error' => TRUE,
                'message' => $validation['message'],
            ];
        }

        ActionLog::create([
            'action' => $this->action, 
            'user_id' => $this->user, 
            'log' => json_encode($this->data)
        ]);

        return;
    }

    private function validation(){
        try {
            foreach ($this->forValidation as $argument) {
                if(!isset($this->$argument) || empty($this->$argument)){
                    throw new MissingArgumentException($argument);
                }
                if(!is_array($this->data)){
                    throw new MustBeArrayException('ActionsLogs', 'data');
                }
            }
        } catch (Exception $e) {
            return [
                'error' => TRUE,
                'message' => $e->getMessage(),
            ];
        }
        return TRUE;
    }

    private function setAction($value){
        return $this->action = $value;
    }

    private function setUser($value){
        return $this->user = $value;
    }

    private function setData($value){
        return $this->data = $value;
    }

}
