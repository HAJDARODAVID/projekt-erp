<?php

namespace App\Services\Employees;

use App\Services\BaseService;
use App\Models\Employees\Worker;
use App\Models\Employees\WorkerStatus;

/**
 * Class ChangeWorkerStatusService.
 */
class ChangeWorkerStatusService extends BaseService
{
    /** @var Worker */
    private $worker = NULL;

    public function __construct(Worker|NULL $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Set the object instance by the worker ID
     * 
     * @param int $workerID Give the method the worker ID
     * @return self
     */
    public static function byID(int $workerID): self
    {
        return new self(Worker::find($workerID));
    }

    /**
     * Change the worker status to WorkerStatus::WORKER_STATUS_INACTIVE.
     * This means that the worker is no longer active in the company.
     * 
     * @return self
     */
    public function deactivate()
    {
        /**Check if there is a Worker model set */
        if ($this->worker == NULL) {
            $this->setErrorMessage('Za odabranog radnika nema zapis u bazi!');
            return $this;
        }

        /**Change the worker status */
        try {
            $this->worker->status = WorkerStatus::WORKER_STATUS_INACTIVE;
            $this->worker->save();
            $this->setSuccessMessage('Uspješno promjenjen status radnika ' . $this->worker->fullName . ': NE AKTIVAN!');
        } catch (\Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        return $this;
    }

    /**
     * Change the worker status to WorkerStatus::WORKER_STATUS_ACTIVE.
     * This means that the worker is active in the company.
     * 
     * @return self
     */
    public function activate()
    {
        /**Check if there is a Worker model set */
        if ($this->worker == NULL) {
            $this->setErrorMessage('Za odabranog radnika nema zapis u bazi!');
            return $this;
        }

        /**Change the worker status */
        try {
            $this->worker->status = WorkerStatus::WORKER_STATUS_ACTIVE;
            $this->worker->save();
            return $this->setSuccessMessage('Uspješno promjenjen status radnika ' . $this->worker->fullName . ': AKTIVAN!');
        } catch (\Exception $e) {
            return $this->setErrorMessage($e->getMessage());
        }
        return $this;
    }

    /**
     * Change the worker status to WorkerStatus::WORKER_STATUS_LONG_SICK_LEAVE.
     * This means that the worker is on a long sick leave.
     * 
     * @return self
     */
    public function longSickLeave()
    {
        /**Check if there is a Worker model set */
        if ($this->worker == NULL) {
            $this->setErrorMessage('Za odabranog radnika nema zapis u bazi!');
            return $this;
        }

        /**Change the worker status */
        try {
            $this->worker->status = WorkerStatus::WORKER_STATUS_LONG_SICK_LEAVE;
            $this->worker->save();
            return $this->setSuccessMessage('Uspješno promjenjen status radnika ' . $this->worker->fullName . ': DUGO BOLOVANJE!');
        } catch (\Exception $e) {
            return $this->setErrorMessage($e->getMessage());
        }
        return $this;
    }
}
