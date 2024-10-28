<?php

namespace App\Services\HidroProjekt\Domain\Workers\Employes;

use App\Models\User;

class ConstructionSuperintendentService
{   
    public function getAllSuperintendents(){
        return User::where('type', User::USER_TYPE_GROUP_LEADER)
            ->where('active', 1)
            ->with('getWorker')->get();
    }

    public function getSuperintendentById($id){
        return User::where('type', User::USER_TYPE_GROUP_LEADER)
            ->where('id', $id)
            ->with('getWorker')->first();
    }
}