<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const USER_TYPE_MANAGER = 1;
    const USER_TYPE_ADMIN_STAFF = 2;
    const USER_TYPE_GROUP_LEADER = 3;
    const USER_TYPE_SUPER_ADMIN = 4;

    const USER_TYPE = array(
        self::USER_TYPE_MANAGER => 'Manager',
        self::USER_TYPE_ADMIN_STAFF => 'Administration staff',
        self::USER_TYPE_GROUP_LEADER => 'Group leader',
        self::USER_TYPE_SUPER_ADMIN => 'Super admin',
    );

    const DEFAULT_PASSWORD = 123456;

    protected $attributes = [
        'type' => self::USER_TYPE_ADMIN_STAFF,
        'active' => 1,
    ];
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'worker_id',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function getWorkerEntry():HasOne{
    //     return $this->hasOne(WorkerModel::class, 'worker_id','id');
    // }

    public function getWorker():HasOne{
        return $this->hasOne(WorkerModel::class, 'id','worker_id');
    }

}
