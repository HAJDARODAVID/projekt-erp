<?php

namespace App\Services;

/**
 * Class ActionLogsService.
 */
class ActionLogsService
{

    private $actions = [
        'delete_bill'
    ];

    public static function createNewLog($data){
        extract($data);
        
        if(!$user_id){
            return [
                'title' => 'ERROR!',
                'message' => "User id is missing!",
                'type' => 'danger',
            ];
        }
    }

}
