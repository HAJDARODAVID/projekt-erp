<?php

namespace App\Services\Employees;

use App\Traits\Singleton;
use App\Models\WorkerModel;
use App\Traits\MagicStatic;
use App\Models\CooperatorsModel;
use App\Models\CooperatorWorkersModel;

/**
 * Class GetAllWorkersService.
 */
class WorkersService
{
    use Singleton, MagicStatic;

    /**DATA */
    private $myWorkers = NULL;
    private $cooperators = NULL;

    /**FLAGS */
    /**
     * Defines if we need only active/inactive/all workers.
     * NULL == all / TRUE == active / FALSE == inactive 
     */
    private $active = NULL;

    /**
     * Get all the workers from the DB
     */
    protected function myWorkers()
    {
        $this->myWorkers = WorkerModel::where('is_worker', TRUE);
        return $this;
    }

    /**
     * Get all the cooperator workers from the DB
     */
    protected function cooperators()
    {
        $this->cooperators = CooperatorWorkersModel::with('getCoOpInfo');
        return $this;
    }

    /**
     * Set the active flag. Apply the given flag to the models
     * Default is TRUE == active
     */
    protected function active($flag = TRUE)
    {
        $this->active = $flag;
        return $this;
    }

    protected function search($searchValue)
    {
        /**Check if active is set and add to $activeFlag */
        $activeFlag = NULL;
        if ($this->active == TRUE || $this->active == FALSE) {
            //TODO: change the worker status in a global class work worker and employ
            if ($this->active == TRUE) $activeFlag = WorkerModel::WORKER_STATUS_EMPLOYED;
            if ($this->active == FALSE) $activeFlag = WorkerModel::WORKER_STATUS_EX_EMPLOYEE;
        }

        /**Prepare myWorkers data */
        if (!is_null($this->myWorkers) && $activeFlag !== NULL) $this->myWorkers->where('status', $activeFlag)->where('firstName', 'like', '%' . $searchValue . '%')
            ->orWhere('lastName', 'like', '%' . $searchValue . '%');

        /**Prepare cooperator data */
        if (!is_null($this->cooperators) && $activeFlag !== NULL) $this->cooperators->where('status', $activeFlag)->where('firstName', 'like', '%' . $searchValue . '%')
            ->orWhere('lastName', 'like', '%' . $searchValue . '%');

        return [
            'myWorkers'   => $this->myWorkers   != NULL ? $this->myWorkers->get() : [],
            'cooperators' => $this->cooperators != NULL ? $this->cooperators->get() : [],
        ];
    }

    protected function get()
    {
        dd($this->myWorkers->where('status', -1));
    }
}
