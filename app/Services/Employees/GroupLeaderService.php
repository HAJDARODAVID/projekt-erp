<?php

namespace App\Services\Employees;

use App\Models\User;
use App\Models\WorkerModel;

/**
 * Class GroupLeaderService.
 */
class GroupLeaderService
{

    public static function getAllForSelect($admStaff = FALSE)
    {
        $groupLeaders = User::where('type', User::USER_TYPE_GROUP_LEADER)->where('active', 1)->get();
        $array = [];
        foreach ($groupLeaders as $leader) {
            $array[$leader->id] = WorkerModel::find($leader->worker_id)->fullName;
        }
        if ($admStaff) {
            $admStaffUsers = User::where('type', User::USER_TYPE_ADMIN_STAFF)->where('active', 1)->get();
            foreach ($admStaffUsers as $staff) {
                $array[$staff->id] = WorkerModel::find($staff->worker_id)->fullName;
            }
        }
        return $array;
    }
}
