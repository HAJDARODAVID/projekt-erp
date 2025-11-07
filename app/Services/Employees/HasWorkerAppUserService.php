<?php

namespace App\Services\Employees;

use App\Models\User;
use App\Services\BaseService;
use App\Models\Employees\Worker;

/**
 * Class HasWorkerAppUserService.
 */
class HasWorkerAppUserService extends BaseService
{
    /** @var Worker */
    private $worker = NULL;

    /** @var User */
    private $user = NULL;

    public function __construct(Worker|NULL $worker = NULL)
    {
        $this->worker = $worker;
        if ($this->worker != NULL) $this->user = User::where('worker_id', $this->worker->id)->first();
    }

    /**
     * Set the object instance by the worker ID
     * 
     * @param int $workerID Give the method the worker ID
     * @return self
     */
    public static function byWorkerID(int $workerID): self
    {
        return new self(Worker::find($workerID));
    }

    /**
     * Check ih the worker has a app user
     * 
     * @return bool
     */
    public function hasUser(): bool
    {
        if ($this->user) return TRUE;
        return FALSE;
    }
}
