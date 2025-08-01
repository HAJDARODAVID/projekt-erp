<?php

namespace App\Services\Employees;

use App\Models\User;
use App\Models\WorkerModel;

/**
 * Class GroupLeaderService.
 */
class GroupLeaderService
{

    public static function getAllForSelect()
    {
        $groupLeaders = User::where('type', User::USER_TYPE_GROUP_LEADER)->where('active', 1)->get();
        $array = [];
        foreach ($groupLeaders as $leader) {
            $array[$leader->id] = WorkerModel::find($leader->worker_id)->fullName;
        }
        return $array;
    }
}
