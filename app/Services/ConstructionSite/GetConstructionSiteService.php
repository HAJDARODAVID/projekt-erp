<?php

namespace App\Services\ConstructionSite;

use App\Models\Jobs\ConstructionSite;
use App\Services\WorkdayDiary\GetWorkdayDiaryService;

/**
 * Class GetConstructionSiteService.
 */
class GetConstructionSiteService
{
    /** @var ConstructionSite|NULL */
    private ConstructionSite|null $constructionSite = null;

    private function __construct(ConstructionSite|null $constructionSite)
    {
        $this->constructionSite = $constructionSite;
    }

    /**
     * Return the construction site model.
     * 
     * @return ConstructionSite|null
     */
    public function getConstructionSite(): ConstructionSite|null
    {
        return $this->constructionSite;
    }

    /**
     * This will give you the Construction sites model.
     * @return ConstructionSite
     */
    public static function wdrID($id)
    {
        $wdr = (new GetWorkdayDiaryService($id))->getWorkDayDiary();
        return new self(ConstructionSite::find($wdr->construction_site_id) ?? NULL);
    }
}
