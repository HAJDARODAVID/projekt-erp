<?php

namespace App\Services\ConstructionSite;

use App\Services\BaseService;
use App\Models\AttendanceCoOpModel;
use App\Models\Employees\Attendance;
use App\Models\Jobs\ConstructionSite;
use App\Models\WorkingDayRecordModel;

/**
 * Class GetConstructionSiteOverallHoursService.
 */
class GetConstructionSiteOverallHoursService extends BaseService
{
    /** @var ConstructionSite */
    private $constructionSite;

    public function __construct(ConstructionSite $constructionSite)
    {
        $this->constructionSite = $constructionSite;
    }

    /**
     * Execute the service
     */
    public function execute(): ConstructionSiteHoursDto
    {
        $constructionSiteHoursDto = new ConstructionSiteHoursDto;
        /**TODO:Change WorkingDayRecordModel to a new model */
        $wdrArray = WorkingDayRecordModel::where('construction_site_id', $this->constructionSite->id)->pluck('id')->toArray();
        $constructionSiteHoursDto->setCompanyHours(Attendance::whereIn('working_day_record_id', $wdrArray)->sum('work_hours'))
            /**TODO:Change AttendanceCoOpModel to a new model */
            ->setContractorsHours(AttendanceCoOpModel::whereIn('working_day_record_id', $wdrArray)->sum('work_hours'));
        return $constructionSiteHoursDto;
    }
}
