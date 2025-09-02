<?php

namespace App\Services\WorkdayDiary;

use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;
use App\Models\User;
use App\Models\WorkingDayRecordModel;

/**
 * Class EditWorkdayDiaryService.
 */
class EditWorkdayDiaryService
{
    /**
     * @var WorkingDayRecordModel
     */
    private $workDayDiary = NULL;

    //construction_site_id, car_id, date, created_at, updated_at, work_description, work_type
    private $user_id = NULL;
    private $construction_site_id = NULL;
    private $car_id = NULL;
    private $date = NULL;
    private $work_description = NULL;
    private $work_type = NULL;

    public function __construct($wddID)
    {
        $this->workDayDiary = WorkingDayRecordModel::find($wddID);
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $user = User::find($userId);
        $this->user_id = $user != NULL ? $userId : NULL;

        return $this;
    }

    /**
     * Set the value of constId
     *
     * @return  self
     */
    public function setConstId($constId)
    {
        $consSite = ConstructionSiteModel::find($constId);
        $this->construction_site_id = $consSite != NULL ? $constId : NULL;

        return $this;
    }

    /**
     * Set the value of carId
     *
     * @return  self
     */
    public function setCarId($carId)
    {
        $car = CompanyCarsModel::find($carId);
        $this->car_id = $car != NULL ? $carId : NULL;

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
     * Set the value of workDesc
     *
     * @return  self
     */
    public function setWorkDesc($workDesc)
    {
        $this->work_description = $workDesc;

        return $this;
    }

    /**
     * Set the value of workType
     *
     * @return  self
     */
    public function setWorkType($workType)
    {
        $this->work_type = $workType;

        return $this;
    }

    public function execute(): void
    {
        /**Prepare data */
        $array = get_object_vars($this);
        unset($array['workDayDiary']);
        /**Remove all with NULL */
        foreach ($array as $key => $value) {
            if ($value == NULL) unset($array[$key]);
        }

        $this->workDayDiary->update($array);
        return;
    }

    /**
     * Set the value of workDesc to null
     *
     * @return  self
     */
    public function setWorkDescToNull()
    {
        $this->workDayDiary->update(['work_description' => NULL]);

        return $this;
    }
}
