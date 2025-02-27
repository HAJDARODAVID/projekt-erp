<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CooperatorWorkersModel extends Model
{
    use HasFactory;

    const COOPERATORS_WORKER_STATUS_ACTIVE = 1;
    const COOPERATORS_WORKER_STATUS_INACTIVE = 0;

    const COOPERATORS_STATUS = array(
        self::COOPERATORS_WORKER_STATUS_ACTIVE => 'Aktivni',
        self::COOPERATORS_WORKER_STATUS_INACTIVE => 'Ne aktivni',
    );

    protected $table = 'cooperator_workers';
    protected $fillable = [
        'cooperator_id',
        'firstName',
        'lastName',
        'status',
    ];

    public function getCoOpInfo():HasOne{
        return $this->hasOne(CooperatorsModel::class, 'id','cooperator_id');
    }

    public function getFullNameAttribute(){
        return $this->attributes['firstName'] .' '. $this->attributes['lastName'];
    }
}
