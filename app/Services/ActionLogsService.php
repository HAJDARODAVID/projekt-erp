<?php

namespace App\Services;

use Exception;
use App\Exceptions\MustBeArrayException;
use App\Exceptions\MissingMethodException;
use App\Exceptions\MissingPropertyException;

/**
 * Class ActionLogsService.
 */
class ActionLogsService
{

    CONST ACTIONS = [
        'delete_bill'
    ];

    static public function execute($data){
        return (new ActionLogsService())->createNewLog($data);
    }

    private function createNewLog($data){
        try {
            if(!is_array($data)){
                throw new MustBeArrayException;
            }
            extract($data);
        } catch (Exception $e) {
            return [
                'error' => TRUE,
                'message' => $e->getMessage(),
            ];
        }

        foreach ($data as $key => $value) {
            try {
                if(!property_exists(get_class($this), $key)){
                    throw new MissingPropertyException($key);
                }
                if(!method_exists(get_class($this),'set'.ucfirst($key))){
                    throw new MissingMethodException('set'.ucfirst($key));
                }
                $method = 'set'.ucfirst($key);
                $this->$method($value);
            } catch (Exception $e) {
                return [
                    'error' => TRUE,
                    'message' => $e->getMessage(),
                ];
            }
        }
    }

}
