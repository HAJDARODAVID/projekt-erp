<?php

namespace App\Services\WorkdayDiary;

use App\Models\WorkingDayRecordModel;

/**
 * Class GetWorkdayDiaryService.
 */
class GetWorkdayDiaryService
{
    /**
     * @var WorkingDayRecordModel
     */
    private $workDayDiary = NULL;

    public function __construct($wddID)
    {
        $this->workDayDiary = WorkingDayRecordModel::find($wddID);
    }

    public function getWorkDayDiary()
    {
        return $this->workDayDiary;
    }
}
