<?php

namespace App\Services\ConstructionSite;

use App\Services\BaseService;
use App\Models\Jobs\ConstructionSite;

/**
 * Class GetAllConstructionSiteReportDataService.
 */
class GetAllConstructionSiteReportDataService extends BaseService
{
    public function __construct() {}

    /**
     * Getter all the data for a specific all construction sites
     */
    public function execute(): self
    {
        try {
            $output = [];

            /**Get all construction sites */
            $constructionSiteObj = ConstructionSite::orderBy('name')->get();

            foreach ($constructionSiteObj as $constructionSite) {
                $service = (new GetConstructionSiteReportDataService($constructionSite))->execute();
                if ($service->getResponse()['success']) {
                    $output[] = $service->getResponse()['data']->toArray();
                } else {
                    $this->setErrorMessage($service->getResponse()['message']);
                    return $this;
                }
            }
            $this->setData($output);
        } catch (\Throwable $th) {
            $this->setErrorMessage($th->getMessage());
        }
        return $this;
    }
}
