<?php

namespace App\Services\WorkdayDiary;

use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;
use App\Models\User;
use App\Models\WorkingDayLogModel;
use App\Models\WorkingDayRecordModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateNewWorkdayDiary.
 */
class CreateNewWorkdayDiaryService
{
    const LOG_ADMIN_MESSAGE = 'Zapis kreiran od strane administracije zbog upisata radnih sati radnika.';

    private $user = NULL;
    private $jobSiteId = NULL;
    private $carId = NULL;
    private $date = NULL;
    private $description = NULL;
    private $log = NULL;
    private $workType = NULL;


    public function execute()
    {
        /**Check if the users is set and if he is a groupLeader */
        if ($this->user !== NULL) {
            $user = User::find($this->user);
            /**If the given user dose not exists throw a error */
            if ($user === NULL) return ['success' => FALSE, 'error' => "Korisnik #" . $this->user . " ne postoji!"];
            $this->user = $user;
        } else {
            $this->user = Auth::user();
        }

        /**Check if the construction site exists */
        if ($this->jobSiteId !== NULL) {
            $jobSiteId = ConstructionSiteModel::find($this->jobSiteId);
            /**If the given construction site dose not exists throw a error */
            if ($jobSiteId === NULL) return ['success' => FALSE, 'error' => "Gradilište #" . $this->jobSiteId . " ne postoji!"];
            $this->jobSiteId = $jobSiteId->id;
        }

        /**Check if the car exists */
        if ($this->carId !== NULL) {
            $carId = CompanyCarsModel::find($this->carId);
            /**If the given car dose not exists throw a error */
            if ($carId === NULL) return ['success' => FALSE, 'error' => "Vozilo #" . $this->carId . " ne postoji!"];
            $this->carId = $carId->id;
        }

        /**If the diary is added by administration add the description */
        if ($this->user->type == User::USER_TYPE_ADMIN_STAFF || $this->user->type == User::USER_TYPE_SUPER_ADMIN) {
            $this->description = "Created by the administrator.";
            $this->log = $this->log != NULL ? self::LOG_ADMIN_MESSAGE . "\n" . $this->log : $this->log;
        }

        /**Prepare the array for DB */
        $diaryInfo = [
            'user_id' => $this->user->id,
            'construction_site_id' => $this->jobSiteId,
            'car_id' => $this->carId,
            'date' => $this->date,
            'work_description' => $this->description,
            'work_type' => $this->workType
        ];

        /**Add data to DB */
        $newDiary = WorkingDayRecordModel::create($diaryInfo);

        /**Check if log is available, and if yes set the array for DB */
        $diaryLogInfo = [];
        if ($this->log) {
            $diaryLogInfo = [
                'working_day_record_id' => $newDiary->id,
                'construction_site_id' => $this->jobSiteId,
                'log' => $this->log,
            ];
            /**Add data to DB */
            WorkingDayLogModel::create($diaryLogInfo);
        }


        return ['success' => TRUE, 'newDiary' => $newDiary];
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the value of jobSiteId
     *
     * @return  self
     */
    public function setJobSiteId($jobSiteId)
    {
        $this->jobSiteId = $jobSiteId;

        return $this;
    }

    /**
     * Set the value of carId
     *
     * @return  self
     */
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of workType
     *
     * @return  self
     */
    public function setWorkType($workType)
    {
        $this->workType = $workType;

        return $this;
    }

    /**
     * Get the value of log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set the value of log
     *
     * @return  self
     */
    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }
}
